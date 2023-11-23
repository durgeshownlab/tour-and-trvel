<?php 

include('header.php'); 


?>

<div id="site-banner" style="background-image: url(assets/content/uploads/2020/04/optimised-banner.jpg);">
	<div class="banner-content">
		<h1>Tours Gallery</h1>
		<ul id="inspiry_breadcrumbs" class="inspiry_breadcrumbs">
			<li class="breadcrumb-item"><a href="index.php" title="Home">Home</a></li>
			<li>&gt;</li>
			<li class="breadcrumb-item active item-current item-256"><span class="bread-current bread-256">
					Tours Gallery</span></li>
		</ul>
	</div>
</div>
<!-- tours gallery -->


<div id="content-wrapper" class="site-page tour-listing" bis_skin_checked="1">
	<div class="container" bis_skin_checked="1">
		<div class="row" bis_skin_checked="1">
			<div class="col-md-3 col-sidebar" bis_skin_checked="1">
				<aside id="sidebar-tour" class="sidebar widget-area">
					<section id="inspiry_tours_search_widget-2" class="widget clearfix inspiry_tours_search_widget" style="padding: 1.5rem;">
						<h2 class="widget-title">Find Tours</h2>
						<div bis_skin_checked="1">
							<form id="tours-search" action="" method="POST" class="clearfix">
								<p>
									<select name="state-name" id="state-name" style="display: none;">
										<option value="">Select State</option>
										<?php 
											$sql_state="select * from packages where is_deleted=0 group by state";
											$result_state=mysqli_query($con, $sql_state);
											if(mysqli_num_rows($result_state)>0)
											{
												while($row_state=mysqli_fetch_assoc($result_state))
												{
													echo'<option value="'.strtolower($row_state['state']).'">'.ucwords($row_state['state']).'</option>';
												}
											}
										?>
									</select>
								</p>

								<input type="submit" value="Search" id="filter-state-btn" name="filter-state-btn">
							</form>
						</div>
					</section>
				</aside>
			</div>

			<div class="col-md-9 col-main-content tours-list-container" bis_skin_checked="1">
				<div class="tours-listing" bis_skin_checked="1">
					<div class="row" bis_skin_checked="1">
											
						<?php 

							$sql="select * from packages where 1=1 and is_deleted=0";
							
							if(isset($_POST['filter-state-btn']) && $_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['state-name']) && !empty($_POST['state-name']))
							{
								$state_name=mysqli_real_escape_string($con, $_POST['state-name']);
								$sql .=" and state='{$_POST['state-name']}'"; 
							}

							if(isset($_GET['state-name']) && !empty($_GET['state-name']))
							{
								$state_name=mysqli_real_escape_string($con, $_GET['state-name']);
								$sql .=" and state='{$_GET['state-name']}'"; 
							}

							$result=mysqli_query($con, $sql);
							
							if(mysqli_num_rows($result)>0) 
							{
								while($row=mysqli_fetch_assoc($result))
								{
						?>
						
						<div class="col-xs-12 col-sm-6 col-lg-12" bis_skin_checked="1">
							<div class="tour-post clearfix tour-post-full-width" bis_skin_checked="1">
								<figure>
									<a href="tour.php?package-id=<?= $row['package_id'] ?>">
										<img width="720" height="560" src="images/packages/<?= $row['main_image'] ?>" class="attachment-inspiry_image_size_720_560 size-inspiry_image_size_720_560 wp-post-image" alt="" decoding="async" srcset="images/packages/<?= $row['main_image'] ?> 720w, images/packages/<?= $row['main_image'] ?> 300w, images/packages/<?= $row['main_image'] ?> 600w" sizes="(max-width: 720px) 100vw, 720px">
									</a>

									<span class="tour-meta">
										<span class="tour-meta-icon">
											<span style="margin-left: -27.1719px;">
												<?= strtoupper($row['best_month']) ?> </span>
											<svg enable-background="new 0 0 32 32" version="1.1" viewBox="0 0 32 32" xml:space="preserve" xmlns="">
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
												<polyline class="st0" points="6.9 4.4 2 4.4 2 30 30 30 30 4.4 25.1 4.4"></polyline>
												<rect class="st0" x="6.9" y="2" width="3.7" height="4.9"></rect>
												<rect class="st0" x="21.5" y="2" width="3.7" height="4.9"></rect>
												<line class="st0" x1="10.5" x2="21.5" y1="4.4" y2="4.4"></line>
												<line class="st0" x1="2" x2="30" y1="10.5" y2="10.5"></line>
												<line class="st0" x1="9.3" x2="9.3" y1="13" y2="27.6"></line>
												<line class="st0" x1="15.4" x2="15.4" y1="13" y2="27.6"></line>
												<line class="st0" x1="21.5" x2="21.5" y1="13" y2="27.6"></line>
												<line class="st0" x1="4.4" x2="27.6" y1="15.4" y2="15.4"></line>
												<line class="st0" x1="4.4" x2="27.6" y1="20.3" y2="20.3"></line>
												<line class="st0" x1="4.4" x2="27.6" y1="25.1" y2="25.1"></line>
											</svg>
										</span>
										<span class="tour-meta-icon">
											<span style="margin-left: -18.836px;">
												<?= strtoupper($row['tour_duration']) ?> Days
											</span>
											<svg enable-background="new 0 0 32 32" version="1.1" viewBox="0 0 32 32" xml:space="preserve" xmlns="">
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
												<circle class="st0" cx="16" cy="16" r="13.5"></circle>
												<polyline class="st0" points="15.4 9.5 15.4 16 22.5 22.5"></polyline>
											</svg>
										</span>
										<span class="tour-meta-icon">
											<span style="margin-left: -31.9375px;">
												<?= strtoupper($row['country']) ?>, <?= strtoupper($row['city']) ?> </span>
											<svg enable-background="new 0 0 32 32" version="1.1" viewBox="0 0 32 32" xml:space="preserve" xmlns="">
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
												<path class="st0" d="m25.1 11.1c0 5-9.1 18.9-9.1 18.9s-9.1-13.8-9.1-18.9c0-5 4.1-9.1 9.1-9.1s9.1 4.1 9.1 9.1z"></path>
												<circle class="st0" cx="16" cy="11.1" r="3.7"></circle>
											</svg>
										</span>
									</span>
									<div class="sunlight" bis_skin_checked="1">
										<i class="fa fa-sun-o" aria-hidden="true"></i>
										<span class="tour-days">
											<?= strtoupper($row['tour_duration']) ?> <i>days</i>
										</span>
									</div>
								</figure>

								<div class="offer-content" bis_skin_checked="1">
									<h3>
										<a href="tour.php?package-id=<?= $row['package_id'] ?>">
											<?= strtoupper($row['name']) ?> 
										</a>
									</h3>
									<?php 

										$sql_find_rating="select package_id, round(avg(rating)) as rating, count(package_id) as total_rating from comments where package_id={$row['package_id']} and is_deleted=0";
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
									<p>
										<?= ucfirst($row['description']) ?>
									</p>

									<?= $row['old_price']>$row['new_price']?'<span class="old-price">'.$row['old_price'].'</span>':'' ?>

									<span class="tour-price">
										₹ <?= number_format($row['new_price']) ?> 
									</span>
									<a href="tour.php?package-id=<?= $row['package_id'] ?>" class="read-more">View More</a>
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