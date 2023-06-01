


<!DOCTYPE html>
<html>

<head>
	<title>Insert Page page</title>
</head>

<body>
	<center>
		<?php

		$servername = "localhost";
        $username = "vtworks_natarajbar";
        $password = "vtworks_natarajbar";
        $dbname = "vtworks_natarajbar";

		// servername => localhost
		// username => root
		// password => empty
		// database name => staff
		
		$conn = mysqli_connect("localhost", "vtworks_natarajbar", "vtworks_natarajbar", "vtworks_natarajbar");
		
		// Check connection
		if($conn === false){
			die("ERROR: Could not connect. "
				. mysqli_connect_error());
		}
		
		// Taking all 5 values from the form data(input)
		$brand_name = $_REQUEST['brand_name'];
		$ac = $_REQUEST['ac'];
		$nonac = $_REQUEST['nonac'];
		$janatha = $_REQUEST['janatha'];
		
		// Performing insert query execution
		// here our table name is rates
		$sql = "INSERT INTO rates VALUES ('','$brand_name', '$ac','$nonac','$janatha','','1')";
		
		if(mysqli_query($conn, $sql)){
		    
		    
		//	echo "<h3>data stored in a database successfully."
		//		. " Please browse your localhost php my admin"
		//		. " to view the updated data</h3>";

		//	echo nl2br("\n$brand_name\n $ac\n "
		//		. "$nonac\n $janatha");
		
		echo "<h4>Successfully Added!!<br><a href='rates.php'>Click here</a>";
		    
		} else{
			echo "ERROR: Hush! Sorry $sql. "
				. mysqli_error($conn);
		}
		
		// Close connection
		mysqli_close($conn);
		?>
	</center>
</body>

</html>

