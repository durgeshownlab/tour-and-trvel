<?php include('header.php'); ?>


		<div id="site-banner"
			style="background-image: url(assets/content/uploads/2020/04/optimised-banner.jpg);">
			<div class="banner-content">
				<h1>My account</h1>
				<ul id="inspiry_breadcrumbs" class="inspiry_breadcrumbs">
					<li class="breadcrumb-item"><a href="index.php" title="Home">Home</a></li>
					<li>&gt;</li>
					<li class="breadcrumb-item active item-current item-207"><span class="bread-current bread-207"> My
							account</span></li>
				</ul>
			</div>
		</div>
		<!-- fullWidth -->
		<div id="content-wrapper" class="site-page fullwidth-page">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-main-content page-fullwidth-padding inspiry-box-shadow clearfix">
						<div class="entry-content">
							<div class="woocommerce">
								<div class="woocommerce-notices-wrapper"></div>
								<form method="post" class="woocommerce-ResetPassword lost_reset_password">

									<p>Lost your password? Please enter your username or email address. You will receive
										a link to create a new password via email.</p>
									<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
										<label for="user_login">Username or email</label>
										<input class="woocommerce-Input woocommerce-Input--text input-text" type="text"
											name="user_login" id="user_login" autocomplete="username" />
									</p>

									<div class="clear"></div>


									<p class="woocommerce-form-row form-row">
										<input type="hidden" name="wc_reset_password" value="true" />
										<button type="submit" class="woocommerce-Button button"
											value="Reset password">Reset password</button>
									</p>

									<input type="hidden" id="woocommerce-lost-password-nonce"
										name="woocommerce-lost-password-nonce" value="bc1d9fd941" /><input type="hidden"
										name="_wp_http_referer" value="/my-account/lost-password/" />
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	 <!-- #site-wrapper -->
<?php include('footer.php'); ?>