<?php
$servername = "localhost";
$username = "id2802634_vbnirav";
$password = "asdfghjkl";
$dbname = "id2802634_virtualbroker";

// Create connection
//$Name = mysqli_real_escape_string($link, $_REQUEST['Name']);


$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$Area = mysqli_real_escape_string($conn, $_REQUEST['Area']);

$LocationArr = array();
$AreaArr = array();
$NameArr = array();
$ImageArr = array();

$sql = "SELECT Name,Area,Location FROM rooms WHERE Area= '$Area'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        if($Area == $row["Area"])
        {

        	//echo "Name " . $row["Name"]. " - Location " . $row["Location"]. " Area " . $row["Area"]. "<br>";

        	$Location = $row["Location"];
        	$Name 	  = $row["Name"];
        	$Area 	  = $row["Area"];
        	array_push($LocationArr, $Location);
        	array_push($AreaArr, $Area);
        	array_push($NameArr, $Name);
        
    
			$dirArray = array();
			$Directory_name ="images/$Location/$Area/$Name";
			$myDirectory = opendir($Directory_name);

					// get each entry
				while($entryName = readdir($myDirectory)) {
					
					array_push($dirArray, $entryName);
					
				}
			//echo $Directory_name;
					// close directory


					//	count elements in array
			$indexCount	= count($dirArray);
			//echo $indexCount;
			$image = array();
			for($index=0; $index < $indexCount; $index++) {
				$extension = substr($dirArray[$index], -3);
				// list only jpgs
					$filedir = "https://wwwnkdeveloperstk.000webhostapp.com/$Directory_name/$dirArray[$index]";
					//echo '<img src='.$filedir.' />';
					array_push($image, $filedir);
					//echo $filedir;
				
			}
			array_push($ImageArr, $image);

			closedir($myDirectory);

		}

	}
} else {
    echo "0 results";
}

for($i = 0;$i<count($LocationArr);$i++)
{

	echo $NameArr[$i] .'</br>';
	echo $LocationArr[$i] . '</br>';
	echo $AreaArr[$i]. '</br>';

	for($j = 2;$j<count($ImageArr[$i]);$j++)
	{

		$filedir = $ImageArr[$i][$j];
		echo '<img src='.$filedir.' width="200"/>';

	}


}

mysqli_close($conn);
?>