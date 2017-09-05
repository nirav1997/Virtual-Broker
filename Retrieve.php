<?php
$servername = "localhost";
$username = "id2802634_vbnirav";
$password = "asdfghjkl";
$dbname = "id2802634_virtualbroker";

// Create connection
//$Name = mysqli_real_escape_string($link, $_REQUEST['Name']);
$Name = "Nirav123";
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "SELECT Name,Area,Location FROM rooms";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        if($Name == $row["Name"])
        {

        	echo "Name " . $row["Name"]. " - Location " . $row["Location"]. " Area " . $row["Area"]. "<br>";
        	$Location = $row["Location"];
        	$Name 	  = $row["Name"];
        	$Area 	  = $row["Area"];
        }
    }
} else {
    echo "0 results";
}
$i = 0;
$Directory_name ="images/$Location/$Area/$Name";
$myDirectory = opendir($Directory_name);

		// get each entry
	while($entryName = readdir($myDirectory)) {
       echo $entryName;
	$dirArray[$i] = $entryName;
    $i = $i + 1;
}
echo $Directory_name;

		// close directory
closedir($myDirectory);

		//	count elements in array
$indexCount	= count($dirArray);
echo $indexCount;
for($index=0; $index < $indexCount; $index++) {
	$extension = substr($dirArray[$index], -3);
	      
		echo '<img src="$dirArray[$index]" alt="Image" />
		
		
}

mysqli_close($conn);
?>