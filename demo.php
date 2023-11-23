<?php 

include ('header.php'); 

if(isset($_GET['cat-id']) && !empty($_GET['cat-id']))
{
	$cat_id=htmlspecialchars($_GET['cat-id']);

	$sql_cat="select * from category where id=$cat_id and is_deleted=0";
	$result_cat=mysqli_query($con, $sql_cat);
	if(mysqli_num_rows($result_cat)==1)
	{
		$row_cat=mysqli_fetch_assoc($result_cat);
	}
	else
	{
		// exit;
	}
}
else
{
	// exit;
}

?>

<div id="site-banner" style="background-image: url(assets/content/uploads/2017/11/quino-al-404693.jpg);">
	<div class="banner-content">
		<h1>Type: <span>
				<?= ucwords($row_cat['name']) ?>
			</span></h1>
		<ul id="inspiry_breadcrumbs" class="inspiry_breadcrumbs">
			<li class="breadcrumb-item"><a href="index.php" title="Home">Home</a></li>
			<li>&gt;</li>
			<li class="breadcrumb-item item-cat item-custom-post-type-tour"><a
					class="bread-cat bread-custom-post-type-tour" href="tours.php" title="Tours">Tours</a></li>
			<li>&gt;</li>
			<li class="breadcrumb-item active"><span>
					<?= ucwords($row_cat['name']) ?>
				</span></li>
		</ul>
	</div>
</div>
<!-- tours listing -->
<div id="content-wrapper" class="site-page tour-listing">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-main-content tours-list-container">
				<div class="tours-listing">
					<div class="row">
						<?php
								$sql_package="select * from packages where category_id={$cat_id} and is_deleted=0 order by timestamp";
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
										<img width="720" height="560"
											src="images/packages/<?= $row_package['main_image'] ?>"
											class="attachment-inspiry_image_size_720_560 size-inspiry_image_size_720_560 wp-post-image"
											alt="" decoding="async"
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
												<?= strtoupper($row_package['country']).', '.strtoupper($row_package['city']) ?>
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
									<p>
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
			<div class="col-md-4 col-sidebar">
				<aside id="sidebar-tour" class="sidebar widget-area">
					<section id="inspiry_tours_search_widget-2" class="widget clearfix inspiry_tours_search_widget">
						<h2 class="widget-title">Find Tours</h2>
						<div>
							<form id="tours-search" action="https://tourpress.inspirythemes.com/tour-search-page/"
								class="clearfix">

								<p class="form-field tour-destination">
									<svg version="1.1" class="icon-map-pin" xmlns="http://www.w3.org/2000/svg"
										xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px"
										height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24"
										xml:space="preserve">
										<path fill-rule="evenodd" clip-rule="evenodd"
											d="M12,20c0,0-6-6.688-6-10.001s2.687-6,6-6c3.314,0,6,2.686,6,6S12,20,12,20L12,20z
	 M12,5.999c-2.209,0-4,1.791-4,4C8,12.209,9.791,14,12,14c2.209,0,4-1.791,4-4.001C16,7.79,14.209,5.999,12,5.999L12,5.999z" />
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
								</p>

								<p class="form-field tour-type">
									<svg version="1.1" class="icon-type-list" xmlns="http://www.w3.org/2000/svg"
										xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px"
										height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24"
										xml:space="preserve">
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
								</p>

								<p class="form-field tour-month">
									<svg version="1.1" class="icon-calendar" xmlns="http://www.w3.org/2000/svg"
										xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px"
										height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24"
										xml:space="preserve">
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
								</p>

								<p class="form-field max-price">
									<input type="text" name="max_price" value="" placeholder="Maximum Price">
								</p>

								<input type="submit" value="Search">

							</form>
						</div>
					</section>
					<section id="inspiry_top_rated_tours_widget-4"
						class="widget clearfix inspiry_top_rated_tours_widget">
						<h2 class="widget-title">Top Rated Tours</h2>
						<ul>
							<li class="clearfix">
								<div class="content">
									<h4><a href="../blog/tour/historic-istanbul/index.html">Historic
											Istanbul</a></h4>
									<span class="rating"><i class="fa fa-star-o rated"></i><i
											class="fa fa-star-o rated"></i><i class="fa fa-star-o rated"></i><i
											class="fa fa-star-o rated"></i><i
											class="fa fa-star-o rated"></i></span><span
										class="offer-price"><i>$1,200</i>$990</span>
								</div>
								<figure>
									<a href="../blog/tour/historic-istanbul/index.html">
										<img width="70" height="70"
											src="../../tourpress.b-cdn.net/wp-content/uploads/2017/11/istanbul-featured-150x150.jpg"
											class="attachment-78x70 size-78x70 wp-post-image" alt="" decoding="async"
											loading="lazy"
											srcset="https://tourpress.b-cdn.net/wp-content/uploads/2017/11/istanbul-featured-150x150.jpg 150w, https://tourpress.b-cdn.net/wp-content/uploads/2017/11/istanbul-featured-300x300.jpg 300w, https://tourpress.b-cdn.net/wp-content/uploads/2017/11/istanbul-featured-100x100.jpg 100w"
											sizes="(max-width: 70px) 100vw, 70px" /> </a>
								</figure>
							</li>
							<li class="clearfix">
								<div class="content">
									<h4><a href="../blog/tour/magical-maldives/index.html">Magical Maldives</a>
									</h4>
									<span class="rating"><i class="fa fa-star-o rated"></i><i
											class="fa fa-star-o rated"></i><i class="fa fa-star-o rated"></i><i
											class="fa fa-star-o rated"></i><i
											class="fa fa-star-o rated"></i></span><span class="offer-price">$900</span>
								</div>
								<figure>
									<a href="../blog/tour/magical-maldives/index.html">
										<img width="70" height="70"
											src="../../tourpress.b-cdn.net/wp-content/uploads/2017/11/maldives-featured-150x150.jpg"
											class="attachment-78x70 size-78x70 wp-post-image" alt="" decoding="async"
											loading="lazy"
											srcset="https://tourpress.b-cdn.net/wp-content/uploads/2017/11/maldives-featured-150x150.jpg 150w, https://tourpress.b-cdn.net/wp-content/uploads/2017/11/maldives-featured-300x300.jpg 300w, https://tourpress.b-cdn.net/wp-content/uploads/2017/11/maldives-featured-100x100.jpg 100w"
											sizes="(max-width: 70px) 100vw, 70px" /> </a>
								</figure>
							</li>
							<li class="clearfix">
								<div class="content">
									<h4><a href="../blog/tour/venice-the-city-of-water/index.html">Venice The
											City of Water</a></h4>
									<span class="rating"><i class="fa fa-star-o rated"></i><i
											class="fa fa-star-o rated"></i><i class="fa fa-star-o rated"></i><i
											class="fa fa-star-o rated"></i><i
											class="fa fa-star-o rated"></i></span><span class="offer-price">$850</span>
								</div>
								<figure>
									<a href="../blog/tour/venice-the-city-of-water/index.html">
										<img width="70" height="70"
											src="../../tourpress.b-cdn.net/wp-content/uploads/2017/11/venice-featured-150x150.jpg"
											class="attachment-78x70 size-78x70 wp-post-image" alt="" decoding="async"
											loading="lazy"
											srcset="https://tourpress.b-cdn.net/wp-content/uploads/2017/11/venice-featured-150x150.jpg 150w, https://tourpress.b-cdn.net/wp-content/uploads/2017/11/venice-featured-300x300.jpg 300w, https://tourpress.b-cdn.net/wp-content/uploads/2017/11/venice-featured-100x100.jpg 100w"
											sizes="(max-width: 70px) 100vw, 70px" /> </a>
								</figure>
							</li>
						</ul>
					</section>
					<section id="inspiry_recent_posts_widget-4" class="widget clearfix inspiry_recent_posts_widget">
						<h2 class="widget-title">Recent Posts</h2>
						<ul>
							<li class="clearfix">
								<div class="content">
									<h4><a href="../blog/try-living-a-simple-life/index.html">Try Living A
											Simple Life</a></h4>
									<span class="entry-date"><i class="fa fa-calendar-check-o"></i> <time
											datetime="2017-12-11">December 11, 2017</time></span>
								</div>
								<figure>
									<a href="../blog/try-living-a-simple-life/index.html">
										<img width="70" height="70"
											src="../../tourpress.b-cdn.net/wp-content/uploads/2017/10/patrick-hendry-150x150.jpg"
											class="attachment-78x70 size-78x70 wp-post-image" alt="" decoding="async"
											loading="lazy"
											srcset="https://tourpress.b-cdn.net/wp-content/uploads/2017/10/patrick-hendry-150x150.jpg 150w, https://tourpress.b-cdn.net/wp-content/uploads/2017/10/patrick-hendry-300x300.jpg 300w, https://tourpress.b-cdn.net/wp-content/uploads/2017/10/patrick-hendry-100x100.jpg 100w"
											sizes="(max-width: 70px) 100vw, 70px" /> </a>
								</figure>
							</li>
							<li class="clearfix">
								<div class="content">
									<h4><a href="../blog/start-writing-a-journal/index.html">Start Writing A
											Journal</a></h4>
									<span class="entry-date"><i class="fa fa-calendar-check-o"></i> <time
											datetime="2017-12-10">December 10, 2017</time></span>
								</div>
								<figure>
									<a href="../blog/start-writing-a-journal/index.html">
										<img width="70" height="70"
											src="../../tourpress.b-cdn.net/wp-content/uploads/2017/10/cathryn-lavery-67851-150x150.jpg"
											class="attachment-78x70 size-78x70 wp-post-image" alt="" decoding="async"
											loading="lazy"
											srcset="https://tourpress.b-cdn.net/wp-content/uploads/2017/10/cathryn-lavery-67851-150x150.jpg 150w, https://tourpress.b-cdn.net/wp-content/uploads/2017/10/cathryn-lavery-67851-300x300.jpg 300w, https://tourpress.b-cdn.net/wp-content/uploads/2017/10/cathryn-lavery-67851-100x100.jpg 100w"
											sizes="(max-width: 70px) 100vw, 70px" /> </a>
								</figure>
							</li>
							<li class="clearfix">
								<div class="content">
									<h4><a href="../blog/make-running-a-part-of-life/index.html">Make Running A
											Part of Life</a></h4>
									<span class="entry-date"><i class="fa fa-calendar-check-o"></i> <time
											datetime="2017-12-09">December 9, 2017</time></span>
								</div>
								<figure>
									<a href="../blog/make-running-a-part-of-life/index.html">
										<img width="70" height="70"
											src="../../tourpress.b-cdn.net/wp-content/uploads/2017/10/jenny-hill-150x150.jpg"
											class="attachment-78x70 size-78x70 wp-post-image" alt="" decoding="async"
											loading="lazy"
											srcset="https://tourpress.b-cdn.net/wp-content/uploads/2017/10/jenny-hill-150x150.jpg 150w, https://tourpress.b-cdn.net/wp-content/uploads/2017/10/jenny-hill-300x300.jpg 300w, https://tourpress.b-cdn.net/wp-content/uploads/2017/10/jenny-hill-100x100.jpg 100w"
											sizes="(max-width: 70px) 100vw, 70px" /> </a>
								</figure>
							</li>
						</ul>
					</section>
				</aside>
			</div>
		</div>
	</div>
</div>
</div>

<?php include ('footer.php'); ?>