<?php
session_start();
if(!isset($_SESSION['username'])) {
	header('Location: http://localhost:8080/index.php');
	die();
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>My first PHP Website</title>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="/js/editAcc.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="/css/master.css">
    </head>
    <body>
		<div class="wrapper">
			<h1>Online Lecture </h1>
			<h2>Edit account information,<span> email</span> or change password</h2>
			
			<div class="content">
				<div id="form_wrapper" class="form_wrapper">
					<form id="edit-accinfo" class="edit active">
					<h3>Edit account <i class="fa fa-user"></i>information</h3>	
						<div>
							<label>First Name<em class="reqfield"> *</em></label>
							<input type="text" name="firstname" required="required"/>
						</div>
						<div>
							<label>Last Name<em class="reqfield"> *</em></label>
							<input type="text" name="lastname" required="required"/>
						</div>
						<div>
							<label>School</label>
							<input type="text" name="school"/>
						</div>
						<div>
							<label>Programme</label>
							<input type="text" name="programme"/>
						</div>
						<div class="bottom">
							<div id="editAcc_error" class="edit_error"></div>
							<input type="submit" name="edit-accinfo" value="Apply"/>
							<div class="clear"></div>
						</div>
					</form>		
				</div>
			</div>
			
			<div class="content" style="margin-top:20px">
				<div id="form_wrapper" class="form_wrapper">
					<form id="edit-email" class="edit active">
					<h3>Change email <i class="fa fa-envelope"></i></h3>
						<div>
							<label>Email<em class="reqfield"> *</em></label>
							<input type="email" name="email" required="required"/>
						</div>
						<div>
							<label>Confirm Change With Password<em class="reqfield" > *</em></label>
							<input type="password" name="password_email" required="required"/>
						</div>
						<div class="bottom">
							<div id="editEmail_error" class="edit_error"></div>
							<input type="submit" name="edit-email" value="Apply"/>
							<div class="clear"></div>
						</div>
					</form>
				</div>
			</div>
			
			<div class="content" style="margin-top:20px">
				<div id="form_wrapper" class="form_wrapper">
					<form id="edit-pwd" class="edit active">
					<h3>Change password <i class="fa fa-key"></i></h3>
						<div>
							<label>Current Password<em class="reqfield"> *</em></label>
							<input type="password" name="current_password"  required="required"/>
						</div>
						<div>
							<label>New Password<em class="reqfield" > *</em></label>
							<input type="password" name="new_password" required="required"/>
						</div>							
						<div>
							<label>Confirm New Password<em class="reqfield" > *</em></label>
							<input type="password" name="password_confirm" required="required"/>
						</div>
						<div class="bottom">
							<div id="editPwd_error" class="edit_error"></div>
							<input type="submit" name="edit-pwd" value="Apply"/>
							<div class="clear"></div>
						</div>
					</form>
				</div>
			</div>
			
		</div>
	</body>
</html>