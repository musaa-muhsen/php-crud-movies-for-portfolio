<?php 

session_start(); 

$mysqli = new mysqli('localhost', 'musaa', '1234', 'crud-tut-1') or die(mysqli_error($mysqli));

if(!$mysqli) {
    echo 'connection error' . mysqli_connect_error(); 
 }
$name = $location = $seen = '';
$update = false;

// check if save has been pressed 
if (isset($_POST['save'])) {
    $name = $mysqli -> real_escape_string($_POST['name']);
    $location = $mysqli -> real_escape_string($_POST['location']);
    $seen = $mysqli -> real_escape_string($_POST['seen']);

 
    // insert into database 
    // The die() function is an alias of the exit() function.
    $mysqli->query("INSERT INTO data (name, location, seen) VALUES('$name', '$location', '$seen')") or die($mysqli->error);
    

    $_SESSION['message'] = "&#127902; saved!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
} 

// delete 
if (isset($_GET['delete'])) {
    $id = $mysqli -> real_escape_string($_GET['delete']);
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());
    
    $_SESSION['message'] = "&#128680; Deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}

// edit 
if (isset($_GET['edit'])) {
    $id = $mysqli -> real_escape_string( $_GET['edit']);
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
    // count($result does'nt work due to php version 
    if($result->num_rows) { 
       $row = $result->fetch_array();
       $name = $row['name'];
       $location = $row['location'];
       $seen = $row['seen'];
    }
     
}

// update 
if (isset($_POST['update'])) {
    $id = $mysqli -> real_escape_string($_POST['id']);
    $name = $mysqli -> real_escape_string($_POST['name']);
    $location = $mysqli -> real_escape_string($_POST['location']);
    $seen = $mysqli -> real_escape_string($_POST['seen']);

    $mysqli->query("UPDATE data SET name='$name', location='$location', seen='$seen' WHERE id=$id") or die($mysqli->error); 

    $_SESSION['message'] = "&#9989; Updated!";
    $_SESSION['msg_type'] = "warning";

    header('location: index.php');
}
?>