<?php session_start();?>

<html>
	<head>
		<title>log in</title>
		<link rel="stylesheet" href="css/stylelogin.css">
	</head>
	
	<body id="loginbody">
	<?php include("include/head.php");?>
	
		<form method="post" action="login.php">
			<div class="maindiv">
			<img class="logo" src="logo.jpg" alt="logo" height="80px" width="80px" align="center">
					<div class="head"> 
					<h1> Student Log in</h1></div>
					
				 <div id="container">
				<p> Registration Number</p>
				 <input type ="text" name="regno" required> 
				 
				<p>Password </p>
				<input type="password" name="pass" required><br/>
		
				<input type="submit" name="login" value="Login"><br/>
				<a id="forgotpass" href="#">Forgot password?</a>
				</div>
				</div>
		</form>
	</body>
</html>


<?php
		
	if(isset($_POST['login'])){
		
		require_once('include/dbconnect.php');
		
		$user_name= mysqli_real_escape_string($conn,$_POST['regno']);
		$user_password= mysqli_real_escape_string($conn,$_POST['pass']);
		
		$encrpt= md5($user_password);
		
		$query= "select * from students where regNo = '$user_name' AND pass='$user_password'";
		
		$run= mysqli_query($conn,$query);
		
		if(mysqli_num_rows($run)>0){
			
			$_SESSION['regNo']=$user_name;
			
			echo "<script>window.open('index.php','_self')</script>";
		}
		else{
			
			echo "<script>alert('username or password incorrect')</script>";
			exit();

			
		}

		mysqli_close($conn);
	}

?>