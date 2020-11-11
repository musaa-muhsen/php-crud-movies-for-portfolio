<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
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
   
<?php endif; ?>

<form action="process.php" method="POST">
   <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="">
       <label>Title:</label>
       <input type="text" name="name" class="" value="<?php echo $name; ?>" placeholder="Enter you name">
       </div>

       <div class="">
       <label>Synopsis:</label>
       <input type="text" name="location" class="" value="<?php echo $location; ?>"  placeholder="Enter your location">
       </div>

       <div class="">
       <label>Seen on:</label>
       <input type="text" name="seen" class="" value="<?php echo $seen; ?>"  placeholder="Enter your location">
       </div>

       <div class="">
       <?php if ($update == true): ?>
         <button class="" type="submit" name="update">Update</button>
       <?php else: ?>
           <button class="" type="submit" name="save">Save</button>
       <?php endif; ?>
       </div>

   </form> 
   

<?php 

// this becomes objected oriented???
$mysqli = new mysqli('localhost', 'musaa', '1234', 'crud-tut-1') or die(mysqli_error($mysqli));

if(!$mysqli) {
    echo 'connection error' . mysqli_connect_error(); 
 }

// -> calls/sets object variables. // The object operator, ->, is used in object scope to access methods and properties of an object. It’s meaning is to say that what is on the right of the operator is a member of the object instantiated into the variable on the left side of the operator. Instantiated is the key term here.
$result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
// pre_r($result); //mysqli_result Object all the records from the database 
//pre_r($result->fetch_assoc()); // prints out a record to the screen 
?>
<div >

<?php 
   while ($row = $result->fetch_assoc()): ?>
    <div>
        <?php echo $row['name']; ?>
        <?php echo $row['location']; ?>
        <?php echo $row['seen']; ?>
        </div> 
        <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">✏️</a>
        <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">&#128465;
</a>
      
    <?php endwhile; ?>
   </div>
<?php  

?>



</body>
</html>