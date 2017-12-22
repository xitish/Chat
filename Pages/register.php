<?php
session_start();
if(isset($_SESSION['user_id']))
{
	header("Location: index.php");
}
$msg='';
if(isset($_POST['submit']))
{
	
	if($_POST['password'] == $_POST['confirm_password'] ){  //Two Passwords are same
	
		$data_missing = array();   //Array to store missing data

		 if(empty($_POST['uname'])) { $data_missing[] = 'UserName'; }
		else   { $uname = trim($_POST['uname']); }

		   if(empty($_POST['password'])) { $data_missing[] = 'Password'; }
		else   { $password = trim($_POST['password']); }
		
		if(empty($_POST['confirm_password'])) { $data_missing[] = 'Confirm Password'; }
		else   { $password = trim($_POST['password']); }

		if(empty($data_missing)){
		  require_once('../mysqli_connect.php');
		  $query = "INSERT INTO users (uname,password) VALUES (?, ?)";
		  $stmt = mysqli_prepare($dbc, $query);
		  mysqli_stmt_bind_param($stmt, "ss", $uname,$password);
		  mysqli_stmt_execute($stmt);
		  $affected_rows = mysqli_stmt_affected_rows($stmt);
		  if($affected_rows == 1){
			echo '<h3>Successfully Created New User</h3>';
			mysqli_stmt_close($stmt);
			mysqli_close($dbc);
			} else {
			  echo 'Error Occurred<br />';
			  echo mysqli_error($dbc);
			  mysqli_stmt_close($stmt);
			  mysqli_close($dbc);
			}
		} else {
			$msg="Enter Valid Data in Indicated Fields";
		}
	}	
	else{
		echo 'Passwords do not match. Try again.<br /><br/>';
	}
}
?>


<html>
<head>
  <title> Register </title>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"/>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css"/>
  
  <link rel="stylesheet" type="text/css" href="Assets/style.css"/>
  <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet"/>
</head>
<body>
  <div >
    <a href="index.php"><h4> Home </h3></a>
  </div>
<h2>Please Register Below</h2>
<span id="sp"> or <a href="login.php"> <h4 style="display:inline">Login</h4> </a></span>
<center><div id="form">
<form action="register.php" method="POST">

		<?php if(isset($_POST['submit']) && empty($_POST['uname'])) : ?>
			<span id="info" > !!! </span>
		<?php endif; ?>
	   <input type="text" name="uname" placeholder = "User Name" value="<?php echo isset($_POST['uname']) ? $_POST['uname'] : '' ?>" />
	   
	   <?php if(isset($_POST['submit']) && empty($_POST['password'])) : ?>
			<span id="info">!!!</span>
		<?php endif; ?>
	   <input type="password" name="password" placeholder = "Password" />
	   
	   <?php if(isset($_POST['submit'])&& (empty($_POST['confirm_password']) || $_POST['password']!=$_POST['confirm_password'] )) : ?>
			<span id="info">!!!</span>
		<?php endif; ?>
	   <input type="password" name="confirm_password" placeholder = "Re Enter Password"/>
	  <input type="submit" name="submit" value="Register"/ >
</form>
</div>
<?php echo $msg ?>
</center>

</body>
</html>
