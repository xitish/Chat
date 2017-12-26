<html>
<head><title></title></head>
<body>

<?php
	require('../mysqli_connect.php');
	$query = "SELECT * FROM (SELECT * FROM message ORDER BY id DESC LIMIT 10) sub ORDER BY id ASC"; // For Retriving and displaying messages
	$response = mysqli_query($dbc, $query);
	while($row = mysqli_fetch_array($response))
	{
		echo '<center><div style="background-color:#EEE2F5; margin-top:10px; padding:5px; max-width:300px; border-radius:10px; text-align:left;">';				//Box for message
		echo '<span style="background-color:#C586EA; padding:5px;  border-radius:10px; display:inline-block;">'.$row['uname'] .'</span>&nbsp &nbsp';										//Display User Name
		if(!empty($row['message'] )){echo $row['message'].'<br/>';}			//Display Message if there is a message
		if(!empty($row['audiofile']))															//Display audio if audio is there
		{
			echo 'Voice Message';
			echo "<audio controls>";
			echo '<source type="audio/mpeg" src="'.$row['audiofile'].'">';
			echo "</source>";
			echo "</audio>";
		}
		echo '</div></center>';
	}
?>
</body>
</html>