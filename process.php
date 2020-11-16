<?php 

// always at the top 
session_start(); 

 $mysqli = new mysqli('localhost', 'musaa', '1234', 'crud-tut-1') or die(mysqli_error($mysqli));
//$mysqli = new mysqli('localhost', 'ubvbtwazxdfbm', '1F15(do^15sj', 'dbt6jaem5yn8tj') or die(mysqli_error($mysqli));

// die() function Print a message and terminate the current script: // The die() function is an alias of the exit() function.

$name = $plot = $seen = '';
$update = false;
$babe = 'Babe Friendly';

// check if save has been pressed 
if (isset($_POST['save'])) {
    $name = $mysqli -> real_escape_string($_POST['name']);
    $plot = $mysqli -> real_escape_string($_POST['plot']);
    $seen = $mysqli -> real_escape_string($_POST['seen']);
    $babe = $mysqli -> real_escape_string($_POST['babe']);

 
    // insert into database 
    
    $mysqli->query("INSERT INTO data (name, plot, seen, babe) VALUES('$name', '$plot', '$seen', '$babe' )") or die($mysqli->error);
    $_SESSION['message'] = "&#127902; Saved!";
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
       $plot = $row['plot'];
       $seen = $row['seen'];
       $babe = $row['babe'];
    }
     
}

// update 
if (isset($_POST['update'])) {
    $id = $mysqli -> real_escape_string($_POST['id']);
    $name = $mysqli -> real_escape_string($_POST['name']);
    $plot = $mysqli -> real_escape_string($_POST['plot']);
    $seen = $mysqli -> real_escape_string($_POST['seen']);
    $babe = $mysqli -> real_escape_string($_POST['babe']);

    $mysqli->query("UPDATE data SET name='$name', plot='$plot', seen='$seen', babe='$babe' WHERE id=$id") or die($mysqli->error); 

    $_SESSION['message'] = "&#9989; Updated!";
    $_SESSION['msg_type'] = "warning";

    header('location: index.php');
}
?>