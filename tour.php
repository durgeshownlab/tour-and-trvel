<?php 

include('header.php'); 

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_GET['package-id']) && !empty($_GET['package-id']))
{
	$package_id=htmlspecialchars($_GET['package-id']);

	$sql_package="select * from packages where package_id=$package_id and is_deleted=0";
	$result_package=mysqli_query($con, $sql_package);
	if(mysqli_num_rows($result_package)==1)
	{
		$row_package=mysqli_fetch_assoc($result_package);

		$sql_image="select * from package_images where package_id={$row_package['package_id']} and is_deleted=0";
		$result_image=mysqli_query($con, $sql_image);
		if(mysqli_num_rows($result_image)>0)
		{
			$row_image=mysqli_fetch_assoc($result_image);
		}
	}
	else
	{
		exit;
	}
}
else
{
	exit;
}

// code for handeling the commment post when user clicked on post commment 
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit-review']))
{
	if(!isset($_POST['rating']) || empty($_POST['rating']))
	{
		exit;
	}
	else if(!isset($_POST['comment-text']) || empty($_POST['comment-text']))
	{
		exit;
	}
	else if(!isset($_POST['package-id']) || empty($_POST['package-id']))
	{
		exit;
	}
	else
	{
		$rating=htmlspecialchars($_POST['rating']);
		$comment_text=htmlspecialchars($_POST['comment-text']);
		$packageId=htmlspecialchars($_POST['package-id']);

		$sql_rating="INSERT INTO comments (user_id, package_id, comment_text, rating) VALUES({$_SESSION['user_id']}, {$packageId}, '{$comment_text}', {$rating})";
		if(mysqli_query($con, $sql_rating))
		{
			echo '<script>alert("Thanks For Rating Our Package !")</script>';
			echo '<script>window.location.href = "' . $_SERVER['PHP_SELF'] . '?package-id='.$package_id.'";</script>';
			// header('Location: '. $_SERVER['PHP_SELF']);
			exit();
		}
		else
		{
			echo '<script>alert("Failed To Post The Review, Please Try Again")</script>';

		}

	}
}

// code for handeling the commment post when user clicked on post commment 
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['book-now-button']))
{
	if(!isset($_POST['package-id']) || empty($_POST['package-id']))
	{
		exit;
	}
	else if($_POST['package-id'] != $package_id)
	{
		exit();
	}
	else if(!isset($_POST['name']) || empty($_POST['name']))
	{
		exit;
	}
	else if(!isset($_POST['email']) || empty($_POST['email']))
	{
		exit;
	}
	else if(!isset($_POST['no-person']) || empty($_POST['no-person']) || !is_numeric($_POST['no-person']) || $_POST['no-person']<1)
	{
		exit;
	}
	else if(!isset($_POST['phone']) || empty($_POST['phone']))
	{
		exit;
	}
	else if(!isset($_POST['tour-date']) || empty($_POST['tour-date']))
	{
		exit;
	}
	else
	{
		$user_id=mysqli_real_escape_string($con, $_SESSION['user_id']);

		$packageId=mysqli_real_escape_string($con, $_POST['package-id']);
		$name=mysqli_real_escape_string($con, $_POST['name']);
		$email=mysqli_real_escape_string($con, $_POST['email']);
		$no_person=mysqli_real_escape_string($con, $_POST['no-person']);
		$phone=mysqli_real_escape_string($con, $_POST['phone']);
		$tour_date=mysqli_real_escape_string($con, $_POST['tour-date']);

		$package_price=mysqli_real_escape_string($con, $row_package['new_price']);
		$total_price=$no_person*$package_price;

		$payment_type='cod';
		$payment_status='pending';
		$order_status='order placed';


		$order_id=strtoupper(uniqid('ORDER_'));
		

		$sql_order="INSERT INTO orders (user_id, package_id, order_id, name, mobile, email, no_person, package_price, total_price, tour_date, payment_type, payment_status, order_status) VALUES({$user_id}, {$packageId}, '{$order_id}', '{$name}', '{$phone}', '{$email}', {$no_person}, {$package_price}, {$total_price}, '{$tour_date}', '{$payment_type}', '{$payment_status}', '{$order_status}')";
		if(mysqli_query($con, $sql_order))
		{

			// sending mail to the customer 
			$to=$email;
			$subject="Preet Holiday! order has been successfully placed";
			$body="<div style=\"margin:0px auto; width:100%; background-color:#f3f2f0; padding:0px; padding-top:8px; padding-bottom: 8px;\">
					<table valign=\"top\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"60%\" align=\"center\" style=\"background-color:#fff; padding: 10px 5px\">
						<tr><td>Hii, <b style=\"text-transform: capitalize;\">{$name}</b></td></tr>
						<tr>
							<td>
								<center> 
									<img src=\"https://freepngimg.com/save/18343-success-png-image/1200x1200\" style=\"width: 100px; height: auto;\">
									<h1>Your order has been successfully placed</h1>
									<img src=\"../{$row_package['main_image']}\" style=\"width: 150px; height: auto;\"><br/><br/>
									<a href=\"127.0.0.1/tour-and-travel/tour.php?package-id={$packageId}\" style=\"text-decoration: none; color: blue; font-size: 1.2rem; text-transform: capitalize;\">{$row_package['name']}</a><br/>
									No. of Person:  {$no_person}<br/>
									Total Amount: <b> ₹</b>".number_format($row_package['new_price']*$no_person)."<br/><br/>
								</center>
							</td>
						</tr>

						<tr>
							<td><center>Order ID: {$order_id}</center></td>
						</tr>
						<tr>
							<td><center>Payment Status: {$payment_status}</center><br/><br/></td>
						</tr>
						<tr><td><center>
						<a href=\"127.0.0.1/tour-and-travel/\" style=\"padding: 5px 10px; border: none; background-color: green; border-radius: 5px; text-decoration: none; color: #fff;\">Visit Our Website</a><br/><br/>
						Thank you for shoping
						</center>
						</td>
						</tr>
					</table>
					</div>";

			//Import PHPMailer classes into the global namespace
			//These must be at the top of your script, not inside a function
		
			require 'PHPMailer/Exception.php';
			require 'PHPMailer/PHPMailer.php';
			require 'PHPMailer/SMTP.php';

			//Create an instance; passing `true` enables exceptions
			$mail = new PHPMailer(true);

			try {
				//Server settings                 //Enable verbose debug output
				$mail->isSMTP();                                            //Send using SMTP
				$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
				$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
				$mail->Username   = 'hamarfreefire2021@gmail.com';                     //SMTP username
				$mail->Password   = 'jlatawobrxvhdjgi';                               //SMTP password
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
				$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

				//Recipients
				$mail->setFrom('hamarfreefire2021@gmail.com', 'Preet Holiday');
				$mail->addAddress($to, $name);     //Add a recipient


				//Content
				$mail->isHTML(true);                                  //Set email format to HTML
				$mail->Subject = $subject;
				$mail->Body    = $body;

				$mail->send();
				// echo "<script>console.log('Email successfully sent to {$to}')</script>";
			} 
			catch (Exception $e){
				// echo "<script>console.log('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');";
			}


			echo '<script>alert("Order Place Successfully!")</script>';
			echo '<script>window.location.href = "' . $_SERVER['PHP_SELF'] . '?package-id='.$package_id.'";</script>';
			// header('Location: '. $_SERVER['PHP_SELF']);
			exit();
		}
		else
		{
			echo '<script>alert("Failed To Post The Review, Please Try Again")</script>';

		}

	}
}

?>
<div class="single-tour">
		<div id="site-banner"
			style="background-image: url(images/packages/<?= $row_package['banner_image'] ?>);">
			<div class="banner-content">
				<h1><?= ucwords($row_package['name']) ?></h1>
				<ul id="inspiry_breadcrumbs" class="inspiry_breadcrumbs">
					<li class="breadcrumb-item"><a href="index.php" title="Home">Home</a></li>
					<li>&gt;</li>
					<li class="breadcrumb-item item-cat item-custom-post-type-tour"><a
							class="bread-cat bread-custom-post-type-tour" href="tours.php" title="Tours">Tours</a>
					</li>
					<li>&gt;</li>
					<li class="breadcrumb-item active item-current item-323"><span class="bread-current bread-323"
							title="Fabulous Dubai"><?= ucwords($row_package['name']) ?></span></li>
				</ul>
			</div>
		</div>
		
			<div class="tour-meta-bar">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="tour-tags clearfix">
								<?php 

									$sql_find_rating="select package_id, round(avg(rating)) as rating, count(package_id) as total_rating from comments where package_id={$package_id} and is_deleted=0";
									$result_find_rating=mysqli_query($con, $sql_find_rating);

									if(mysqli_num_rows($result_find_rating)>0)
									{
										$row_find_rating=mysqli_fetch_assoc($result_find_rating);

										if($row_find_rating['total_rating']>0)
										{
											
									
								?>
								<div class="tag-review">
									<span class="rating">
										<?php 
											for($i=0; $i<$row_find_rating['rating']; $i++)
											{
												echo '<i class="fa fa-star-o rated"></i>';
											}

											for ($i=0; $i<5-$row_find_rating['rating']; $i++) { 
												echo '<i class="fa fa-star-o"></i>';
											}
										?>
									</span>
									<a id="reviews-hash" href="#respond">(<?= $row_find_rating['total_rating'] ?> Reviews)</a>
								</div>

								<?php 
										}
									}
								?>
								<div class="tag-price">
									<svg version="1.1" class="tour-price-tag" xmlns=""
										xmlns:xlink="" x="0px" y="0px" width="34" height="34px"
										viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
										<g>
											<path d="M13.104,5.379l-7.609-0.29l0.14,7.488l7.542,7.534l7.329-7.329L13.104,5.379z M6.664,6.287l5.952,0.227l3.989,3.998
			l-5.7,5.7l-4.128-4.127L6.664,6.287z M11.719,17.025l5.697-5.698l1.455,1.455l-5.694,5.7L11.719,17.025z" />
											<path d="M10.723,8.113C10.11,7.5,9.117,7.5,8.504,8.112s-0.613,1.605,0,2.218c0.612,0.613,1.605,0.613,2.218,0.001c0,0,0,0,0-0.001
			C11.335,9.718,11.335,8.726,10.723,8.113z M9.909,9.515c-0.165,0.156-0.423,0.156-0.587,0C9.158,9.353,9.157,9.088,9.319,8.925
			c0.163-0.163,0.426-0.164,0.589-0.001c0.163,0.162,0.164,0.426,0.002,0.589C9.91,9.514,9.909,9.514,9.909,9.515z" />
										</g>
									</svg>
									<span>
									&#8377; <?= $row_package['new_price'] ?> / Person </span>
								</div>
							</div>
	
							<ul class="clearfix">
								<?php 
								if($row_package['best_month']!='')
								{
								?>
								<li> <span class="tour-meta-icon">
										<span></span>
										<svg enable-background="new 0 0 30 30" version="1.1" viewBox="0 0 30 30"
											xml:space="preserve" xmlns="">
											<style type="text/css">
												.st0 {
													fill: none;
													stroke: #000000;
													stroke-width: 2;
													stroke-linecap: round;
													stroke-linejoin: round;
													stroke-miterlimit: 10;
												}
											</style>
											<polyline class="st0" points="5.9 3.4 1 3.4 1 29 29 29 29 3.4 24.1 3.4" />
											<rect class="st0" x="5.9" y="1" width="3.7" height="4.9" />
											<rect class="st0" x="20.5" y="1" width="3.7" height="4.9" />
											<line class="st0" x1="9.5" x2="20.5" y1="3.4" y2="3.4" />
											<line class="st0" x1="1" x2="29" y1="9.5" y2="9.5" />
											<line class="st0" x1="8.3" x2="8.3" y1="12" y2="26.6" />
											<line class="st0" x1="14.4" x2="14.4" y1="12" y2="26.6" />
											<line class="st0" x1="20.5" x2="20.5" y1="12" y2="26.6" />
											<line class="st0" x1="3.4" x2="26.6" y1="14.4" y2="14.4" />
											<line class="st0" x1="3.4" x2="26.6" y1="19.3" y2="19.3" />
											<line class="st0" x1="3.4" x2="26.6" y1="24.1" y2="24.1" />
										</svg>
									</span>
									<span class="tour-meta"><?= strtoupper($row_package['best_month']) ?></span>
								</li>
								<?php 
								}
								?>

								<?php 
								if($row_package['tour_duration']!='')
								{
								?>
								<li> <span class="tour-meta-icon">
										<span></span>
										<svg enable-background="new 0 0 30 30" version="1.1" viewBox="0 0 30 30"
											xml:space="preserve" xmlns="">
											<style type="text/css">
												.st0 {
													fill: none;
													stroke: #000000;
													stroke-width: 2;
													stroke-linecap: round;
													stroke-linejoin: round;
													stroke-miterlimit: 10;
												}
											</style>
											<circle class="st0" cx="15" cy="15" r="14" />
											<polyline class="st0" points="14.4 8.3 14.4 15 21.7 21.7" />
										</svg>
									</span>
									<span class="tour-meta"><?= strtoupper($row_package['tour_duration']) ?> Days</span>
								</li>
								<?php 
								}
								?>

								<?php 
								if($row_package['country']!='')
								{
								?>
								<li> <span class="tour-meta-icon">
										<span></span>
										<svg enable-background="new 0 0 30 30" version="1.1" viewBox="0 0 30 30"
											xml:space="preserve" xmlns="">
											<style type="text/css">
												.st0 {
													fill: none;
													stroke: #000000;
													stroke-width: 2;
													stroke-linecap: round;
													stroke-linejoin: round;
													stroke-miterlimit: 10;
												}
											</style>
											<path class="st0"
												d="M26.6,12H8.3L5.9,9.5H1l3.7,7.3h9.7l-7.3,7.3h6.1l7.3-7.3h6.1c1.3,0,2.4-1.1,2.4-2.4C29,13,27.9,12,26.6,12z" />
											<polyline class="st0" points="20.5 12 14.4 5.9 9.5 5.9 15.6 12" />
										</svg>
									</span>
									<span class="tour-meta"><?= ucwords($row_package['country']) ?></span>
								</li>
								<?php 
								}
								?>

								<?php 
								if($row_package['city']!='')
								{
								?>
								<li> <span class="tour-meta-icon">
										<span></span>
										<svg enable-background="new 0 0 30 30" version="1.1" viewBox="0 0 30 30"
											xml:space="preserve" xmlns="">
											<style type="text/css">
												.st0 {
													fill: none;
													stroke: #000000;
													stroke-width: 2;
													stroke-linecap: round;
													stroke-linejoin: round;
													stroke-miterlimit: 10;
												}
											</style>
											<path class="st0"
												d="m24.1 10.1c0 5-9.1 18.9-9.1 18.9s-9.1-13.8-9.1-18.9c0-5 4.1-9.1 9.1-9.1s9.1 4.1 9.1 9.1z" />
											<circle class="st0" cx="15" cy="10.1" r="3.7" />
										</svg>
									</span>
									<span class="tour-meta"><?= ucwords($row_package['city']) ?></span>
								</li>
								<?php 
								}
								?>
								
								<li> <span class="tour-meta-icon">
										<span></span>
										<svg enable-background="new 0 0 30 30" version="1.1" viewBox="0 0 30 30"
											xml:space="preserve" xmlns="">
											<style type="text/css">
												.st0 {
													fill: none;
													stroke: #000000;
													stroke-width: 2;
													stroke-linejoin: round;
													stroke-miterlimit: 10;
												}
											</style>
											<path class="st0"
												d="m12.6 18.7s-1.8-0.6-1.8-3.7c-1 0-1-2.4 0-2.4 0-0.4-1.8-4.9 1.2-4.3 0.6-2.4 7.3-2.4 7.9 0 0.4 1.7-0.6 4-0.6 4.3 1 0 1 2.4 0 2.4 0 3-1.8 3.7-1.8 3.7v3c3 1.1 6 2.1 7.5 3.1 2.5-2.5 4-6 4-9.8 0-7.7-6.3-14-14-14s-14 6.3-14 14c0 3.8 1.5 7.3 4 9.8 1.6-1.1 4.8-2.1 7.5-3.1v-3h0.1z" />
											<path class="st0" d="m5 24.8c2.5 2.6 6.1 4.2 10 4.2s7.4-1.6 10-4.2" />
										</svg>
									</span>
									<span class="tour-meta">18+</span>
								</li>
								<li> <span class="tour-meta-icon">
										<span></span>
										<svg enable-background="new 0 0 30 30" version="1.1" viewBox="0 0 30 30"
											xml:space="preserve" xmlns="">
											<style type="text/css">
												.st0 {
													fill: none;
													stroke: #000000;
													stroke-width: 2;
													stroke-linejoin: round;
													stroke-miterlimit: 10;
												}
	
												.st1 {
													fill: none;
													stroke: #000000;
													stroke-width: 2;
													stroke-linecap: round;
													stroke-linejoin: round;
													stroke-miterlimit: 10;
												}
											</style>
											<path class="st0"
												d="m10 25.9h9.2v-5.5c0-0.6-3.7-2.4-6.7-3.7v-2.4s1.2-0.4 1.2-3c0.8 0 1.2-2.4 0-2.4 0-0.3 0.9-1.6 0.6-3-0.6-2.4-6.7-2.4-7.3 0-2.6-0.5-0.6 2.7-0.6 3-1.2 0-0.8 2.4 0 2.4 0 2.6 1.2 3 1.2 3v2.4c-3 1.2-6.7 3-6.7 3.7v5.5h9.1z" />
											<path class="st1"
												d="m22.3 25.9h6.7v-5.5c0-0.6-3-1.5-5.5-2.4v-1.8s1.2-0.3 1.2-2.4c0.7 0 0.9-2.4 0-2.4 0-0.2 1-1.3 0.6-2.4-0.6-1.8-5.5-1.8-6.1 0-2.1-0.4-0.6 2.2-0.6 2.4-1 0-0.7 2.4 0 2.4 0 2.1 1.2 2.4 1.2 2.4v1.2" />
										</svg>
									</span>
									<span class="tour-meta">10 Members</span>
								</li>
								<li> <span class="tour-meta-icon">
										<span></span>
										<svg enable-background="new 0 0 30 30" version="1.1" viewBox="0 0 30 30"
											xml:space="preserve" xmlns="">
											<style type="text/css">
												.st0 {
													fill: none;
													stroke: #000000;
													stroke-width: 2;
													stroke-linejoin: round;
													stroke-miterlimit: 10;
												}
	
												.st1 {
													fill: none;
													stroke: #000000;
													stroke-width: 2;
													stroke-linecap: round;
													stroke-linejoin: round;
													stroke-miterlimit: 10;
												}
											</style>
											<polyline class="st0"
												points="24.1 5.9 26.6 5.9 29 20.5 1 20.5 3.4 5.9 6.2 5.9" />
											<path class="st1"
												d="M29,26c0,1-0.8,1.8-1.8,1.8H2.8C1.8,27.8,1,27,1,26v-5.5h28V26z" />
											<line class="st1" x1="3" x2="27" y1="10.7" y2="10.7" />
											<polygon class="st1" points="13.2 8.3 5.9 8.3 6.4 4.7 13.3 4.7" />
											<polygon class="st1" points="17.1 8.3 24.4 8.3 23.9 4.7 17 4.7" />
											<path class="st1"
												d="m3.4 5.9v-3c0-1 0.8-1.8 1.8-1.8h19.5c1 0 1.8 0.8 1.8 1.8v3" />
											<line class="st1" x1="4.7" x2="4.7" y1="27.8" y2="29" />
											<line class="st1" x1="25.3" x2="25.3" y1="27.8" y2="29" />
											<line class="st1" x1="13.3" x2="17" y1="6" y2="6" />
										</svg>
									</span>
									<span class="tour-meta">HOTEL ACCOMMODATION</span>
								</li>
								<li> <span class="tour-meta-icon">
										<span></span>
										<svg enable-background="new 0 0 30 30" version="1.1" viewBox="0 0 30 30"
											xml:space="preserve" xmlns="">
											<style type="text/css">
												.st0 {
													fill: none;
													stroke: #000000;
													stroke-width: 2;
													stroke-linecap: round;
													stroke-linejoin: round;
													stroke-miterlimit: 10;
												}
											</style>
											<path
												d="m9.5 5.3c-0.3 0-0.6 0.3-0.6 0.6s0.3 0.6 0.6 0.6 0.6-0.3 0.6-0.6c0-0.4-0.2-0.6-0.6-0.6z" />
											<path
												d="m12 4c-0.3 0-0.6 0.3-0.6 0.6s0.3 0.6 0.6 0.6 0.6-0.3 0.6-0.6-0.3-0.6-0.6-0.6z" />
											<path
												d="m18 4c-0.3 0-0.6 0.3-0.6 0.6s0.3 0.6 0.6 0.6 0.6-0.3 0.6-0.6c0.1-0.3-0.2-0.6-0.6-0.6z" />
											<path
												d="m15 5.3c-0.3 0-0.6 0.3-0.6 0.6s0.3 0.6 0.6 0.6 0.6-0.3 0.6-0.6c0-0.4-0.3-0.6-0.6-0.6z" />
											<path
												d="m20.5 5.3c-0.3 0-0.6 0.3-0.6 0.6s0.3 0.6 0.6 0.6 0.6-0.3 0.6-0.6c0-0.4-0.2-0.6-0.6-0.6z" />
											<polyline class="st0" points="15 20.5 22.3 24.1 26 20.5" />
											<path class="st0"
												d="m29 22.9c0 1.3-1.1 2.4-2.4 2.4h-23.2c-1.3 0-2.4-1.1-2.4-2.4s1.1-2.4 2.4-2.4h23.1c1.4 0 2.5 1.1 2.5 2.4z" />
											<path class="st0"
												d="m26.6 15.6c1.3 0 2.4 1.1 2.4 2.4s-1.1 2.4-2.4 2.4h-23.2c-1.3 0.1-2.4-1-2.4-2.4 0-1.3 1.1-2.4 2.4-2.4" />
											<path class="st0"
												d="M3.4,25.3v1.2c0,1.3,1.1,2.4,2.4,2.4h18.3c1.3,0,2.4-1.1,2.4-2.4v-1.2H3.4z" />
											<path class="st0" d="m26.6 12c0-6.4-5.2-11-11.6-11s-11.6 4.6-11.6 11h23.2z" />
											<path class="st0"
												d="m3.4 12s-2.4 0.5-2.4 1.8 1.1 1.8 2.4 1.8c0.6 0 1.4-0.2 1.8-0.6 0.6 1.1 1.7 1.8 3 1.8 1.5 0 2.5-0.5 3-1.8 0.6 1.3 2.2 1.8 3.7 1.8s3.1-0.5 3.7-1.8c0.6 1.3 1.5 1.8 3 1.8 1.4 0 2.4-0.7 3-1.8 0.4 0.4 1.2 0.6 1.8 0.6 1.3 0 2.4-0.5 2.4-1.8s-2.4-1.8-2.4-1.8" />
										</svg>
									</span>
									<span class="tour-meta">BREAKFAST</span>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>


		<div id="content-wrapper" class="site-page tour-single " style="padding-top: 10rem !important;">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-main-content">
						<article id="post-323"
							class="post-323 tour type-tour status-publish has-post-thumbnail hentry tour-destination-united-arab-emirates tour-type-adventure tour-type-beaches tour-type-cruises tour-month-february tour-month-january">
							<ul class="tour-tabs clearfix">
								<li data-tab="tour-detail" class="active">Details</li>
								<li data-tab="tour-location">Location</li>
								<li data-tab="tour-gallery">Photos</li>
							</ul>

							<div class="post-content entry-content">
								<div id="tour-detail" class="tour-detail active">
									<h3 class="detail-title">Tour overview</h3>
									<p><?= $row_package['description'] ?></p>
									<div class="tour-include">
										<?php
										if($row_package['included']!='')
										{
										?>
										<h3 class="detail-title">Included</h3>
										<ul class="clearfix">
											<?php 
											
												$included= explode(',',$row_package['included']);
												// echo count($included);
												for($i=0; $i<count($included); $i++)
												{
											?>
											<li><i class="fa fa-check" aria-hidden="true"></i><?= ucwords($included[$i]) ?></li>
											<?php 
												}	
											?>
										</ul>
										<?php 
											}	
										?>
									</div>
									<a class="btn btn-inspiry-download"
										href="assets/content/uploads/2017/11/Brochure.pdf"
										download="Brochure.pdf">
										<i class="fa fa-download" aria-hidden="true"></i>
										Download pdf brochure </a>
								</div>
								
								<div id="tour-location" class="tour-location">
									<section>
										<div id="tour-map">
											<?= $row_package['location_link'] ?>
										</div>
									</section>
									<a class="btn btn-inspiry-download"
										href="assets/content/uploads/2017/11/Brochure.pdf"
										download="Brochure.pdf">
										<i class="fa fa-download" aria-hidden="true"></i>
										Download pdf brochure </a>
								</div>
								<div id="tour-gallery" class="tour-gallery">
									<section>
										<ul class="gallery-images inspiry-popup clearfix">
											<?php
											if(mysqli_num_rows($result_image))
											{
												while($row_image=mysqli_fetch_assoc($result_image))
												{
											?>
											<li>
												<img src="images/packages/<?= $row_image['image_path'] ?>"
													alt="Gallery Thumbnail">
												<a
													href="images/packages/<?= $row_image['image_path'] ?>">
													<div class="overlay">
														<img src="assets/content/themes/img/tour-gallery-icon.png"
															alt="Gallery Icon">
													</div>
												</a>
											</li>
											<?php
												}
											}
											?>
										</ul>
									</section>
									<a class="btn btn-inspiry-download"
										href="assets/content/uploads/2017/11/Brochure.pdf"
										download="Brochure.pdf">
										<i class="fa fa-download" aria-hidden="true"></i>
										Download pdf brochure </a>
								</div>
							</div>
						</article>
						<div class="tour-review white-bg">
							<header>
								<h2>Tours Reviews</h2>
							</header>
							<div class="review-wrapper">

								<div id="comments">
									<ol class="comment-list">

									<?php

										$comments_sql="select comments.package_id as package_id, comments.comment_text as comment_text, comments.rating as rating, comments.timestamp as timestamp, users.name as username, users.user_image as user_image from comments join users on comments.user_id=users.id where comments.package_id={$package_id} and comments.is_deleted=0";

										$result_comments=mysqli_query($con, $comments_sql);
										if(mysqli_num_rows($result_comments)>0)
										{
											while($row_comment=mysqli_fetch_assoc($result_comments))
											{
												$formattedDate = date("F j, Y", strtotime($row_comment['timestamp']));
									?>

										<li class="comment byuser comment-author-mrsaqibtp bypostauthor even thread-even depth-1 clearfix"
											id="comment-22">
											<article class="comment-body clearfix">

												<div class="author-photo">
													<img alt='' src='images/users/<?= $row_comment['user_image'] ?>' srcset='images/users/<?= $row_comment['user_image'] ?>' class='avatar avatar-114 photo' height='114' width='114' loading='lazy' decoding='async' />
													<p>
														<span class="rating">
															<?php 
															
															for($i=0; $i<$row_comment['rating']; $i++)
															{
																echo '<i class="fa fa-star-o rated"></i>';
															}

															for ($i=0; $i<5-$row_comment['rating']; $i++) { 
																echo '<i class="fa fa-star-o"></i>';
															}


															?>
														</span>
													</p>
												</div>

												<div class="comment-wrapper">
													<div class="comment-meta clearfix">
														<div class="comment-author vcard">
															<h5 class="fn"><?= ucwords($row_comment['username']) ?></h5>
														</div>
														<div class="comment-metadata">
															<a href="#!">
																<span><?= $formattedDate ?></span> 
															</a>
														</div>
													</div>

													<div class="comment-content entry-content">
														<p>
															<?= ucfirst($row_comment['comment_text']) ?>
														</p>
													</div>
												</div>

											</article>
											<!-- end of comment -->
										</li><!-- #comment-## -->

									<?php

											}
										}
									?>

									</ol><!-- .comment-list -->


									<?php
									if(isset($_SESSION['user_id']))
									{
										$sql_check_comments="select * from comments where user_id={$_SESSION['user_id']} and package_id={$package_id}";
										$result_check_comments=mysqli_query($con, $sql_check_comments);

										$sql_check_orders="select * from orders where user_id={$_SESSION['user_id']} and package_id={$package_id}";
										$result_check_orders=mysqli_query($con, $sql_check_orders);

										if(mysqli_num_rows($result_check_comments)==0 && mysqli_num_rows($result_check_orders)>0)
										{									
									
									?>


									<div id="respond" class="comment-respond">
										<h3 id="reply-title" class="comment-reply-title">Leave a Review <small><a
													rel="nofollow" id="cancel-comment-reply-link"
													href="index.html#respond" style="display:none;">Cancel reply</a></small></h3>
										<form action="" method="post" id="commentform" class="comment-form" novalidate onsubmit="return validateReviewForm()">
											<div class="inspiry-comment-rating">
												<div class="rating-box">
													<select id="rate-it" name="rating">
														<option value="1">1</option>
														<option value="2">2</option>
														<option value="3">3</option>
														<option value="4">4</option>
														<option value="5">5</option>
													</select>
												</div>
											</div>

											<p class="comment-form-comment">
												<label for="comment">
													Comment <span class="required">*</span>
												</label> 
												<textarea id="comment-text" name="comment-text" cols="45" rows="8" maxlength="65525" placeholder="Write Your Review" required></textarea>
											</p>
											
											<p class="form-submit">
												<input type='hidden' name='package-id' value='<?= $package_id ?>' id='package-id' />
												<input type="submit" name="submit-review" id="submit-review" class="submit" value="Post Comment" /> 
											</p>
										</form>

										<script>
											function validateReviewForm()
											{
												let rating=document.getElementById('rate-it').value;
												let comment=document.getElementById('comment-text').value;
												let package_id=document.getElementById('package-id').value;

												if(rating=='')
												{
													alert('Please Give Some Rating');
													return false;
												}
												else if(comment=='')
												{
													alert('Please Write Review');  
													return false;  
												}
												else
												{
													console.log(rating, comment, package_id);
													return true;
												}
											}
										</script>
									</div><!-- #respond -->

									<?php
										}
									}
									?>
								</div><!-- #comments -->
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sidebar">
						<aside id="sidebar-tour-detail" class="sidebar widget-area">
							<section id="inspiry_booking_widget" class="widget inspiry_booking_widget">
								<header style="background-repeat: no-repeat; background-size: cover; background-position: center center;">
									<span><svg xmlns=""
											xmlns:xlink="" version="1.1" x="0px" y="0px"
											viewBox="0 0 216.316 216.316"
											style="enable-background:new 0 0 216.316 216.316;" xml:space="preserve"
											width="512px" height="512px">
											<g>
												<g>
													<path
														d="M207.449,8.626C201.89,3.064,194.404,0,186.369,0c-8.557,0-16.676,3.408-22.868,9.598l-30.984,33.115L25.956,10.816    L5.153,31.621c-2.205,2.202-3.417,5.134-3.417,8.251c0.002,3.115,1.215,6.045,3.419,8.247l0.664,0.666l79.943,43.999    l-28.174,30.563c-2.094,2.106-3.941,4.374-5.522,6.781l-34.871-9.025L3.29,135.01c-4.063,4.063-4.063,10.676,0,14.741l0.745,0.747    l39.745,20.16l2.11,2.11l20.163,39.745l0.743,0.743c1.971,1.973,4.589,3.06,7.378,3.06c2.784,0,5.4-1.085,7.368-3.05    l13.905-13.905l-9.201-35.554c2.299-1.537,4.466-3.315,6.481-5.317l30.702-28.306l43.882,79.729l0.452,0.824l0.666,0.664    c2.204,2.206,5.134,3.421,8.251,3.421c3.115,0,6.045-1.215,8.247-3.419l20.805-20.803l-32.11-107.283l32.852-30.738    c5.954-5.952,9.358-13.764,9.587-21.995C216.297,22.214,213.238,14.415,207.449,8.626z M197.281,43.073l-38.68,36.185    l32.198,107.57l-13.605,13.605l-50.312-91.417L83.67,148.851l-0.194,0.187c-2.345,2.348-4.973,4.243-7.81,5.641l-4.828,2.379    l9.911,38.299l-5.685,5.685l-18.331-36.134l-5.09-5.09l-36.127-18.325l5.685-5.687l37.722,9.761l2.352-4.909    c1.399-2.917,3.337-5.626,5.764-8.055l39.888-43.263L16.118,39.361l13.605-13.605l106.852,31.983l36.348-38.858    c3.683-3.646,8.453-5.652,13.444-5.652c4.501,0,8.665,1.686,11.729,4.75c3.19,3.192,4.876,7.536,4.744,12.236    C202.706,35.054,200.676,39.674,197.281,43.073z"
														fill="#FFFFFF" />
												</g>
											</g>
										</svg>
									</span>
									<h2 class="widget-title">Book the tour</h2>
								</header>

								<form action="" class="tour-booking" id="contact-form" method="post" onsubmit="return validateBookingForm()">
									<p>
										<input type="hidden" name="package-id" id="package-id" value="<?= $package_id ?>">
										<input type="text" name="name" id="name" placeholder="Name" class="required" title="* Please provide your name.">
									</p>
									<p>
										<input type="email" name="email" id="email" placeholder="Email" class="email required" title="* Please provide your valid email address.">
									</p>
									<p class="half">
										<input type="number" name="no-person" id="no-person"  placeholder="No. of Person" class="required" title="* Please provide number of persons." min="1">
									</p>
									<p class="half">
										<input type="text" name="phone" id="phone" placeholder="Phone">
									</p>
									<p>
										<input type="date" name="tour-date" id="tour-date" placeholder="Phone" min="<?= date('Y-m-d', strtotime('+1 day')) ?>">
									</p>
									<div class="submission-area">
										<?php 
											if(isset($_SESSION['user_id']))
											{
												echo '<input type="submit" name="book-now-button" id="book-now-button" value="Book Now">';
											}
											else
											{
												echo '<a class="btn btn-inspiry-download" href="login.php" style="width: 100%; color: #fff;">Login</a>';
											}
										?>
										
									</div>
								</form>

								<!-- script for Book Now form  -->
								<script>
									// function for validating the booking form 
									function validateBookingForm()
									{
										let package_id=document.getElementById('package-id').value;
										let name=document.getElementById('name').value;
										let email=document.getElementById('email').value;
										let no_person=document.getElementById('no-person').value;
										let phone=document.getElementById('phone').value;
										let tour_date=document.getElementById('tour-date').value;

										if(package_id=='')
										{
											alert('Something Went Wrong! Please Refresh The Page');
											return false;
										}
										else if(name=='')
										{
											alert('Please Enter Name');
											return false;
										}
										else if(email=='')
										{
											alert('Please Enter Email');
											return false;
										}
										else if(!validateEmail(email))
										{
											alert('Please Enter Valid Email');
											return false;
										}
										else if(no_person=='')
										{
											alert('Please Enter Number of Person');
											return false;
										}
										else if(no_person<1)
										{
											alert('Please Enter Valid Number of Person');
											return false;
										}
										else if(phone=='')
										{
											alert('Please Enter Phone Number');
											return false;
										}
										else if(!validatePhoneNumber(phone))
										{
											alert('Please Enter Valid Phone Number');
											return false;
										}
										
										else if(tour_date=='')
										{
											alert('Please Select Tour Date');
											return false;
										}
										else
										{
											console.log(package_id, name, email, no_person, phone, tour_date);
											return true;
										}

									}

									// Phone number validation function
									function validatePhoneNumber(phoneNumber) {
										const phoneRegex = /^\d{10}$/; // Assumes a 10-digit phone number format
										return phoneRegex.test(phoneNumber);
									}

									// Email validation function
									function validateEmail(email) {
										const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
										return emailRegex.test(email);
									}


								</script>
								<div id="error-container"></div>
								<div id="message-container"></div>
							</section>

							<section id="inspiry_share_widget-2" class="widget clearfix inspiry_share_widget">
								<h2 class="widget-title">Share with us</h2>
								<div class="social-share">

									<ul class="social-buttons clearfix">
										<li class="facebook">
											<a href="https://www.facebook.com/preetholiday">
												<i class="fa fa-facebook" aria-hidden="true"></i> </a>
										</li>
										<li class="twitter">
											<a href="https://youtube.com/@PreetHolidays?si=scfRKg5XJ-yflJt6"
												target="_blank" title="Tweet this!">
												<i class="fa fa-youtube" aria-hidden="true"></i> </a>
										</li>
										<li class="pinterest">
											<a href="https://in.pinterest.com/preetholidays1/"
												target="_blank" title="Pin this!">
												<i class="fa fa-pinterest-p" aria-hidden="true"></i> </a>
										</li>
									</ul>
								</div>
							</section>

							<section id="inspiry_tours_widget-2" class="widget clearfix inspiry_tours_widget">
								<h2 class="widget-title">Popular Tours</h2>


								<?php 
									$most_rated_sql="SELECT package_id, round(avg(rating)) AS avrage_rating, COUNT(package_id) total_rating FROM comments GROUP BY package_id ORDER BY avrage_rating DESC LIMIT 2";
									$most_rated_result=mysqli_query($con, $most_rated_sql);
									if(mysqli_num_rows($most_rated_result)>0)
									{
										while($row_most_rated=mysqli_fetch_assoc($most_rated_result))
										{
											$most_rated_package_sql="select * from packages where package_id={$row_most_rated['package_id']} and is_deleted=0";
											$most_rated_package_result=mysqli_query($con, $most_rated_package_sql);
											if(mysqli_num_rows($most_rated_package_result)==1)
											{
												$most_rated_package_row=mysqli_fetch_assoc($most_rated_package_result);
								?>
									<div class="tour-destination">
										<a href="tour.php?package-id=<?= $row_most_rated['package_id'] ?>">
											<figure>
												<img width="720" height="560"
													src="images/packages/<?= $most_rated_package_row['main_image'] ?>" class="attachment-inspiry_image_size_720_560 size-inspiry_image_size_720_560 wp-post-image" alt="" decoding="async" loading="lazy" srcset="images/packages/<?= $most_rated_package_row['main_image'] ?> 720w, images/packages/<?= $most_rated_package_row['main_image'] ?> 300w, images/packages/<?= $most_rated_package_row['main_image'] ?> 768w, images/packages/<?= $most_rated_package_row['main_image'] ?> 600w, images/packages/<?= $most_rated_package_row['main_image'] ?> 1000w" sizes="(max-width: 720px) 100vw, 720px" />
													<span class="offer-price">
														<?php 
															if($most_rated_package_row['old_price']>$most_rated_package_row['new_price'])
															{
														?>
														<i>&#8377;<?= number_format($most_rated_package_row['old_price']) ?></i>
														<?php 
															}
														?>
														&#8377;<?= number_format($most_rated_package_row['new_price']) ?>
													</span>
												<div class="content">
													<h3><?= ucwords($most_rated_package_row['name']) ?></h3>
													<span class="rating">

													<?php 
														for($i=0; $i<$row_most_rated['avrage_rating']; $i++)
														{
															echo '<i class="fa fa-star-o rated"></i>';
														}

														for ($i=0; $i<5-$row_most_rated['avrage_rating']; $i++) { 
															echo '<i class="fa fa-star-o"></i>';
														}
													?>
														
													</span>
												</div>
											</figure>
										</a>
									</div>
									
								<?php
											}
										}
									}
								?>

							</section>
						</aside><!-- .sidebar .widget-area -->
					</div><!-- col-md-4 -->
				</div>
				<div class="row">
					<div class="similar-tours-wrap">
						<div class="col-md-12">
							<header>
								<h3>Similar Tours</h3>
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
							</header>
						</div>
						<div class="similar-tours tours-listing">
							
						<?php
							$sql_package="select * from packages where package_id!={$package_id} and category_id={$row_package['category_id']} and is_deleted=0 order by timestamp limit 3";
							$result_package=mysqli_query($con, $sql_package);

							if(mysqli_num_rows($result_package)>0)
							{
								while($row_package=mysqli_fetch_assoc($result_package))
								{

							
							
						?>
						<div class="col-xs-12 col-sm-4">
							<div class="tour-post clearfix tour-post-full-width">
								<figure>
									<a href="tour.php?package-id=<?= $row_package['package_id'] ?>">
										<img width="720" height="560" src="images/packages/<?= $row_package['main_image'] ?>" class="attachment-inspiry_image_size_720_560 size-inspiry_image_size_720_560 wp-post-image" alt="" decoding="async" loading="lazy" srcset="images/packages/<?= $row_package['main_image'] ?> 720w, images/packages/<?= $row_package['main_image'] ?> 300w, images/packages/<?= $row_package['main_image'] ?> 600w" sizes="(max-width: 720px) 100vw, 720px" />
									</a>
									<span class="tour-meta"> 
										<span class="tour-meta-icon">
											<span><?= strtoupper($row_package['best_month']) ?></span>
											<svg enable-background="new 0 0 32 32" version="1.1" viewBox="0 0 32 32"
												xml:space="preserve" xmlns="">
												<style type="text/css">
													.st0 {
														fill: none;
														stroke: #000000;
														stroke-width: 2.6;
														stroke-linecap: round;
														stroke-linejoin: round;
														stroke-miterlimit: 10;
													}
												</style>
												<polyline class="st0"
													points="6.9 4.4 2 4.4 2 30 30 30 30 4.4 25.1 4.4" />
												<rect class="st0" x="6.9" y="2" width="3.7" height="4.9" />
												<rect class="st0" x="21.5" y="2" width="3.7" height="4.9" />
												<line class="st0" x1="10.5" x2="21.5" y1="4.4" y2="4.4" />
												<line class="st0" x1="2" x2="30" y1="10.5" y2="10.5" />
												<line class="st0" x1="9.3" x2="9.3" y1="13" y2="27.6" />
												<line class="st0" x1="15.4" x2="15.4" y1="13" y2="27.6" />
												<line class="st0" x1="21.5" x2="21.5" y1="13" y2="27.6" />
												<line class="st0" x1="4.4" x2="27.6" y1="15.4" y2="15.4" />
												<line class="st0" x1="4.4" x2="27.6" y1="20.3" y2="20.3" />
												<line class="st0" x1="4.4" x2="27.6" y1="25.1" y2="25.1" />
											</svg>
										</span>

										<span class="tour-meta-icon">
											<span><?= $row_package['tour_duration'] ?> Days</span>
											<svg enable-background="new 0 0 32 32" version="1.1" viewBox="0 0 32 32"
												xml:space="preserve" xmlns="">
												<style type="text/css">
													.st0 {
														fill: none;
														stroke: #000000;
														stroke-width: 2.6;
														stroke-linecap: round;
														stroke-linejoin: round;
														stroke-miterlimit: 10;
													}
												</style>
												<circle class="st0" cx="16" cy="16" r="13.5" />
												<polyline class="st0" points="15.4 9.5 15.4 16 22.5 22.5" />
											</svg>
										</span>
									
										<span class="tour-meta-icon">
											<span><?= strtoupper($row_package['country']).', '.strtoupper($row_package['city']) ?></span>
											<svg enable-background="new 0 0 32 32" version="1.1" viewBox="0 0 32 32"
												xml:space="preserve" xmlns="">
												<style type="text/css">
													.st0 {
														fill: none;
														stroke: #000000;
														stroke-width: 2.6;
														stroke-linecap: round;
														stroke-linejoin: round;
														stroke-miterlimit: 10;
													}
												</style>
												<path class="st0"
													d="m25.1 11.1c0 5-9.1 18.9-9.1 18.9s-9.1-13.8-9.1-18.9c0-5 4.1-9.1 9.1-9.1s9.1 4.1 9.1 9.1z" />
												<circle class="st0" cx="16" cy="11.1" r="3.7" />
											</svg>
										</span>
									</span>
									<div class="sunlight">
										<i class="fa fa-sun-o" aria-hidden="true"></i>
										<span class="tour-days"><?= $row_package['tour_duration'] ?> <i>days</i></span>
									</div>
								</figure>

								<div class="offer-content">
									<h3>
										<a href="tour.php?package-id=<?= $row_package['package_id'] ?>"><?= ucwords($row_package['name']) ?></a>
									</h3>
									<span class="rating">
									<?php 

									$sql_find_rating="select package_id, round(avg(rating)) as rating, count(package_id) as total_rating from comments where package_id={$row_package['package_id']} and is_deleted=0";
									$result_find_rating=mysqli_query($con, $sql_find_rating);

									if(mysqli_num_rows($result_find_rating)>0)
									{
										$row_find_rating=mysqli_fetch_assoc($result_find_rating);

										if($row_find_rating['total_rating']>0)
										{
											for($i=0; $i<$row_find_rating['rating']; $i++)
											{
												echo '<i class="fa fa-star-o rated"></i>';
											}

											for ($i=0; $i<5-$row_find_rating['rating']; $i++) { 
												echo '<i class="fa fa-star-o"></i>';
											}
										}
										else
										{
											echo '<i class="fa fa-star-o rated"></i>';
											echo '<i class="fa fa-star-o rated"></i>';
											echo '<i class="fa fa-star-o rated"></i>';
											echo '<i class="fa fa-star-o rated"></i>';
											echo '<i class="fa fa-star-o rated"></i>';
										}
									}
									?>
									</span>

									<p class="package-desc"><?= $row_package['description'] ?></p>

									<?php
										$discount_price=round(100-(($row_package['new_price']*100)/$row_package['old_price']));
										if($discount_price>0)
										{
									?>

									<div class="discount-label">
										<?= $discount_price ?>% <span>Discount</span>
									</div>

									<?php } ?>


									<?php 
									
									if($row_package['old_price']>$row_package['new_price'])
									{
									?>
									<span class="old-price">&#8377;<?= $row_package['old_price'] ?></span>
									<?php } ?>
									<span class="tour-price">&#8377;<?= $row_package['new_price'] ?></span> 
									<a href="tour.php?package-id=<?= $row_package['package_id'] ?>" class="read-more">View More</a>
								</div>
							</div>
						</div>

						<?php
								}
							}
						?>

							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>

<?php include('footer.php'); ?>
