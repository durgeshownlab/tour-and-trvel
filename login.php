<?php 

include('header.php');

// code for checking that user allready loged in or not 
if(isset($_SESSION['user_type']) && $_SESSION['user_type']=='customer')
{
	echo "<script>window.location.href='index.php'</script>"; 
}
else if(isset($_SESSION['user_type']) && $_SESSION['user_type']=='admin')
{
	echo "<script>window.location.href='admin/main/index.php'</script>";
}

//server side code for login
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login-btn']))
{
	if(!isset($_POST['login-username']) || empty($_POST['login-username']) || !filter_var($_POST['login-username'], FILTER_VALIDATE_EMAIL))
	{
		exit;
	}
	else if(!isset($_POST['login-password']) || empty($_POST['login-password']))
	{
		exit;
	}
	else
	{
		$login_username=htmlspecialchars($_POST['login-username']);
		$login_password=htmlspecialchars($_POST['login-password']);

		$sql_login="select * from users where email='$login_username' and password='$login_password' ";
		$result_login=mysqli_query($con, $sql_login);

		if(mysqli_num_rows($result_login)==1)
		{
			$row=mysqli_fetch_assoc($result_login);
			$_SESSION['user_id']=$row['id'];
			$_SESSION['name']=$row['name'];
			$_SESSION['mobile']=$row['mobile'];
			$_SESSION['email']=$row['email'];
			$_SESSION['user_type']=$row['user_type'];

			if($_SESSION['user_type']=='admin')
			{
				echo "<script>window.location.href='admin/main/index.php'</script>"; 
			}
			else if($_SESSION['user_type']=='customer')
			{
				echo "<script>window.location.href='index.php'</script>"; 
			}
		}
		else
		{
			echo "<script>alert('User doesn\'t Exist')</script>";
		}
	}
}

// server side code for signup 
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup-btn']))
{
	if(!isset($_POST['signup-name']) || empty($_POST['signup-name']))
	{
		exit;
	}
	else if(!isset($_POST['signup-mobile']) || empty($_POST['signup-mobile']))
	{
		exit;
	}
	else if(!isset($_POST['signup-email']) || empty($_POST['signup-email']) || !filter_var($_POST['signup-email'], FILTER_VALIDATE_EMAIL))
	{
		exit;
	}
	else if(!isset($_POST['signup-password']) || empty($_POST['signup-password']))
	{
		exit;
	}
	else if(!isset($_POST['signup-confirm-password']) || empty($_POST['signup-confirm-password']))
	{
		exit;
	}
	else if($_POST['signup-password'] != $_POST['signup-confirm-password'])
	{
		exit;
	}
	else
	{
		$signup_name=htmlspecialchars($_POST['signup-name']);
		$signup_mobile=htmlspecialchars($_POST['signup-mobile']);
		$signup_email=htmlspecialchars($_POST['signup-email']);
		$signup_password=htmlspecialchars($_POST['signup-password']);
		$signup_confirm_password=htmlspecialchars($_POST['signup-confirm-password']);

		$sql="select * from users where email='$signup_email' or mobile='$signup_mobile'";
		$result=mysqli_query($con, $sql);

		if(mysqli_num_rows($result)<=0)
		{
			$sql="insert into users (name, mobile, email, password) values('$signup_name', '$signup_mobile', '$signup_email', '$signup_password')";
			$result=mysqli_query($con, $sql);

			if($result)
			{
				$_SESSION['user_id']=mysqli_insert_id($con);
				$_SESSION['name']=$signup_name;
				$_SESSION['mobile']=$signup_mobile;
				$_SESSION['email']=$signup_email;
				$_SESSION['user_type']='customer';
				echo "<script>window.location.href='index.php'</script>"; 
			}
			
		}
		else
		{
			echo "<script>alert('User Allready Exist')</script>";
		}
	}
}


?>

<!-- fullWidth -->
<div id="content-wrapper" class="site-page fullwidth-page">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-main-content page-fullwidth-padding inspiry-box-shadow clearfix">
				<div class="flex-div">
					<button class="form_toggler_btn form_toggler_btn_active" id="login-toggle-btn">Login</button>
					<button class="form_toggler_btn" id="signup-toggle-btn">SignUp</button>
				</div>



				<div class="entry-content">
					<div class="woocommerce" id="loginForm">
						<div class="woocommerce-notices-wrapper"></div>

						<h2>Login</h2>

						<form class="woocommerce-form woocommerce-form-login login" method="post" action="" onsubmit="return validatelogin()">
							<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
								<label for="username">Username or email address&nbsp;
									<span class="required">*</span>
								</label>
								<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="login-username" id="login-username" autocomplete="username" value="" />
							</p>
							<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
								<label for="password">Password&nbsp;
									<span class="required">*</span>
								</label>
								<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="login-password" id="login-password" autocomplete="current-password" />
							</p>


							<p class="form-row">
								<label
									class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
									<input class="woocommerce-form__input woocommerce-form__input-checkbox"
										name="rememberme" type="checkbox" id="rememberme" value="forever" />
									<span>Remember me</span>
								</label>
								<button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login-btn" value="Log in">Log in</button>
							</p>
							<p class="woocommerce-LostPassword lost_password">
								<a href="forgot_password.php">Lost your password?</a>
							</p>
						</form>

						<!-- <button type="button" onclick="toggleElement('login')">Switch to SignUp</button> -->
					</div>

					<div class="woocommerce" id="signupForm" style="display: none;">
						<div class="woocommerce-notices-wrapper"></div>

						<h2>SignUp</h2>

						<form class="woocommerce-form woocommerce-form-login login" method="post" onsubmit="return validateSignup()">
							<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
								<label for="name">Name&nbsp;<span class="required">*</span></label>
								<input type="text" class="woocommerce-Input woocommerce-Input--text input-text"
									name="signup-name" id="signup-name" autocomplete="name" value="" />
							</p>

							<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
								<label for="mobile">Mobile&nbsp;<span class="required">*</span></label>
								<input type="text" class="woocommerce-Input woocommerce-Input--text input-text"
									name="signup-mobile" id="signup-mobile" autocomplete="mobile" value="" />
							</p>

							<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
								<label for="r-email">Email&nbsp;<span class="required">*</span></label>
								<input type="text" class="woocommerce-Input woocommerce-Input--text input-text"
									name="signup-email" id="signup-email" autocomplete="email" value="" />
							</p>

							<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
								<label for="password">Password&nbsp;<span class="required">*</span></label>
								<input class="woocommerce-Input woocommerce-Input--text input-text" type="password"
									name="signup-password" id="signup-password" autocomplete="current-password" />
							</p>

							<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
								<label for="password">Confirm Password&nbsp;<span class="required">*</span></label>
								<input class="woocommerce-Input woocommerce-Input--text input-text" type="password"
									name="signup-confirm-password" id="signup-confirm-password" autocomplete="current-password" />
							</p>


							<p class="form-row">
								<button type="submit" class="woocommerce-button button woocommerce-form-login__submit"
									name="signup-btn" value="sign up">Register</button>
							</p>
						</form>
					</div>
				</div>

				<script>


					// code for when click signup toggle 
					document.getElementById("signup-toggle-btn").addEventListener('click', (e) => {
						e.preventDefault();

						let btn_class=document.querySelectorAll('.form_toggler_btn');

						btn_class.forEach((btn)=>{
							btn.classList.remove('form_toggler_btn_active');
							
						});
						e.srcElement.classList.add('form_toggler_btn_active');

						var loginForm = document.getElementById('loginForm');
						var signupForm = document.getElementById('signupForm');
						loginForm.style.display = 'none';
						signupForm.style.display = 'block';
					});

					// code for when click login toggle 
					document.getElementById("login-toggle-btn").addEventListener('click', (e) => {
						e.preventDefault();

						let btn_class=document.querySelectorAll('.form_toggler_btn');

						btn_class.forEach((btn)=>{
							btn.classList.remove('form_toggler_btn_active');
							
						});
						e.srcElement.classList.add('form_toggler_btn_active');

						var loginForm = document.getElementById('loginForm');
						var signupForm = document.getElementById('signupForm');
						signupForm.style.display = 'none';
						loginForm.style.display = 'block';
					});


					// validating login form 
					function validatelogin()
					{
						let login_username = document.getElementById('login-username').value;
						let login_password = document.getElementById('login-password').value;

						if(login_username=='')
						{
							alert('Please Enter Email');
							return false;
						}
						else if(!validateEmail(login_username))
						{
							alert('Please Enter Valid Email');
							return false;
						}
						else if(login_password=='')
						{
							alert('Please Enter Password');
							return false;
						}
						else
						{
							console.log(login_username, login_password);
						}
					}

					// function to validate the signup details 
					function validateSignup()
					{
						let signup_name = document.getElementById('signup-name').value;
						let signup_mobile = document.getElementById('signup-mobile').value;
						let signup_email = document.getElementById('signup-email').value; 
						let signup_password = document.getElementById('signup-password').value; 
						let signup_confirm_password = document.getElementById('signup-confirm-password').value; 

						if(signup_name=='')
						{
							alert('Please Enter Name');
							return false;
						}
						else if(signup_mobile=='')
						{
							alert('Please Enter Mobile Number');
							return false;
						}
						else if(!validateMobileNumber(signup_mobile))
						{
							alert('Please Enter Valid Mobile Number');
							return false;
						}
						else if(signup_email=='')
						{
							alert('Please Enter Email');
							return false;
						}
						else if(!validateEmail(signup_email))
						{
							alert('Please Enter Valid Email');
							return false;
						}
						else if(signup_password=='')
						{
							alert('Please Enter Password');
							return false;
						}
						else if(signup_confirm_password=='')
						{
							alert('Please Enter Confirm Password');
							return false;
						}
						else if(signup_password!=signup_confirm_password)
						{
							alert('Password And Confirm Password Must be Same');
							return false;
						}
						else
						{
							console.log(signup_name, signup_mobile, signup_email, signup_password, signup_confirm_password);

							return true;
						}

					}

					// function for validating email id 
					function validateEmail(email) {
						const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
						return emailRegex.test(email);
					}

					// fucntion for validating the user mobile number 
					function validateMobileNumber(number) {
						// Define a regular expression for a typical mobile number format
						var regex = /^[0-9]{10}$/;

						// Test the input against the regular expression
						if (regex.test(number)) {
							return true; // Valid mobile number
						} else {
							return false; // Invalid mobile number
						}
					}
				</script>

			</div>
		</div>
	</div>
</div>
</div> <!-- #site-wrapper -->

<?php include('footer.php'); ?>

<script>
    $(document).ready(function(){
        // function validatelogin(e)
		// {

		// 	e.preventDefault();
		// 	let login_username = $("#login-username").val();
		// 	let login_password = $("#login-password").val();
		// 	console.log('sdfsf');
		// 	if(login_username=='')
		// 	{
		// 		alert('Please Enter Username');
		// 		return false;
		// 	}
		// 	else if(login_password=='')
		// 	{
		// 		alert('Please Enter Password');
		// 		return false;
		// 	}
		// 	else
		// 	{
		// 		console.log(login_username, login_password);
		// 	}
		// }
    });
</script>