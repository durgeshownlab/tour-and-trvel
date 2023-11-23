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
		exit;
	}
}
else
{
	exit;
}

?>

		<div id="site-banner"
			style="background-image: url(assets/content/uploads/2017/11/quino-al-404693.jpg);">
			<div class="banner-content">
				<h1>Type: <span><?= ucwords($row_cat['name']) ?></span></h1>
				<ul id="inspiry_breadcrumbs" class="inspiry_breadcrumbs">
					<li class="breadcrumb-item"><a href="index.php" title="Home">Home</a></li>
					<li>&gt;</li>
					<li class="breadcrumb-item item-cat item-custom-post-type-tour"><a
							class="bread-cat bread-custom-post-type-tour" href="tours.php"
							title="Tours">Tours</a></li>
					<li>&gt;</li>
					<li class="breadcrumb-item active"><span><?= ucwords($row_cat['name']) ?></span></li>
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
													<span><?= strtoupper($row_package['best_month']) ?></span>
													<svg enable-background="new 0 0 32 32" version="1.1"
														viewBox="0 0 32 32" xml:space="preserve"
														xmlns="">
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
													<span><?= $row_package['tour_duration'] ?> Days</span>
													<svg enable-background="new 0 0 32 32" version="1.1"
														viewBox="0 0 32 32" xml:space="preserve"
														xmlns="">
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
													<svg enable-background="new 0 0 32 32" version="1.1"
														viewBox="0 0 32 32" xml:space="preserve"
														xmlns="">
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
					<div class="col-md-4 col-sidebar">
						<aside id="sidebar-tour" class="sidebar widget-area">
							<section id="inspiry_top_rated_tours_widget-4"
								class="widget clearfix inspiry_top_rated_tours_widget">
								<h2 class="widget-title">Top Rated Category</h2>
								<ul>

									<?php 

										$sql_top_cat="select category.id as id, category.name as name, packages.main_image as main_image from category join packages on category.id=packages.category_id where category.id!={$cat_id} and category.is_deleted=0 group by category.id order by rand() limit 3";
										$result_top_cat=mysqli_query($con, $sql_top_cat);
										if(mysqli_num_rows($result_top_cat)>0) 
										{
											while($row_top_cat=mysqli_fetch_assoc($result_top_cat))
											{

									?>

									<li class="clearfix">
										<div class="content">
											<h4>
												<a href="tour-type.php?cat-id=<?= $row_top_cat['id'] ?>"><?= ucwords($row_top_cat['name']) ?></a>
											</h4>
											<span class="rating">
												<i class="fa fa-star-o rated"></i>
												<i class="fa fa-star-o rated"></i>
												<i class="fa fa-star-o rated"></i>
												<i class="fa fa-star-o rated"></i>
												<i class="fa fa-star-o rated"></i>
											</span>
										</div>
										<figure>
											<a href="tour-type.php?cat-id=<?= $row_top_cat['id'] ?>">
												<img width="70" height="70" src="images/packages/<?= $row_top_cat['main_image'] ?>" class="attachment-78x70 size-78x70 wp-post-image" alt="" decoding="async" loading="lazy" srcset="images/packages/<?= $row_top_cat['main_image'] ?> 150w, images/packages/<?= $row_top_cat['main_image'] ?> 300w, images/packages/<?= $row_top_cat['main_image'] ?> 100w" sizes="(max-width: 70px) 100vw, 70px" /> 
											</a>
										</figure>
									</li>

									<?php 
											}
										}
									?>
								</ul>
							</section>
							<section id="inspiry_recent_posts_widget-4"
								class="widget clearfix inspiry_recent_posts_widget">
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
													class="attachment-78x70 size-78x70 wp-post-image" alt=""
													decoding="async" loading="lazy"
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
													class="attachment-78x70 size-78x70 wp-post-image" alt=""
													decoding="async" loading="lazy"
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
													class="attachment-78x70 size-78x70 wp-post-image" alt=""
													decoding="async" loading="lazy"
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
