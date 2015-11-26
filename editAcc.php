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
		<link rel="stylesheet" type="text/css" href="/css/master.css">
    </head>
    <body>
		<div class="column">
			<form id="edit-accinfo">
				<h3>Edit account information</h3>
				<div class="column">
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
					<!--<div>
						<label>Email<em class="reqfield"> *</em></label>
						<input type="email" name="email" required="required"/>
					</div>-->
					<div>
						<input type="submit" name="edit-accinfo" value="Apply"/>
					</div>
					<div id="editAcc_error">
					</div>
				</div>
			</form>
			<form id="edit-pwd" style="margin-top: 50px">
				<h3>Change password</h3>
				<div class="column">
					<div>
						<label>Password<em class="reqfield"> *</em></label>
						<input type="password" name="password_reg"  required="required"/>
					</div>
					<div>
						<label>Confirm Password<em class="reqfield" > *</em></label>
						<input type="password" name="password_confirm" required="required"/>
					</div>
					<div>
						<input type="submit" name="edit-pwd" value="Apply"/>
					</div>
					<div id="editPwd_error">
					</div>
				</div>
			</form>
		</div>
	</body>
</html>