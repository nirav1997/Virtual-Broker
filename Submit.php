<?php
error_reporting( E_ALL & ~E_NOTICE );
// Create connection
$servername = "localhost";
$username = "id2802634_vbnirav";
$password = "asdfghjkl";
$dbname = "id2802634_virtualbroker";

$link = mysqli_connect($servername, $username, $password, $dbname);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$Area = mysqli_real_escape_string($link, $_REQUEST['Area']);
$Name = mysqli_real_escape_string($link, $_REQUEST['Name']);
$Location = mysqli_real_escape_string($link, $_REQUEST['Location']);
$BHK = mysqli_real_escape_string($link, $_REQUEST['BHK']);


    $sql = "INSERT INTO rooms (Area,Name,Location,BHK) VALUES ('$Area', '$Name', '$Location','$BHK')";


   if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
  
    
  




//Starts from here




$errors = array();
$uploadedFiles = array();
$extension = array("jpeg","jpg","png","gif");
$bytes = 1024;
$KB = 1024;
$totalBytes = $bytes * $KB;
$UploadFolder = "images/$Location/$Area/$Name";

if (!file_exists($UploadFolder)) {
mkdir($UploadFolder, 0777, true); 
}
 
$counter = 0;
 
foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name){
    $temp = $_FILES["files"]["tmp_name"][$key];
    $name = $_FILES["files"]["name"][$key];
     
    if(empty($temp))
    {
        break;
    }
     
    $counter++;
    $UploadOk = true;
     
    
     
    $ext = pathinfo($name, PATHINFO_EXTENSION);
    if(in_array($ext, $extension) == false){
        $UploadOk = false;
        array_push($errors, $name." is invalid file type.");
    }
     
    if(file_exists($UploadFolder."/".$name) == true){
        $UploadOk = false;
        array_push($errors, $name." file is already exist.");
    }
     
    if($UploadOk == true){
        move_uploaded_file($temp,$UploadFolder."/".$name);
        array_push($uploadedFiles, $name);
    }
}
 
if($counter>0){
    if(count($errors)>0)
    {
        echo "<b>Errors:</b>";
        echo "<br/><ul>";
        foreach($errors as $error)
        {
            echo "<li>".$error."</li>";
        }
        echo "</ul><br/>";
    }
     
    if(count($uploadedFiles)>0){
        echo "<b>Uploaded Files:</b>";
        echo "<br/><ul>";
        foreach($uploadedFiles as $fileName)
        {
            echo "<li>".$fileName."</li>";
        }
        echo "</ul><br/>";
         
        echo count($uploadedFiles)." file(s) are successfully uploaded.";
    }                               
}
else{
    echo "Please, Select file(s) to upload.";
}

// close connection
mysqli_close($link);
?>