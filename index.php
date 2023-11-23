<?php include('header.php'); ?>

<div id="content-wrapper" role="main" class="home-page">
	<div class="flexslider home-slider loading">
		<ul class="slides">

			<?php

			$sql_banenr="select banners.banner_name as banner_name, banners.banner_image as banner_image, banners.banner_text as banner_text, packages.name as package_name, packages.new_price as package_price, packages.country as country, packages.city as city, packages.tour_duration as tour_duration, packages.package_id as package_id from banners join packages on banners.package_id=packages.package_id where banners.is_deleted=0 and packages.is_deleted=0";
			$result_banner=mysqli_query($con, $sql_banenr);

			if(mysqli_num_rows($result_banner)>0)
			{
				while($row_bannner=mysqli_fetch_assoc($result_banner))
				{

			
			
			?>

			<li class="slide">
				<div>
					<img src="images/banner/<?= $row_bannner['banner_image'] ?>" alt="slide" />
					<header class="hidden-xs">
						<span>
							<?= ucwords($row_bannner['banner_text']) ?>
						</span>
						<h2>
							<a href="tour.php?package-id=<?= $row_bannner['package_id'] ?>">
								<?= ucwords($row_bannner['banner_name']) ?>
							</a>
						</h2>
					</header>

					<div class="detail visible-lg">
						<div class="location cleafix">
							<svg version="1.1" class="icon-map-pin" xmlns="" xmlns:xlink="" x="0px" y="0px" width="24px"
								height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24"
								xml:space="preserve">
								<path fill-rule="evenodd" clip-rule="evenodd"
									d="M12,20c0,0-6-6.688-6-10.001s2.687-6,6-6c3.314,0,6,2.686,6,6S12,20,12,20L12,20z M12,5.999c-2.209,0-4,1.791-4,4C8,12.209,9.791,14,12,14c2.209,0,4-1.791,4-4.001C16,7.79,14.209,5.999,12,5.999L12,5.999z" />
							</svg>
							<span>
								<?= strtoupper($row_bannner['country']).', '.strtoupper($row_bannner['city']) ?>
							</span>
						</div>
						<div class="days clearfix">
							<svg xmlns="" xmlns:xlink="" version="1.1" x="0px" y="0px" viewBox="0 0 408.809 408.809"
								style="enable-background:new 0 0 408.809 408.809;" xml:space="preserve" width="512px"
								height="512px">
								<g>
									<g>
										<path
											d="M406.96,201.137l-24.094-14.457c-11.922-7.152-15.078-23.027-6.801-34.199l16.726-22.574    c1.711-2.309,0.344-5.614-2.5-6.035l-27.793-4.137c-13.754-2.047-22.742-15.504-19.371-28.988l6.817-27.262    c0.695-2.789-1.832-5.317-4.621-4.617l-27.262,6.813c-13.488,3.371-26.942-5.617-28.988-19.367l-4.138-27.798    c-0.422-2.844-3.722-4.211-6.035-2.5l-22.578,16.73c-11.172,8.278-27.043,5.117-34.195-6.805L207.671,1.849    c-1.481-2.465-5.054-2.465-6.531,0l-14.457,24.094c-7.152,11.922-23.023,15.082-34.195,6.805l-22.578-16.73    c-2.313-1.711-5.614-0.344-6.035,2.5l-4.137,27.797c-2.047,13.75-15.5,22.738-28.988,19.367l-27.262-6.813    c-2.789-0.699-5.317,1.828-4.621,4.617l6.817,27.262c3.371,13.488-5.617,26.942-19.371,28.988l-27.793,4.137    c-2.844,0.422-4.215,3.726-2.5,6.035l16.726,22.574c8.278,11.172,5.121,27.047-6.801,34.199L1.852,201.137    c-2.469,1.481-2.469,5.054,0,6.535l24.094,14.457c11.922,7.152,15.078,23.023,6.801,34.195L16.02,278.898    c-1.715,2.313-0.344,5.614,2.5,6.039l27.793,4.137c13.754,2.043,22.742,15.5,19.371,28.988l-6.818,27.262    c-0.695,2.789,1.832,5.317,4.621,4.617l27.258-6.817c13.488-3.371,26.946,5.621,28.992,19.371l4.137,27.793    c0.422,2.848,3.722,4.215,6.035,2.5l22.578-16.726c11.168-8.278,27.039-5.121,34.191,6.801l14.461,24.098    c1.481,2.465,5.05,2.465,6.531,0l14.457-24.098c7.156-11.922,23.027-15.078,34.195-6.801l22.578,16.726    c2.313,1.715,5.614,0.348,6.035-2.5l4.137-27.793c2.047-13.75,15.504-22.742,28.988-19.371l27.262,6.817    c2.789,0.699,5.317-1.828,4.621-4.617l-6.817-27.262c-3.371-13.488,5.617-26.946,19.371-28.988l27.793-4.137    c2.844-0.426,4.211-3.726,2.5-6.039l-16.73-22.574c-8.272-11.171-5.116-27.042,6.802-34.195l24.098-14.457    C409.425,206.192,409.425,202.618,406.96,201.137z M330.026,229.458c-9.55,50.383-50.18,91.016-100.562,100.566    c-90.176,17.098-167.774-60.496-150.68-150.672c9.547-50.383,50.18-91.016,100.562-100.566    C269.522,61.689,347.12,139.278,330.026,229.458z"
											fill="#FFFFFF" />
									</g>
							</svg>
							<?= strtoupper($row_bannner['tour_duration']) ?> <span>days</span>
						</div>
						<div class="price clearfix">
							<span class="figure">₹
								<?= number_format($row_bannner['package_price']) ?>
							</span>
							<a href="tour.php?package-id=<?= $row_bannner['package_id'] ?>">
								<span class="arrow">
									<img class="img-fluid" src="assets/content/themes/img/slider/arrow.png" alt="arrow">
								</span>
							</a>
						</div>
					</div>

				</div>
			</li>

			<?php 	
				}
			}
			?>
		</ul>
	</div>
	<div id="search-form-wrapper" class="search-form-trapezoid">
		<div class="search-form">
			<form id="tours-search" action="#" class="clearfix">
				<div class="form-field tour-destination">
					<svg version="1.1" class="icon-map-pin" xmlns="" xmlns:xlink="" x="0px" y="0px" width="24px"
						height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M12,20c0,0-6-6.688-6-10.001s2.687-6,6-6c3.314,0,6,2.686,6,6S12,20,12,20L12,20z M12,5.999c-2.209,0-4,1.791-4,4C8,12.209,9.791,14,12,14c2.209,0,4-1.791,4-4.001C16,7.79,14.209,5.999,12,5.999L12,5.999z" />
					</svg>
					<select name="destination" id="tour-destination">
						<option value="">Destination (Any)</option>
						<option value="australia">Australia</option>
						<option value="brazil">Brazil</option>
						<option value="italy">Italy</option>
						<option value="maldives">Maldives</option>
						<option value="singapore">Singapore</option>
						<option value="united-arab-emirates">United Arab Emirates</option>
						<option value="united-kingdom">United Kingdom</option>
						<option value="turkey">Turkey</option>
					</select>
				</div>
				<div class="form-field tour-type">
					<svg version="1.1" class="icon-type-list" xmlns="" xmlns:xlink="" x="0px" y="0px" width="24px"
						height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
						<path d="M19,8H8.999C8.447,8,8,7.554,8,7c0-0.552,0.447-1,0.999-1H19c0.552,0,0.999,0.448,0.999,1C19.999,7.554,19.552,8,19,8L19,8z
	 M19,13.002H8.999C8.447,13.002,8,12.553,8,12c0-0.552,0.447-1,0.999-1H19c0.552,0,0.999,0.448,0.999,1
	C19.999,12.553,19.552,13.002,19,13.002L19,13.002z M19,18H8.999C8.447,18,8,17.553,8,17.001c0-0.553,0.447-1,0.999-1H19
	c0.552,0,0.999,0.447,0.999,1C19.999,17.553,19.552,18,19,18L19,18z M5.001,8c-0.553,0-1-0.446-1-1c0-0.552,0.447-1,1-1
	C5.553,6,6,6.448,6,7C6,7.554,5.553,8,5.001,8L5.001,8z M5.001,13.002c-0.553,0-1-0.449-1-1.002c0-0.552,0.447-1,1-1
	C5.553,11,6,11.448,6,12C6,12.553,5.553,13.002,5.001,13.002L5.001,13.002z M5.001,18c-0.553,0-1-0.447-1-0.999c0-0.553,0.447-1,1-1
	c0.552,0,0.999,0.447,0.999,1C6,17.553,5.553,18,5.001,18L5.001,18z" />
					</svg>
					<select name="type" id="tour-type">
						<option value="">Tour Type (Any)</option>
						<option value="wildlife">Wildlife</option>
						<option value="air-rides">Air Rides</option>
						<option value="tracking">Tracking</option>
						<option value="adventure">Adventure</option>
						<option value="beaches">Beaches</option>
						<option value="cruises">Cruises</option>
					</select>
				</div>
				<div class="form-field tour-month">
					<svg version="1.1" class="icon-calendar" xmlns="" xmlns:xlink="" x="0px" y="0px" width="24px"
						height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M19.334,22.5H4.666C3.194,22.5,2,21.325,2,19.876V4.124
	C2,2.675,3.194,1.5,4.666,1.5h14.668C20.806,1.5,22,2.675,22,4.124v15.752C22,21.325,20.806,22.5,19.334,22.5L19.334,22.5z
	 M20.666,4.124c0-0.724-0.596-1.312-1.332-1.312H4.666c-0.735,0-1.332,0.588-1.332,1.312v1.313h17.332V4.124L20.666,4.124z
	 M20.666,6.749H3.334v13.127c0,0.724,0.597,1.312,1.332,1.312h14.668c0.736,0,1.332-0.588,1.332-1.312V6.749L20.666,6.749z
	 M17.333,18.562c-1.104,0-2-0.881-2-1.967c0-1.089,0.896-1.971,2-1.971c1.105,0,2.001,0.882,2.001,1.971
	C19.334,17.681,18.438,18.562,17.333,18.562L17.333,18.562z M18,15.937h-1.334v1.313H18V15.937L18,15.937z M17.333,13.312
	c-1.104,0-2-0.88-2-1.969c0-1.087,0.896-1.967,2-1.967c1.105,0,2.001,0.88,2.001,1.967C19.334,12.432,18.438,13.312,17.333,13.312
	L17.333,13.312z M18,10.687h-1.334v1.313H18V10.687L18,10.687z M12,18.562c-1.104,0-1.999-0.881-1.999-1.967
	c0-1.089,0.896-1.971,1.999-1.971s1.999,0.882,1.999,1.971C13.999,17.681,13.104,18.562,12,18.562L12,18.562z M12.667,15.937h-1.334
	v1.313h1.334V15.937L12.667,15.937z M12,13.312c-1.104,0-1.999-0.88-1.999-1.969c0-1.087,0.896-1.967,1.999-1.967
	s1.999,0.88,1.999,1.967C13.999,12.432,13.104,13.312,12,13.312L12,13.312z M12.667,10.687h-1.334v1.313h1.334V10.687L12.667,10.687
	z M6.667,18.562c-1.105,0-2.001-0.881-2.001-1.967c0-1.089,0.896-1.971,2.001-1.971c1.104,0,2,0.882,2,1.971
	C8.667,17.681,7.771,18.562,6.667,18.562L6.667,18.562z M7.333,15.937H6v1.313h1.333V15.937L7.333,15.937z M6.667,13.312
	c-1.105,0-2.001-0.88-2.001-1.969c0-1.087,0.896-1.967,2.001-1.967c1.104,0,2,0.88,2,1.967C8.667,12.432,7.771,13.312,6.667,13.312
	L6.667,13.312z M7.333,10.687H6v1.313h1.333V10.687L7.333,10.687z" />
					</svg>
					<select name="month" id="tour-month">
						<option value="">Tour Month (Any)</option>
						<option value="january">January</option>
						<option value="february">February</option>
						<option value="march">March</option>
						<option value="april">April</option>
						<option value="may">May</option>
						<option value="june">June</option>
						<option value="july">July</option>
						<option value="august">August</option>
						<option value="september">September</option>
						<option value="october">October</option>
						<option value="november">November</option>
						<option value="december">December</option>
					</select>
				</div>
				<div class="form-field max-price">
					<input type="text" name="max_price" value="" placeholder="Maximum Price">
				</div>
				<input type="submit" value="Search">
			</form>
		</div>
		<div class="search-trapezoid"></div>
	</div>


	<!-- destination by mood -->
	<section class="home-section sky-bg"
		style="background-repeat: no-repeat; background-size: auto; background-position: center center; background-color: #fff; 	">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="section-heading">
						<h2>Select your Destination by Mood</h2>
						<p>In the mood to travel? You have to be more specific! and, match your mood to your
							destination!
						</p>
					</div>
					<div class="home-mood-destination">
						<div class="row">
							<?php 

							$sql_cat="select * from category where is_deleted=0";
							$result_cat=mysqli_query($con, $sql_cat);
							
							if(mysqli_num_rows($result_cat)>0)
							{
								while($row_cat=mysqli_fetch_assoc($result_cat))
								{

							?>
							<div class="col-xs-6 col-sm-3 col-md-2">
								<a href="tour-type.php?cat-id=<?=$row_cat['id']?>">
									<figure>
										<img src="images/category/<?= $row_cat['image'] ?>" alt="Adventure">
										<div class="overlay">
											<img src="images/category/<?=$row_cat['icon']?>">
											<span>
												<?=$row_cat['name']?>
											</span>
										</div>
									</figure>
								</a>
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
	</section>



	<!-- featured packages -->
	<section class="home-section dark-bg">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="section-heading">
						<h2>Our Packages</h2>
						<p>Our Packages allow you to get away from routine, spend time with family and
							friends.</p>
					</div>
					<div class="row tours-listing">
						<?php
							$sql_package="select * from packages where is_deleted=0 order by timestamp";
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
										<img width="720" height="560"
											src="images/packages/<?= $row_package['main_image'] ?>"
											class="attachment-inspiry_image_size_720_560 size-inspiry_image_size_720_560 wp-post-image"
											alt="" decoding="async" loading="lazy"
											srcset="images/packages/<?= $row_package['main_image'] ?> 720w, images/packages/<?= $row_package['main_image'] ?> 300w, images/packages/<?= $row_package['main_image'] ?> 600w"
											sizes="(max-width: 720px) 100vw, 720px" />
									</a>
									<span class="tour-meta">
										<span class="tour-meta-icon">
											<span>
												<?= strtoupper($row_package['best_month']) ?>
											</span>
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
											<span>
												<?= $row_package['tour_duration'] ?> Days
											</span>
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
											<span>
												<?= strtoupper($row_package['country']) ?>,
												<?= strtoupper($row_package['city']) ?>
											</span>
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
										<span class="tour-days">
											<?= $row_package['tour_duration'] ?> <i>days</i>
										</span>
									</div>
								</figure>

								<div class="offer-content">
									<h3>
										<a href="tour.php?package-id=<?= $row_package['package_id'] ?>">
											<?= ucwords($row_package['name']) ?>
										</a>
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

									<p class="package-desc">
										<?= $row_package['description'] ?>
									</p>

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
									<span class="old-price">&#8377;
										<?= $row_package['old_price'] ?>
									</span>
									<?php } ?>
									<span class="tour-price">&#8377;
										<?= $row_package['new_price'] ?>
									</span>
									<a href="tour.php?package-id=<?= $row_package['package_id'] ?>"
										class="read-more">View More</a>
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
	</section>


	<!-- travel destinations -->
	<section class="full-section no-bottom-padding">
		<div class="container-fluid">
			<div class="row">
				<div class="section-heading">
					<h2>Travel Destinations</h2>
					<p>Check out the list of countries and places you can travel to by joining us.</p>
				</div>
				<div class="travel-destinations">
					<div class="clearfix">

						<?php 
						$sql_destination_state="select destination_state.id as destination_id, destination_state.state_text as state_text, destination_state.min_temp as min_temp, destination_state.max_temp as max_temp, destination_state.state_image as state_image, states.state_name as state_name from destination_state join states on destination_state.state_id=states.id where destination_state.is_deleted=0 limit 8";
						$result_destination_state=mysqli_query($con, $sql_destination_state);
						if(mysqli_num_rows($result_destination_state)>0)
						{
							while($row_destination_state=mysqli_fetch_assoc($result_destination_state))
							{
								$sql_package_for_dest_state="select count(package_id) total_packages from packages where state='{$row_destination_state['state_name']}' and is_deleted=0";
								$result_package_for_dest_state=mysqli_query($con, $sql_package_for_dest_state);
								if(mysqli_num_rows($result_package_for_dest_state)>0)
								{
									$row_package_for_dest_state=mysqli_fetch_assoc($result_package_for_dest_state);
								}
								
					?>


						<div class="col-xs-12 col-sm-6 travel-destination no-padding col-md-3">
							<figure>
								<div class="image-container">
									<img class="img-responsive"
										src="images/destination_state/<?= $row_destination_state['state_image'] ?>"
										alt="Australia">

									<?php 

										$sql_for_images="select package_images.image_path from packages join package_images on package_images.package_id=packages.package_id where packages.state='{$row_destination_state['state_name']}' and packages.is_deleted=0";
										$result_for_images=mysqli_query($con, $sql_for_images);

										if(mysqli_num_rows($result_for_images)>0)
										{
											while($row_for_image=mysqli_fetch_assoc($result_for_images))
											{
												echo '<img class="img-responsive" src="images/packages/'.$row_for_image['image_path'].'" alt="Alternate Image 1">';
											}
										}

										?>
								</div>
								<div class="overlay">
									<div class="temperature">
										<span class="label">Local Temperature</span>
										<span class="degree">
											<?= $row_destination_state['min_temp'] ?> <sup>0</sup> /
											<?= $row_destination_state['max_temp'] ?> <sup>0</sup>
										</span>
									</div>
									<div class="location">
										<header>
											<h2><a
													href="destination.php?destination-id=<?= $row_destination_state['destination_id'] ?>">
													<?= ucwords($row_destination_state['state_name']) ?>
												</a>
											</h2>
										</header>
										<div class="detail">
											<p class="hidden-md four-line-text">
												<?= ucfirst($row_destination_state['state_text']) ?>
											</p>

											<?php 
											if($row_package_for_dest_state['total_packages']>0)
											{
											?>
											<span class="label">Packages in
												<?= ucwords($row_destination_state['state_name']) ?>
											</span>
											<span class="number">
												<?= $row_package_for_dest_state['total_packages'] ?>
											</span>

											<?php 
											}
											?>
										</div>
									</div>
								</div>
							</figure>
						</div>

						<?php
							}
						}
					?>




					</div>
				</div>
			</div>
		</div>
	</section>


	<!-- blog -->
	<section class="home-section">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="section-heading">
						<h2>Our Blogs</h2>
						<p>Find out our latest news, promotions and professional tips.</p>
					</div>
					<div class="blog-posts">
						<div class="row">
							<div class="col-sm-6 col-md-4">
								<article id="post-240"
									class="post-240 post type-post status-publish format-standard has-post-thumbnail hentry category-improve-life category-life category-self-discipline tag-relax tag-self-discipline tag-time-management">

									<figure class="blog-entry-thumbnail">
										<a href="blog.php">
											<img width="720" height="560"
												src="assets/content/uploads/2017/10/patrick-hendry-720x560.jpg"
												class="img-fluid wp-post-image" alt="" decoding="async"
												loading="lazy" /> </a>
									</figure>
									<div class="post-content">
										<h3 class="entry-title">
											<a href="blog.php">Try Living A
												Simple Life</a>
										</h3>
										<div class="blog-entry-meta">
											<span class="meta-item entry-date"><i class="fa fa-calendar-check-o"></i>
												<time datetime="2017-12-11">December 11, 2017</time></span>
											<span class="meta-item entry-category"><i class="fa fa-folder-open-o"></i>
												<a href="blogs.php">Improve
													Life</a></span>
										</div>
										<p>
											Many people want a simple life away from all the... </p>
										<span class="meta-item entry-author"><i class="fa fa-user-o"></i> <a
												class="author-url" href="team.php" rel="author">John Doe</a> </span> <a
											href="blog.php" class="read-more">more</a>
									</div>
								</article>
							</div>
							<div class="col-sm-6 col-md-4">
								<article id="post-244"
									class="post-244 post type-post status-publish format-standard has-post-thumbnail hentry category-improve-life category-productivity category-self-discipline tag-productivity tag-tools tag-work">

									<figure class="blog-entry-thumbnail">
										<a href="blog.php">
											<img width="720" height="560"
												src="assets/content/uploads/2017/10/cathryn-lavery-67851-720x560.jpg"
												class="img-fluid wp-post-image" alt="" decoding="async"
												loading="lazy" /> </a>
									</figure>
									<div class="post-content">
										<h3 class="entry-title">
											<a href="blog.php">Start Writing A
												Journal</a>
										</h3>
										<div class="blog-entry-meta">
											<span class="meta-item entry-date"><i class="fa fa-calendar-check-o"></i>
												<time datetime="2017-12-10">December 10, 2017</time></span>
											<span class="meta-item entry-category"><i class="fa fa-folder-open-o"></i>
												<a href="blogs.php">Improve
													Life</a></span>
										</div>
										<p>
											An ideal time to write, comfortable digs, a great... </p>
										<span class="meta-item entry-author"><i class="fa fa-user-o"></i> <a
												class="author-url" href="team.php" rel="author">John Doe</a> </span> <a
											href="blog.php" class="read-more">more</a>
									</div>
								</article>
							</div>
							<div class="clearfix visible-sm"></div>
							<div class="col-sm-6 col-md-4">
								<article id="post-242"
									class="post-242 post type-post status-publish format-standard has-post-thumbnail hentry category-improve-life category-productivity category-sport tag-productivity tag-self-discipline tag-sport">

									<figure class="blog-entry-thumbnail">
										<a href="blog.php">
											<img width="720" height="560"
												src="assets/content/uploads/2017/10/jenny-hill-720x560.jpg"
												class="img-fluid wp-post-image" alt="" decoding="async"
												loading="lazy" /> </a>
									</figure>
									<div class="post-content">
										<h3 class="entry-title">
											<a href="blog.php">Make Running A
												Part of Life</a>
										</h3>
										<div class="blog-entry-meta">
											<span class="meta-item entry-date"><i class="fa fa-calendar-check-o"></i>
												<time datetime="2017-12-09">December 9, 2017</time></span>
											<span class="meta-item entry-category"><i class="fa fa-folder-open-o"></i>
												<a href="blogs.php">Improve
													Life</a></span>
										</div>
										<p>
											Running improves your cardiovascular strength, lowers bad
											cholesterol and... </p>
										<span class="meta-item entry-author"><i class="fa fa-user-o"></i> <a
												class="author-url" href="team.php" rel="author">John Doe</a> </span> <a
											href="blog.php" class="read-more">more</a>
									</div>
								</article>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- testimonials -->
	<section class="home-section dark-bg">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="section-heading">
						<h2>Our Testimonials</h2>
						<p>Read reviews and opinions from our global travel community!</p>
					</div>
					<div class="home-testimonials">
						<div class="row">
							<?php

						$comments_sql="select comments.package_id as package_id, comments.comment_text as comment_text, comments.rating as rating, comments.timestamp as timestamp, users.name as username, users.user_image as user_image from comments join users on comments.user_id=users.id where comments.is_deleted=0 order by rating desc limit 2";

						$result_comments=mysqli_query($con, $comments_sql);
						if(mysqli_num_rows($result_comments)>0)
						{
							while($row_comment=mysqli_fetch_assoc($result_comments))
							{
						?>
							<div class="col-sm-6">
								<article class="testimonial" style="min-height: 270px !important;">
									<figure>
										<img width="100" height="100"
											src="images/users/<?= $row_comment['user_image'] ?>"
											class="attachment-100x100 size-100x100 wp-post-image" alt=""
											decoding="async" loading="lazy" />
									</figure>
									<div class="testimonial-content">
										<h3 class="author-name">
											<?= ucwords($row_comment['username']) ?>
										</h3>
										<p class="three-line-text">
											<?= ucfirst($row_comment['comment_text']) ?>
										</p>
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
									</div>
								</article>
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
	</section>

	<!-- Why Choose -->
	<section class="home-section home-section-features">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="section-heading">
						<h2>Why Choose PreetHoliday</h2>
						<p>We offer most competitive rates and offers for wonderful and beautiful places.</p>
					</div>
					<div class="home-features">
						<div class="row">
							<div class="col-sm-6 col-md-4">
								<div class="home-feature">

									<figure>
										<img src="assets/content/uploads/2017/10/feature-1.png" alt="icon">
									</figure>
									<h3>Unique Destinations</h3>
									<p>Looking for a unique vacation destination? Then maybe a trip to one of
										the 10 most unique tourist destinations might.</p>
								</div>
							</div>
							<div class="col-sm-6 col-md-4">
								<div class="home-feature">

									<figure>
										<img src="assets/content/uploads/2017/10/feature-2.png" alt="icon">
									</figure>
									<h3>Worth of Money</h3>
									<p>There is not a better way to spend money, than spending money on travel.
										This is what we say, others and science.</p>
								</div>
							</div>
							<div class="col-sm-6 col-md-4">
								<div class="home-feature">

									<figure>
										<img src="assets/content/uploads/2017/10/feature-3.png" alt="icon">
									</figure>
									<h3>Wonderful Places</h3>
									<p>We do our best to have you a wonderful experience by taking you to the
										wonderful and amazing places around the world.</p>
								</div>
							</div>
							<div class="col-sm-6 col-md-4">
								<div class="home-feature">

									<figure>
										<img src="assets/content/uploads/2017/10/feature-4.png" alt="icon">
									</figure>
									<h3>Quick Booking</h3>
									<p>Booking is quick as clicking a few clicks. We take care of all
										transportation and accommodations during your journey.</p>
								</div>
							</div>
							<div class="col-sm-6 col-md-4">
								<div class="home-feature">

									<figure>
										<img src="assets/content/uploads/2017/10/feature-5.png" alt="icon">
									</figure>
									<h3>Backup Team</h3>
									<p>We have staff to assist in all stages of your holiday, from travel advice
										&amp; best prices to ground handling &amp; support during your holiday.
									</p>
								</div>
							</div>
							<div class="col-sm-6 col-md-4">
								<div class="home-feature">

									<figure>
										<img src="assets/content/uploads/2017/10/feature-6.png" alt="icon">
									</figure>
									<h3>Exciting Travel</h3>
									<p>We have a wide range of expertise and knowledge in our services. So we
										can provide you an exciting travel experience.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- featured packages -->
	<section class="home-section dark-bg">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="section-heading">
						<h2>Visitors Choice</h2>
						<p>Our Visitors Packages allow you to get away from routine, spend time with family and
							friends.</p>
					</div>
					<div id="featured-packages" class="tours-listing owl-carousel owl-theme">

						<?php 
						$most_rated_sql="SELECT package_id, round(avg(rating)) AS avrage_rating, COUNT(package_id) total_rating FROM comments GROUP BY package_id ORDER BY avrage_rating DESC LIMIT 6";
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

						<div>
							<div class="tour-post clearfix tour-post-full-width">
								<figure>
									<a href="tour.php?package-id=<?= $most_rated_package_row['package_id'] ?>">
										<img width="720" height="560"
											src="images/packages/<?=$most_rated_package_row['main_image']?>"
											class="attachment-inspiry_image_size_720_560 size-inspiry_image_size_720_560 wp-post-image"
											alt="" decoding="async" loading="lazy" />
									</a>
									<span class="tour-meta"> <span class="tour-meta-icon">
											<span><?= strtoupper($most_rated_package_row['best_month']) ?></span>
											<svg enable-background="new 0 0 32 32" version="1.1" viewBox="0 0 32 32"
												xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
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
											<span><?= strtoupper($most_rated_package_row['tour_duration']) ?> Days</span>
											<svg enable-background="new 0 0 32 32" version="1.1" viewBox="0 0 32 32"
												xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
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
											<span><?= strtoupper($most_rated_package_row['country']) ?></span>
											<svg enable-background="new 0 0 32 32" version="1.1" viewBox="0 0 32 32"
												xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
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
													d="M27.6,13H9.3l-2.4-2.5H2l3.7,7.3h9.7l-7.3,7.3h6.1l7.3-7.3h6.1c1.3,0,2.4-1.1,2.4-2.4C30,14,28.9,13,27.6,13z" />
												<polyline class="st0" points="21.5 13 15.4 6.9 10.5 6.9 16.6 13" />
											</svg>
										</span>
										<span class="tour-meta-icon">
											<span><?= strtoupper($most_rated_package_row['city']) ?></span>
											<svg enable-background="new 0 0 32 32" version="1.1" viewBox="0 0 32 32"
												xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
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
										<span class="tour-days"><?= strtoupper($most_rated_package_row['tour_duration']) ?> <i>days</i></span>
									</div>
								</figure>
								<div class="offer-content">
									<h3><a href="tour.php?package-id=<?= $most_rated_package_row['package_id'] ?>"><?= strtoupper($most_rated_package_row['name']) ?></a>
									</h3>
									
									<?php 

									$sql_find_rating="select package_id, round(avg(rating)) as rating, count(package_id) as total_rating from comments where package_id={$most_rated_package_row['package_id']} and is_deleted=0";
									$result_find_rating=mysqli_query($con, $sql_find_rating);

									if(mysqli_num_rows($result_find_rating)>0)
									{
										$row_find_rating=mysqli_fetch_assoc($result_find_rating);

										if($row_find_rating['total_rating']>0)
										{
												

									?>
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

									<?php 
										}
									}
									
									?>
									<?php
										$discount_price=round(100-(($most_rated_package_row['new_price']*100)/$most_rated_package_row['old_price']));
										if($discount_price>0)
										{
									?>
										<div class="discount-label">
											<?= $discount_price ?>% 
											<span>Discount</span>
										</div>
									<?php
										}
									?>

									<?= $most_rated_package_row['old_price']>$most_rated_package_row['new_price'] ? '<span class="old-price">'.number_format($most_rated_package_row['old_price']).'</span>':'' ?>
									
									<span class="tour-price"><?= number_format($most_rated_package_row['new_price']) ?></span> 
									<a href="tour.php?package-id=<?= $most_rated_package_row['package_id'] ?>" class="read-more">View More</a>
								</div>
							</div>
						</div>


						<?php
								}
							}
						}
					?>

					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<!-- #site-wrapper -->

<script>
	document.querySelectorAll('.travel-destination').forEach((destination) => {
		destination.addEventListener('mouseenter', () => {
			const images = destination.querySelectorAll('.image-container img');
			let currentIndex = 0;

			const changeImage = () => {
				images[currentIndex].style.display = 'none';
				currentIndex = (currentIndex + 1) % images.length;
				images[currentIndex].style.display = 'block';
			};

			const interval = setInterval(changeImage, 1000);

			destination.addEventListener('mouseleave', () => {
				clearInterval(interval); // Stop changing images on mouse leave
				images[currentIndex].style.display = 'none';
				currentIndex = 0;
				images[currentIndex].style.display = 'block';
			});
		});
	});

</script>

<?php include('footer.php'); ?>