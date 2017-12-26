<!DOCTYPE html>
<html>
<head>
  <title> Chat Room </title>
  <link rel="stylesheet" type="text/css" href="Assets/style.css">
  <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
  <script type="text/javascript">
   var auto_refresh = setInterval
   (
		  function ()
		  {
			 $('#refresh').load('message.php').fadeIn("slow");
		  }, 5000
	); // refresh every 5000 milliseconds
</script>
</head>
<body>
	<?php
		session_start();
		echo '<h2>User : '.$_SESSION['user'].'</h2>';
	?>
	You Are Now Logged In !<br/><br/>
    <a  class="homelinks" href="logout.php" > Logout </a>&nbsp &nbsp &nbsp
	<a class="homelinks" href="index.php">Home</a><br/>
	<hr style="max-width:500px;"/>
	<?php
			error_reporting(0);
			$uname="";
			$message="";
			$msg='';
			 require_once('../mysqli_connect.php');
				if(!(isset($_SESSION['user_id']))){header("Location: login.php");}
				else{($uname= $_SESSION['user']);}
				
				if(isset($_POST['Send']))		//If send button is clicked
				{
					if(!empty($_POST['message']) || !empty($_FILES['audiofile']['name']))		//Any of the inputs are not empty
					{
						if(!empty($_POST['message']))  // When Message is not empty
						{
							$message = trim($_POST['message']); 
						}
						
						if(!empty($_FILES['audiofile']['name']))			//Audio file is not empty
						{
							$dir="upload/";
							$audio_path=$dir.basename($_FILES['audiofile']['name']);
							move_uploaded_file($_FILES['audiofile']['tmp_name'],$audio_path);
						}
						$query = "INSERT INTO message (uname,message,audiofile) VALUES (?,?,?)";
						$stmt = mysqli_prepare($dbc, $query);
						mysqli_stmt_bind_param($stmt, "sss",$uname,$message, $audio_path);
						mysqli_stmt_execute($stmt);
						$affected_rows = mysqli_stmt_affected_rows($stmt);
						if($affected_rows != 1)
						{
							echo 'Error Occurred<br />';
							echo mysqli_error($dbc);									
						} 
						mysqli_stmt_close($stmt);
						mysqli_close($dbc);
					}
				}
?>
		<div id="refresh">  <?php require('message.php'); ?> </div>		<!-- Refresh this div every 5 seconds -->
		<form action="chat.php" method="POST"  enctype="multipart/form-data">
			<?php if(isset($_POST['Send']) && empty($_POST['message'])  && empty($_FILES['audiofile']['name'])) : ?>
				<span  style="position:relative; top:20px; right90px; font-size:13px; color:red;" > Empty Message and File </span>
			<?php endif; ?>
			 <input type="text" name="message" placeholder = "Your Message"/>
			 OR<br/>
			 <input type="file" name="audiofile" id="audiofile" /><br><br>
			 <input type="submit" name="Send" value="Send"/>
		</form>
</body>
</html>