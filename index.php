<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>My first PHP Website</title>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="/js/checklogin.js"></script>
		<script src="/js/login_register.js"></script>
		<link rel="stylesheet" type="text/css" href="/css/master.css">
    </head>
    <body>
		<div class="wrapper">
			<h1>Online Lecture</h1>
			<h2>Log in <span>or register</span> to take part of online lectures</h2>
			<div class="content">
				<div id="form_wrapper" class="form_wrapper">
				
					<form id="login-form" class="login active">
					<h3>Login</h3>
						<div>
							<label>Username:</label> 
							<input type="text" name="username" required="required" />
						</div>
						<div>
							<label>Password:</label> 
							<input type="password" name="password" required="required" />
						</div>
						<div class="bottom">
							<input type="submit" name="login" value="Login"/>
							<a href="" rel="register" class="linkform">You don't have an account yet? Register here</a>
							<div class="clear"></div>
						</div>
					</form>
					
						<form class="register">
						<h3>Register</h3>
						<div class="column">
							<div>
								<label>Name:</label>
								<input type="text" name="name" required="required"/>
								<span class="error">This is an error</span>
							</div>
							<div>
								<label>Last Name:</label>
								<input type="text" />
								<span class="error">This is an error</span>
							</div>
							<div>
								<label>Website:</label>
								<input type="text" value="http://"/>
								<span class="error">This is an error</span>
							</div>
						</div>
						<div class="column">
							<div>
								<label>Username:</label>
								<input type="text"/>
								<span class="error">This is an error</span>
							</div>
							<div>
								<label>Email:</label>
								<input type="text" />
								<span class="error">This is an error</span>
							</div>
							<div>
								<label>Password:</label>
								<input type="password" />
								<span class="error">This is an error</span>
							</div>
						</div>
						<div class="bottom">
							<input type="submit" value="Register" />
							<a href="" rel="login" class="linkform">You have an account already? Log in here</a>
							<div class="clear"></div>
						</div>
					</form>
				</div>
			</div>
		</div>
    </body>
</html>