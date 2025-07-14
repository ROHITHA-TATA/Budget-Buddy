<?php 
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['submit']))
  {
    $fname=$_POST['name'];
    $mobno=$_POST['mobilenumber'];
    $email=$_POST['email'];
    $password=md5($_POST['password']);

    $ret=mysqli_query($con, "select Email from tbluser where Email='$email' ");
    $result=mysqli_fetch_array($ret);
    if($result>0){
$msg="This email is already associated with another account";
    }
    else{
    $query=mysqli_query($con, "insert into tbluser(FullName, MobileNumber, Email,  Password) value('$fname', '$mobno', '$email', '$password' )");
    if ($query) {
    $msg="You have successfully registered! Please login to continue.";
  }
  else
    {
      $msg="Something Went Wrong. Please try again";
    }
}
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Budget Buddy - Sign Up</title>
	<link href="css/modern-styles.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
	<script type="text/javascript">
function checkpass()
{
if(document.signup.password.value!=document.signup.repeatpassword.value)
{
alert('Password and Repeat Password field does not match');
document.signup.repeatpassword.focus();
return false;
}
return true;
} 

</script>
</head>
<body>
	<div class="login-container">
		<div class="login-card fade-in">
			<div class="mb-4">
				<i class="fas fa-wallet" style="font-size: 3rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
				<h1>Budget Buddy</h1>
				<p class="subtitle">Create your account to start tracking expenses</p>
			</div>
			
			<?php if($msg): ?>
			<div class="alert <?php echo strpos($msg, 'successfully') !== false ? 'alert-success' : 'alert-danger'; ?>">
				<i class="fas <?php echo strpos($msg, 'successfully') !== false ? 'fa-check-circle' : 'fa-exclamation-circle'; ?>"></i>
				<?php echo $msg; ?>
			</div>
			<?php endif; ?>
			
			<form role="form" action="" method="post" class="form-modern" name="signup" onsubmit="return checkpass();">
				<div class="form-group">
					<label for="name">
						<i class="fas fa-user"></i> Full Name
					</label>
					<input class="form-control" id="name" placeholder="Enter your full name" name="name" type="text" required="true">
				</div>
				
				<div class="form-group">
					<label for="email">
						<i class="fas fa-envelope"></i> Email Address
					</label>
					<input class="form-control" id="email" placeholder="Enter your email" name="email" type="email" required="true">
				</div>
				
				<div class="form-group">
					<label for="mobilenumber">
						<i class="fas fa-phone"></i> Mobile Number
					</label>
					<input type="text" class="form-control" id="mobilenumber" name="mobilenumber" placeholder="Enter 10-digit mobile number" maxlength="10" pattern="[0-9]{10}" required="true">
				</div>
				
				<div class="form-group">
					<label for="password">
						<i class="fas fa-lock"></i> Password
					</label>
					<input class="form-control" id="password" placeholder="Create a strong password" name="password" type="password" value="" required="true">
				</div>
				
				<div class="form-group">
					<label for="repeatpassword">
						<i class="fas fa-lock"></i> Confirm Password
					</label>
					<input type="password" class="form-control" id="repeatpassword" name="repeatpassword" placeholder="Confirm your password" required="true">
				</div>
				
				<div class="form-group">
					<button type="submit" value="submit" name="submit" class="btn btn-primary w-100">
						<i class="fas fa-user-plus"></i> Create Account
					</button>
				</div>
				
				<div class="text-center">
					<p style="color: var(--gray-500); margin-bottom: 1rem;">Already have an account?</p>
					<a href="index.php" class="btn btn-secondary">
						<i class="fas fa-sign-in-alt"></i> Sign In
					</a>
				</div>
			</form>
			
			<div class="mt-4 text-center">
				<p style="color: var(--gray-400); font-size: 0.8rem;">
					<i class="fas fa-shield-alt"></i> Your data is secure and private
				</p>
			</div>
		</div>
	</div>

<script src="js/jquery-1.11.1.min.js"></script>
<div id="toast" class="toast"></div>
</body>
</html>
