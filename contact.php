<?php 

include('header.php'); 

if(isset($_POST['submit-button']) && $_SERVER['REQUEST_METHOD']=='POST')
{
	if(isset($_POST['fname']) && empty($_POST['fname']))
	{
		exit;
	}
	else if(isset($_POST['phone']) && empty($_POST['phone']))
	{
		exit;
	}
	else if(isset($_POST['email']) && empty($_POST['email']))
	{
		exit;
	}
	else
	{
		$fname=mysqli_real_escape_string($con, $_POST['fname']);
		$phone=mysqli_real_escape_string($con, $_POST['phone']);
		$email=mysqli_real_escape_string($con, $_POST['email']);
		$message=mysqli_real_escape_string($con, $_POST['message']);

		$sql="insert into contact_us (name, mobile, email, message) values('{$fname}', '{$phone}', '{$email}', '{$message}')";
		if(mysqli_query($con, $sql))
		{
			echo "<script>alert('Enquery Sent Successfully')</script>";
			echo "<script>window.location.href='contact.php'</script>";
		}
		else
		{
			echo "<script>alert('Falied to Sent Enquery, Please Try Again')</script>";
			echo "<script>window.location.href='contact.php'</script>";
		}
	}

}


?>

<div id="site-banner" style="background-image: url(assets/content/uploads/2020/04/optimised-banner.jpg);">
	<div class="banner-content">
		<h1>Contact</h1>
		<ul id="inspiry_breadcrumbs" class="inspiry_breadcrumbs">
			<li class="breadcrumb-item"><a href="index.php" title="Home">Home</a></li>
			<li>&gt;</li>
			<li class="breadcrumb-item active item-current item-46"><span class="bread-current bread-46"> Contact</span>
			</li>
		</ul>
	</div>
</div>
<!-- contact -->
<div id="content-wrapper" class="site-page contact-page ">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-8 col-main-content">
				<!--contact form-->
				<section class="contact-section inspiry-box-shadow white-bg">
					<div class="contact-form">
						<p>You are so important to us, simply complete the enquiry form &amp; we will respond as soon as we can.</p>
						<form action="" id="contact-form" method="post" onsubmit="return validateForm()">
							<input type="text" name="fname" id="fname" placeholder="Full Name" title="* Please enter your full name." class="required">
							<input type="text" name="phone" id="phone" placeholder="Mobile">
							<input type="email" name="email" id="email" placeholder="Email" title="* Please enter your correct email." class="required email">
							<textarea name="message" id="message" cols="30" rows="10" placeholder="Message" title="* Please enter your message." class="required"></textarea>
							<div class="submission-area">
								<input type="submit" id="submit-button" name="submit-button" value="Submit">
							</div>
						</form>

						<!-- script for contact us form  -->
						<script>
							// function for validating the formm 
							function validateForm()
							{
								let fname=document.getElementById('fname').value;
								let phone=document.getElementById('phone').value;
								let email=document.getElementById('email').value;
								let message=document.getElementById('message').value;

								if(fname=='')
								{
									alert('Please Enter Name');
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
								else if(message=='')
								{
									alert('Please Enter Mmessage');
									return false;
								}
								else
								{
									console.log(fname, phone, email, message);
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
					</div>
				</section>
				
				<!--social profiles-->
				<section class="contact-section inspiry-box-shadow social-pro-wrap clearfix white-bg">
					<div class="social-profile">
						<h3>Stay Social</h3>
						<ul class="social-buttons clearfix">
							<li class="facebook">
								<a href="https://www.facebook.com/preetholiday" target="_blank">
									<i class="fa fa-facebook" aria-hidden="true"></i>
								</a>
							</li>
							<li class="twitter">
								<a href="https://www.youtube.com/@PreetHolidays" target="_blank">
									<i class="fa fa-youtube-play" aria-hidden="true"></i>
								</a>
							</li>
							<li class="instagram">
								<a href="https://www.instagram.com/preetholidays/" target="_blank">
									<i class="fa fa-instagram" aria-hidden="true"></i>
								</a>
							</li>
							<li class="pinterest">
								<a href="https://in.pinterest.com/preetholidays1/" target="_blank">
									<i class="fa fa-pinterest-p" aria-hidden="true"></i>
								</a>
							</li>
						</ul>
					</div>
				</section>

				<!--offices contact-->
				<section class="contact-section inspiry-box-shadow white-bg">
					<div class="offices-contact">

						<!--head office-->
						<h3>Head Office</h3>
						<div class="head-office clearfix">
							<div class="row">
								<div class="col-sm-6">
									<div class="office-contact">
										<h4>Delhi</h4>
										<address>H.no 11 Vijay Nagar kirari Suleman nager Delhi 86 Near by RC plaza</address>
										<div class="number">
											<svg version="1.1" xmlns="" xmlns:xlink="" x="0px" y="0px" width="30px" height="30px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
												<path d="M22.875,16.377c-0.12,0.126-0.291,0.199-0.468,0.199c-0.176,0-0.346-0.073-0.468-0.199
	c-0.121-0.127-0.192-0.302-0.192-0.485c0-0.184,0.071-0.36,0.192-0.486c0.122-0.126,0.292-0.2,0.468-0.2
	c0.171,0,0.342,0.069,0.468,0.2c0.121,0.126,0.193,0.303,0.193,0.486C23.068,16.075,22.996,16.25,22.875,16.377L22.875,16.377z
	 M17.516,7.502c-0.066,0.32-0.336,0.543-0.644,0.543c-0.044,0-0.094-0.006-0.138-0.019c-0.357-0.08-0.59-0.439-0.513-0.811
	c0.078-0.371,0.425-0.604,0.783-0.526C17.361,6.772,17.592,7.132,17.516,7.502L17.516,7.502z M21.682,11.026
	c-0.115,0.08-0.243,0.12-0.369,0.12c-0.214,0-0.423-0.108-0.551-0.303c-0.203-0.313-0.126-0.743,0.177-0.954
	c0.303-0.21,0.709-0.125,0.918,0.183C22.062,10.386,21.984,10.815,21.682,11.026L21.682,11.026z M19.925,8.839
	c-0.131,0.2-0.335,0.303-0.549,0.303c-0.128,0-0.254-0.036-0.369-0.116c-0.303-0.21-0.38-0.64-0.177-0.953
	c0.204-0.314,0.617-0.394,0.92-0.188C20.053,8.096,20.13,8.524,19.925,8.839L19.925,8.839z M22.501,13.726
	c-0.049,0.012-0.094,0.019-0.137,0.019c-0.303,0-0.578-0.218-0.645-0.542c-0.077-0.373,0.154-0.732,0.512-0.817
	c0.357-0.08,0.705,0.16,0.781,0.531C23.09,13.287,22.859,13.646,22.501,13.726L22.501,13.726z M14.61,7.799
	C14.488,7.924,14.317,8,14.142,8c-0.177,0-0.346-0.076-0.467-0.2c-0.122-0.126-0.192-0.303-0.192-0.486
	c0-0.182,0.071-0.36,0.192-0.484c0.122-0.126,0.291-0.2,0.467-0.2c0.175,0,0.346,0.074,0.468,0.2
	c0.121,0.125,0.192,0.303,0.192,0.484C14.802,7.497,14.731,7.673,14.61,7.799L14.61,7.799z M27.651,16.543
	c-0.121,0.124-0.292,0.199-0.468,0.199c-0.177,0-0.348-0.075-0.467-0.199c-0.122-0.126-0.192-0.303-0.192-0.486
	c0-0.183,0.07-0.36,0.192-0.487c0.119-0.124,0.29-0.198,0.467-0.198c0.171,0,0.342,0.068,0.468,0.198
	c0.121,0.127,0.192,0.304,0.192,0.487C27.844,16.24,27.772,16.417,27.651,16.543L27.651,16.543z M26.452,9.296
	c-0.099,0.051-0.198,0.074-0.297,0.074c-0.243,0-0.474-0.137-0.589-0.377c-0.16-0.337-0.028-0.749,0.297-0.919
	c0.324-0.166,0.721-0.028,0.886,0.309C26.915,8.719,26.782,9.129,26.452,9.296L26.452,9.296z M21.682,3.733
	c-0.115,0.24-0.348,0.376-0.589,0.376c-0.099,0-0.203-0.023-0.297-0.074c-0.331-0.172-0.457-0.583-0.297-0.914
	c0.164-0.343,0.561-0.479,0.886-0.309C21.714,2.986,21.846,3.396,21.682,3.733L21.682,3.733z M16.409,2.871
	c-0.004,0-0.011,0-0.021,0c-0.362-0.017-0.649-0.337-0.638-0.714C15.76,1.78,16.068,1.483,16.431,1.5
	c0.369,0.011,0.65,0.333,0.64,0.709C17.059,2.58,16.762,2.871,16.409,2.871L16.409,2.871z M19.453,2.717
	c-0.077,0.309-0.342,0.514-0.639,0.514c-0.055,0-0.11-0.005-0.166-0.023C18.297,3.11,18.083,2.74,18.17,2.38
	c0.088-0.371,0.451-0.587,0.805-0.497C19.331,1.974,19.541,2.352,19.453,2.717L19.453,2.717z M25.259,7.103
	c-0.122,0.103-0.265,0.155-0.414,0.155c-0.192,0-0.38-0.092-0.511-0.258c-0.232-0.297-0.183-0.724,0.099-0.964
	c0.286-0.24,0.698-0.195,0.931,0.101C25.588,6.435,25.545,6.863,25.259,7.103L25.259,7.103z M27.376,14.229
	c-0.005,0-0.017,0-0.021,0c-0.353,0-0.648-0.292-0.661-0.663c-0.016-0.382,0.271-0.695,0.638-0.707
	c0.365-0.012,0.673,0.286,0.684,0.663C28.025,13.898,27.739,14.218,27.376,14.229L27.376,14.229z M27.173,11.712
	c-0.055,0.017-0.11,0.021-0.166,0.021c-0.297,0-0.565-0.205-0.638-0.52c-0.088-0.364,0.127-0.741,0.479-0.833
	c0.353-0.091,0.715,0.132,0.803,0.499C27.739,11.243,27.525,11.62,27.173,11.712L27.173,11.712z M23.641,5.217
	c-0.128,0.172-0.32,0.257-0.512,0.257c-0.144,0-0.293-0.051-0.412-0.154c-0.286-0.24-0.331-0.667-0.105-0.964
	c0.231-0.297,0.644-0.343,0.93-0.103S23.871,4.92,23.641,5.217L23.641,5.217z M14.456,2.843c-0.122,0.125-0.292,0.2-0.468,0.2
	c-0.177,0-0.348-0.069-0.467-0.2c-0.122-0.126-0.194-0.303-0.194-0.486s0.072-0.358,0.194-0.484c0.12-0.126,0.291-0.2,0.467-0.2
	c0.175,0,0.346,0.074,0.468,0.2c0.122,0.126,0.192,0.301,0.192,0.484S14.578,2.717,14.456,2.843L14.456,2.843z M23.485,25.611
	c-0.182,0.188-0.367,0.371-0.545,0.554c-0.356,0.36-0.688,0.697-1.001,1.057c-0.731,0.851-1.7,1.279-2.877,1.279
	c-0.101,0-0.198-0.006-0.303-0.012c-1.388-0.08-2.807-0.508-4.464-1.342c-3.003-1.519-5.635-3.655-7.818-6.35
	c-1.75-2.165-2.999-4.329-3.819-6.613c-0.364-1.012-0.766-2.366-0.655-3.862C2.075,9.37,2.438,8.559,3.088,7.919
	c0.346-0.337,0.688-0.697,1.018-1.044c0.23-0.241,0.461-0.486,0.698-0.726C5.299,5.64,5.882,5.373,6.493,5.373
	c0.612,0,1.201,0.268,1.696,0.777C8.514,6.48,8.832,6.817,9.146,7.143c0.143,0.149,0.292,0.303,0.435,0.451
	c0.132,0.137,0.27,0.28,0.408,0.423c0.308,0.32,0.626,0.65,0.94,0.977c1.041,1.09,1.045,2.49,0.006,3.574l-0.32,0.332
	c-0.412,0.428-0.831,0.874-1.259,1.303c0.308,0.714,0.749,1.427,1.376,2.227c1.309,1.667,2.662,2.946,4.132,3.905
	c0.192,0.126,0.402,0.235,0.627,0.349c0.093,0.046,0.182,0.091,0.273,0.144c0.486-0.521,0.981-1.029,1.465-1.526l0.132-0.131
	c0.495-0.507,1.078-0.776,1.69-0.776c0.61,0,1.199,0.275,1.694,0.783c0.901,0.924,1.832,1.89,2.752,2.877
	C24.526,23.128,24.521,24.525,23.485,25.611L23.485,25.611z M22.595,23.007c-0.931-0.971-1.86-1.929-2.757-2.854
	c-0.171-0.173-0.446-0.383-0.765-0.383c-0.32,0-0.589,0.206-0.76,0.383l-0.133,0.131c-0.522,0.536-1.056,1.085-1.573,1.639
	c-0.22,0.24-0.474,0.36-0.749,0.36c-0.171,0-0.342-0.046-0.511-0.144c-0.133-0.073-0.271-0.143-0.414-0.217
	c-0.248-0.126-0.5-0.257-0.747-0.416c-1.597-1.04-3.055-2.416-4.458-4.203c-0.753-0.966-1.276-1.83-1.633-2.724
	c-0.237-0.583,0-0.989,0.237-1.229c0.461-0.463,0.924-0.943,1.37-1.41l0.318-0.337c0.528-0.554,0.523-1.09-0.006-1.644
	C9.707,9.632,9.389,9.307,9.08,8.988C8.942,8.85,8.804,8.708,8.667,8.563C8.518,8.41,8.375,8.261,8.228,8.107
	C7.918,7.782,7.6,7.45,7.28,7.126C7.105,6.949,6.834,6.743,6.51,6.743c-0.325,0-0.594,0.211-0.764,0.383
	C5.519,7.354,5.289,7.6,5.063,7.833c-0.341,0.354-0.688,0.72-1.046,1.074C3.599,9.319,3.385,9.799,3.34,10.42
	c-0.066,0.959,0.11,1.97,0.578,3.279c0.764,2.135,1.936,4.164,3.592,6.208c2.064,2.547,4.546,4.563,7.385,5.996
	c1.492,0.755,2.752,1.137,3.958,1.205c0.924,0.051,1.59-0.205,2.117-0.816c0.342-0.399,0.711-0.766,1.063-1.125
	c0.176-0.178,0.357-0.354,0.527-0.537C23.084,24.086,23.084,23.538,22.595,23.007L22.595,23.007z" />
											</svg>
											<span>9268393805</span>
										</div>
										<div class="email">
											<i class="fa fa-envelope-o" aria-hidden="true"></i>
											<a href="mailto: info@preetholiday.com">info@preetholiday.com</a>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="office-timing">
										<h4>Opening Times:</h4>
										<p class="open">
											Monday to Friday<span>9.00 am to 5.00 pm</span> </p>
										<p class="closed">Saturday &amp; Sunday<span>Closed</span></p>
									</div>
								</div>
							</div>
						</div>

						
					</div>
				</section>
				<!--google map-->
				<!-- <section class="contact-section inspiry-box-shadow map-wrap white-bg">
					<div class="google-map">
						<div id="contact-map">
						</div>
					</div>
				</section> -->
			</div>
			<div class="col-sm-12 col-md-4 col-sidebar">
				<aside id="sidebar-contact" class="sidebar widget-area">

					<section id="inspiry_tours_widget-3" class="widget clearfix inspiry_tours_widget">
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
				</aside>
			</div><!-- col-md-4 -->
		</div>
	</div>
</div>
</div> <!-- #site-wrapper -->

<?php include('footer.php'); ?>