<?php
session_start();
if(isset($_SESSION['username'])) {
	header('Location: http://localhost:8080/start.php');
	die();
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>OnlineLecture</title>
		<link rel="icon" href="images/favicon.ico">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="/js/checklogin.js"></script>
		<script src="/js/login_register.js"></script>
		<script src="/js/register.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="/css/master.css">
    </head>
    <body>
		<div class="wrapper">
			<h1>Online Lecture</h1>
			<h2>Log in <span>or register</span> to take part of online lectures</h2>
			<div class="content">
				<div id="form_wrapper" class="form_wrapper">
				
					<form id="login-form" class="login active">
					<h3>Login <i class="fa fa-sign-in"></i></h3>
						<div>
							<label>Username:</label> 
							<input type="text" name="username" required="required" />
						</div>
						<div>
							<label>Password:</label> 
							<input type="password" name="password" required="required" />
						</div>
						<div class="bottom">
							<div id="login_error" class="edit_error"></div>
							<input type="submit" name="login" value="Login"/>
							<a href="" rel="register" class="linkform">You don't have an account yet? Register here</a>
							<div class="clear"></div>
						</div>
					</form>
					
					<form id="register-form" class="register">
						<h3>Register <i class="fa fa-user"></i></h3>
						<div class="column">
							<div>
								<label>First Name<em class="reqfield"> *</em></label>
								<input type="text" name="firstname" required="required"/>
								<span class="error">This is an error</span>
							</div>
							<div>
								<label>Last Name<em class="reqfield"> *</em></label>
								<input type="text" name="lastname" required="required"/>
								<span class="error">This is an error</span>
							</div>
							<div>
								<label>School</label>
								<input type="text" name="school"/>
								<span class="error">This is an error</span>
							</div>
							<div>
								<label>Programme</label>
								<input type="text" name="programme"/>
								<span class="error">This is an error</span>
							</div>
						</div>
						<div class="column">
							<div>
								<label>Username<em class="reqfield"> *</em></label>
								<input type="text" name="username_reg" required="required"/>
								<span class="error">This is an error</span>
							</div>
							<div>
								<label>Email<em class="reqfield"> *</em></label>
								<input type="email" name="email" required="required"/>
								<span class="error">This is an error</span>
							</div>
							<div>
								<label>Password<em class="reqfield"> *</em></label>
								<input type="password" name="password_reg"  required="required"/>
								<span class="error">This is an error</span>
							</div>
							<div>
								<label>Confirm Password<em class="reqfield" > *</em></label>
								<input type="password" name="password_confirm" required="required"/>
								<span class="error">This is an error</span>
							</div>
						</div>
						<div class="bottom">
							<div id="register_error" class="edit_error"></div>
							<input type="submit" name="register" value="Register" />
							<a href="" rel="login" class="linkform">You have an account already? Log in here</a>
							<div class="clear"></div>
						</div>
					</form>
				</div>
			</div>
		</div>
    </body>
</html>