<?php include('header.php'); ?>



<!-- fullWidth -->
<div id="content-wrapper" class="site-page fullwidth-page">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-main-content page-fullwidth-padding inspiry-box-shadow clearfix">
				<div class="entry-content">
					<div class="woocommerce">
						<div class="banner-wrapper-cart">
							<h2>Account Profile</h2>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-12">
								<div class="switch-buttons">
									<button class="switch-button" onclick="showUserDetails(0)">User
										Details</button>
									<button class="switch-button" onclick="showChangePassword(1)">Change
										Password</button>
								</div>
								<div class="profile_container">

									<div class="user-details-section">
										<div class="row">
											<div class="col-md-4 profile">
												<div class="user-profile">
													<img src="images/users/user.png"
														alt="User Image" class="user-image">
												</div>
												<button class="change-image-button" onclick="changeImage()">Change Image</button>
											</div>
											<div class="col-md-8">
												<div class="user-details">
													<h3><?= ucwords($_SESSION['name']) ?></h3>
													<p>
														<b>Email: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
														<?= ucwords($_SESSION['email']) ?>
													</p>
													<p><b>Contact: &nbsp;&nbsp;</b><?= ucwords($_SESSION['mobile']) ?></p>
												</div>
											</div>
										</div>
									</div>

									<div class="change-password-section">
										<form>
											<h3>Change Password</h3>
											<div class="input-group">
												<label for="oldPassword">Old Password:</label>
												<input type="password" id="oldPassword">
											</div>
											<div class="input-group">
												<label for="newPassword">New Password:</label>
												<input type="password" id="newPassword">
											</div>
											<div class="input-group">
												<label for="confirmPassword">Confirm Password:</label>
												<input type="password" id="confirmPassword">
											</div>
											<div class="btn" onclick="changePassword()">Change Password</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<!-- #site-wrapper -->
<style>
	#content-wrapper.site-page {
		padding: 4rem 0;
	}

	.profile_container {
		/* max-width: 800px; */
		margin: 0 auto;
		padding: 20px;
		background-color: #fff;
		border-radius: 5px;
		box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
	}

	h2 {
		text-align: center;
	}

	.user-profile {
		text-align: center;
		padding: 20px;
	}

	.user-image {
		width: 130px;
		height: 100px;
		border-radius: 50%;
	}

	.user-details {
		margin: 20px;
	}

	.user-details h3 {
		margin: 10px 0;
		padding-top: 0px;
		color: #00aeef;
	}

	.user-details p {
		margin-bottom: 1.2rem;
	}

	.btn {
		background-color: #00aeef;
		color: #fff;
		padding: 10px 20px;
		border: none;
		cursor: pointer;
		border-radius: 5px;
	}

	.change-image-button {
		outline: none;
		display: block;
		margin: 0 auto;
		color: red;
	}

	.btn:hover {
		background-color: #77c720;
	}

	.switch-buttons {
		/* text-align: center; */
		margin: 20px 0;
	}

	.switch-button {
		background-color: #00aeef;
		color: #fff;
		padding: 10px 20px;
		border: none;
		cursor: pointer;
		border-radius: 5px;
		/* margin: 0 10px; */
	}

	.switch-button:hover {
		background-color: #77c720;
	}

	/* .user-details-section, */
	.change-password-section {
		display: none;
	}

	.input-group {
		margin: 10px 0;
	}

	input[type="text"],
	input[type="password"] {
		width: 100%;
		padding: 10px;
		margin-bottom: 10px;
		border: 1px solid #ccc;
		border-radius: 5px;
	}

	.active-button {
		background-color: #E83114;
		color: #fff;
	}

	.profile {
		border-right: 2px solid #eee;
	}

	@media (max-width: 520px) {
		.profile {
			border-right: none;
		}
	}

	/* Add more CSS styling as needed */
</style>

<script>
	function changeImage() {
		// Implement the image change functionality here
	}

	function showUserDetails(tabIndex) {
		document.querySelector('.user-details-section').style.display = 'block';
		document.querySelector('.change-password-section').style.display = 'none';

		// Remove the 'active-button' class from all buttons
		const buttons = document.querySelectorAll('.switch-button');
		buttons.forEach(button => button.classList.remove('active-button'));

		// Add the 'active-button' class to the clicked button
		buttons[tabIndex].classList.add('active-button');
	}

	function showChangePassword(tabIndex) {
		document.querySelector('.user-details-section').style.display = 'none';
		document.querySelector('.change-password-section').style.display = 'block';

		// Remove the 'active-button' class from all buttons
		const buttons = document.querySelectorAll('.switch-button');
		buttons.forEach(button => button.classList.remove('active-button'));

		// Add the 'active-button' class to the clicked button
		buttons[tabIndex].classList.add('active-button');
	}

	function saveUserDetails() {
		// Implement the user details saving functionality here
		// You can access user details using document.getElementById or querySelector
	}

	function changePassword() {
		// Implement the password change functionality here
		// You can access oldPassword, newPassword, and confirmPassword using document.getElementById or querySelector
	}

</script>

<?php include('footer.php'); ?>