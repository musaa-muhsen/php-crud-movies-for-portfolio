<?php 

session_start(); 

$mysqli = new mysqli('localhost', 'musaa', '1234', 'crud-tut-1') or die(mysqli_error($mysqli));

$name = $location = '';
$update = false;

// check if save has been pressed 
if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $location = $_POST['location'];

 
    // insert into database 
    // The die() function is an alias of the exit() function.
    $mysqli->query("INSERT INTO data (name, location) VALUES('$name', '$location')") or die($mysqli->error);
    

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
} 

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());
    
    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
    // count($result does'nt work due to php version 
    if($result->num_rows) { 
       $row = $result->fetch_array();
       $name = $row['name'];
       $location = $row['location'];

    }
     
}


if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("UPDATE data SET name='$name', location='$location' WHERE id=$id") or die($mysqli->error); 

    $_SESSION['message'] = "&#8986; Record has been updated!";
    $_SESSION['msg_type'] = "warning";

    header('location: index.php');
}
?>