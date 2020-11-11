<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
<?php require_once 'process.php'; ?>
<?php  if(isset($_SESSION['message'])): 
    // It's a shorthand for <?php echo $_SESSION['msg']  >?  //It's enabled by default since 5.4 regardless of php.ini settings.
    ?>
    <div class="alert alert-<?=$_SESSION['msg_type']; ?>">
    <?php 
       echo $_SESSION['message'];
       unset($_SESSION['message']);
    ?>
    </div>
<?php endif; ?>


<div class="container">
<?php 

// this becomes objected oriented???
$mysqli = new mysqli('localhost', 'musaa', '1234', 'crud-tut-1') or die(mysqli_error($mysqli));

// -> calls/sets object variables. // The object operator, ->, is used in object scope to access methods and properties of an object. It’s meaning is to say that what is on the right of the operator is a member of the object instantiated into the variable on the left side of the operator. Instantiated is the key term here.
$result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
// pre_r($result); //mysqli_result Object all the records from the database 
//pre_r($result->fetch_assoc()); // prints out a record to the screen 
?>
<div class="row justify-content-center">
<table class="table">
<thead>
     <tr>
          <th>Name</th>
          <th>Location</th>
          <th colspan="2">Action</th>
      </tr>
</thead>
<?php 
   while ($row = $result->fetch_assoc()): ?>

   <tr>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['location']; ?></td>
        <td>
        <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
        <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
        </td>
   </tr>
   <?php endwhile; ?>
</table>
</div>
<?php  

// function for print_r 
function pre_r($array) {
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

?>

<div class="row justify-content-center">
   <form action="process.php" method="POST">
   <input type="hidden" name="id" value="<?php echo $id; ?>">
   <div class="form-group">
       <label>Name</label>
       <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter you name">
       </div>
       <div class="form-group">
     
       <label>Location</label>
       <input type="text" name="location" class="form-control" value="<?php echo $location; ?>"  placeholder="Enter your location">
       </div>

       <div class="form-group">
       <?php if ($update == true): ?>
         <button class="btn btn-info" type="submit" name="update">Update</button>
       <?php else: ?>
           <button class="btn btn-primary" type="submit" name="save">Save</button>
       <?php endif; ?>
       </div>

   </form> 
   </div>
   </div>
</body>
</html>