<html>
<head><title></title></head>
<body>

<?php
require('../mysqli_connect.php');
				$query = "SELECT * FROM (SELECT * FROM message ORDER BY id DESC LIMIT 10) sub ORDER BY id ASC"; // For Retriving and displaying messages
				$response = mysqli_query($dbc, $query);
				while($row = mysqli_fetch_array($response) )
				{
					echo '<center><div style="background-color:#EEE2F5; margin-top:10px; padding:5px; max-width:300px; border-radius:10px; text-align:left;">';
					echo '<span style="background-color:#C586EA; padding:5px;  border-radius:10px; display:inline-block;">'.$row['uname'] .'</span>&nbsp &nbsp'.$row['message'] .'<br/><br/>';
					echo '</div></center>';
				}
?>
</body>
</html>