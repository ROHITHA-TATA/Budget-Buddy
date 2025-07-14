<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
// error_reporting(0); // REMOVE THIS LINE

include('includes/dbconnection.php');

$msg = ""; // Initialize $msg

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $query = mysqli_query($con, "select ID from tbluser where Email='$email' && Password='$password' ");
    $ret = mysqli_fetch_array($query);
    if($ret > 0){
        $_SESSION['detsuid'] = $ret['ID'];
        header('location:dashboard.php');
        exit(); // Always exit after header redirect
    } else {
        $msg = "Invalid Details.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Budget Buddy - Login</title>
	<link href="css/modern-styles.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<div id="toast" class="toast"></div>
</body>
</html>
<body>
	<div class="login-container">
		<div class="login-card fade-in">
			<div class="mb-4">
				<i class="fas fa-wallet" style="font-size: 3rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
				<h1>Budget Buddy</h1>
				<p class="subtitle">Track your expenses, manage your budget</p>
			</div>
			
			<?php if($msg): ?>
			<div class="alert alert-danger">
				<i class="fas fa-exclamation-circle"></i>
				<?php echo $msg; ?>
			</div>
			<?php endif; ?>
			
			<form role="form" action="" method="post" class="form-modern">
				<div class="form-group">
					<label for="email">
						<i class="fas fa-envelope"></i> Email Address
					</label>
					<input class="form-control" id="email" placeholder="Enter your email" name="email" type="email" autofocus="" required="true">
				</div>
				
				<div class="form-group">
					<label for="password">
						<i class="fas fa-lock"></i> Password
					</label>
					<input class="form-control" id="password" placeholder="Enter your password" name="password" type="password" value="" required="true">
				</div>
				
				<div class="form-group">
					<a href="forgot-password.php" class="text-center" style="color: var(--primary-color); text-decoration: none; font-size: 0.9rem;">
						<i class="fas fa-question-circle"></i> Forgot Password?
					</a>
				</div>
				
				<div class="form-group">
					<button type="submit" value="login" name="login" class="btn btn-primary w-100">
						<i class="fas fa-sign-in-alt"></i> Sign In
					</button>
				</div>
				
				<div class="text-center">
					<p style="color: var(--gray-500); margin-bottom: 1rem;">Don't have an account?</p>
					<a href="register.php" class="btn btn-secondary">
						<i class="fas fa-user-plus"></i> Create Account
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
</body>
</html>