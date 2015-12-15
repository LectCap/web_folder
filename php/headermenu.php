<nav class="navbar navbar-inverse navbar-static-top no-margin" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
		    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand">			<?php
				echo "<h2boot>Logged in as: <span>". $_SESSION['username'] ."</span></h2boot>";
			?>	</a>
		</div>
		
		<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li id="start"><a href='start.php'>Start</a></li>
				<li id="myCourses"><a href='myCourses.php'>My Courses</a></li>
				<li><a href="#form_wrapper_create" class="createCourseButton">Create a Course</a></li>
				<li><a href='php/logout.php'>Logout</a></li>
				
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Edit Account <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#form_wrapper_acc" class="editAccButton">Edit personal info</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="#form_wrapper_email" class="editEmailButton">Edit email</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="#form_wrapper_pwd" class="editPwdButton">Edit password</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>

<div id="form_wrapper_create" class="form_wrapper lightboxWrap" style="display:none">					
	<form id="createCourse-form" class="edit active">
		<h3>Create a Course <i class="fa fa-book"></i></h3>
		<div>
			<label>Course code<em class="reqfield"> *</em></label>
			<input type="text" name="course_code" required="required" maxlength="45"/>
			<span class="error">This is an error</span>
		</div>
		<div>
			<label>Course name<em class="reqfield"> *</em></label>
			<input type="text" name="course_name" required="required" maxlength="45"/>
			<span class="error">This is an error</span>
		</div>
		<div>
			<label>Course description</label>
			<textarea id="styled" rows="5" cols="40" name="course_description" placeholder="Write a short course description" maxlength="250"></textarea>
		</div>
		<div class="bottom">
			<div id="createCourse_error" class="edit_error"></div>
			<input type="submit" name="createCourse" value="Create course" />
			<div class="clear"></div>
		</div>
	</form>
</div>

<div id="form_wrapper_acc" class="form_wrapper lightboxWrap" style="display:none">
	<form id="edit-accinfo" class="edit active"><!-- this is the edit account info box -->
	<h3>Edit account <i class="fa fa-user"></i><br>information</h3>	
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
			<a href="#form_wrapper_email" rel="login" class="linkform editAccButton">You wish to edit your email instead?</a>
			<a href="#form_wrapper_pwd" rel="forgot_password" class="linkform editPwdButton">Or your password?</a>
			<div class="clear"></div>
		</div>
	</form>
</div>
<div id="form_wrapper_email" class="form_wrapper lightboxWrap" style="display:none">
	<form id="edit-email" class="login active"><!-- this is the edit email box-->
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
			<a href="#form_wrapper_acc" rel="edit" class="linkform editAccButton">You wish to edit your account information instead?</a>
			<a href="#form_wrapper_pwd" rel="forgot_password" class="linkform editPwdButton">Or your password?</a>
			<div class="clear"></div>
		</div>
	</form>
</div>
<div id="form_wrapper_pwd" class="form_wrapper lightboxWrap" style="display:none">
	<form id="edit-pwd" class="forgot_password active"><!-- this is the edit password box-->
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
			<a href="#form_wrapper_email" rel="login" class="linkform editEmailButton">You wish to edit your email instead?</a>
			<a href="#form_wrapper_acc" rel="edit" class="linkform editAccButton">Or your account information?</a>
			<div class="clear"></div>
		</div>
	</form>
</div>

<script type="text/javascript">
    $(".createCourseButton").fancybox({
		"scrolling":"no",
		"arrows":false,
		"padding":[0,15,15,15]
	});
</script>
				
<script type="text/javascript">
    $(".editAccButton").fancybox({
		"scrolling":"no",
		"arrows":false,
		"padding":[0,15,15,15]
	});
</script>

<script type="text/javascript">
    $(".editEmailButton").fancybox({
		"scrolling":"no",
		"arrows":false,
		"padding":[0,15,15,15]
	});
</script>

<script type="text/javascript">
    $(".editPwdButton").fancybox({
		"scrolling":"no",
		"arrows":false,
		"padding":[0,15,15,15]
	});
</script>
				
