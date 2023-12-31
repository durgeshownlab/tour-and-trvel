<?php 

include('header.php'); 

if(isset($_GET['destination-id']) && !empty($_GET['destination-id']))
{
	$destination_id=mysqli_real_escape_string($con, $_GET['destination-id']);

	$sql_destination="select destination_state.banner_image as banner_image, states.state_name as state_name from destination_state join states on destination_state.state_id=states.id where destination_state.id=$destination_id and destination_state.is_deleted=0";
	$result_destination=mysqli_query($con, $sql_destination);
	if(mysqli_num_rows($result_destination)==1)
	{
		$row_destination=mysqli_fetch_assoc($result_destination);
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

?>

		<div id="site-banner"
			style="background-image: url(images/destination_state/<?= $row_destination['banner_image'] ?>);">
			<div class="banner-content">
				<h1>Destination: <span><?= $row_destination['state_name'] ?></span></h1>
				<ul id="inspiry_breadcrumbs" class="inspiry_breadcrumbs">
					<li class="breadcrumb-item"><a href="index.php" title="Home">Home</a></li>
					<li>&gt;</li>
					<li class="breadcrumb-item item-cat item-custom-post-type-tour"><a
							class="bread-cat bread-custom-post-type-tour" href="tours.php"
							title="Tours">Tours</a></li>
					<li>&gt;</li>
					<li class="breadcrumb-item active"><span>Destination</span></li>
				</ul>
			</div>
		</div>
		<!-- tours listing -->
		<div id="content-wrapper" class="site-page tour-listing">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-main-content tours-list-container">
						<div class="tours-listing">
							<div class="row">

							<?php
							$sql_package="select * from packages where state='{$row_destination['state_name']}' and is_deleted=0 order by timestamp";
							$result_package=mysqli_query($con, $sql_package);

							if(mysqli_num_rows($result_package)>0)
							{
								while($row_package=mysqli_fetch_assoc($result_package))
								{

							
							
						?>

								<div class="col-xs-12 col-sm-6 col-lg-12">
									<div class="tour-post clearfix tour-post-full-width">
										<figure>
											<a href="tour.php?package-id=<?= $row_package['package_id'] ?>">
												<img width="720" height="560" src="images/packages/<?= $row_package['main_image'] ?>" class="attachment-inspiry_image_size_720_560 size-inspiry_image_size_720_560 wp-post-image" alt="" decoding="async" />
											</a>
											<span class="tour-meta"> 
												<span class="tour-meta-icon">
													<span><?= strtoupper($row_package['best_month']) ?></span>
													<svg enable-background="new 0 0 32 32" version="1.1" viewBox="0 0 32 32" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
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
														<polyline class="st0" points="6.9 4.4 2 4.4 2 30 30 30 30 4.4 25.1 4.4" />
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
													<span><?= strtoupper($row_package['tour_duration']) ?> Days</span>
													<svg enable-background="new 0 0 32 32" version="1.1" viewBox="0 0 32 32" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
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
													<span><?= ucwords($row_package['country']) ?></span>
													<svg enable-background="new 0 0 32 32" version="1.1" viewBox="0 0 32 32" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
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
														<path class="st0" d="M27.6,13H9.3l-2.4-2.5H2l3.7,7.3h9.7l-7.3,7.3h6.1l7.3-7.3h6.1c1.3,0,2.4-1.1,2.4-2.4C30,14,28.9,13,27.6,13z" />
														<polyline class="st0" points="21.5 13 15.4 6.9 10.5 6.9 16.6 13" />
													</svg>
												</span>
												<span class="tour-meta-icon">
													<span><?= strtoupper($row_package['city']) ?></span>
													<svg enable-background="new 0 0 32 32" version="1.1" viewBox="0 0 32 32" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
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
														<path class="st0" d="m25.1 11.1c0 5-9.1 18.9-9.1 18.9s-9.1-13.8-9.1-18.9c0-5 4.1-9.1 9.1-9.1s9.1 4.1 9.1 9.1z" />
														<circle class="st0" cx="16" cy="11.1" r="3.7" />
													</svg>
												</span>
											</span>
											<div class="sunlight">
												<i class="fa fa-sun-o" aria-hidden="true"></i>
												<span class="tour-days"><?= strtoupper($row_package['tour_duration']) ?> <i>days</i></span>
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
											<p><?= ucfirst($row_package['description']) ?></p>

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
											<span class="old-price">&#8377; <?= number_format($row_package['old_price']) ?></span>
											<?php } ?>

											<span class="tour-price">&#8377; <?= number_format($row_package['new_price']) ?></span> 
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
	</div> <!-- #site-wrapper -->

	<?php include('footer.php'); ?>
