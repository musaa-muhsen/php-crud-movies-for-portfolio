<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/styles.css">
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
   </div>
<?php endif; ?>

<header>
    <div>	<h1><span class="cow-emoji">&#128004;</span>vies </h1></div>
    <!-- <div></div>
    <div> <h1><a class="header-btn" href="">GO TO &#127902;</a></h1></div> -->
</header>


<form class="form-container form__group field" action="process.php" method="POST">
   <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="form-inputs form-inputs-1 ">
       <!-- <label>Title:</label> -->
       <input required type="text" name="name" class="form-single " value="<?php echo $name; ?>" placeholder="Title:">
       </div>
       

       <div class="form-inputs form-inputs-2">
       
       <textarea class="plot form-single" placeholder="Plot:" name="location" rows="5" cols="40" value="<?php echo $location; ?>"></textarea>

       </div>

       <div class="form-inputs form-inputs-3">
       <!-- <label>Seen on:</label> &#128190; // floppy desk -->
       <input  type="text" name="seen" class="form-single seen-input" value="<?php echo $seen; ?>"  placeholder="Seen on:">
       </div>

       <div class="submit-container">
       <?php if ($update == true): ?>
        <div > <button   class="update-btn" type="submit" name="update">Update</button> </div>
       <?php else: ?>
        <div> <button class="save-btn" type="submit" name="save">Save</button> </div>
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
<footer>
   <p> Musaa Muhsen <?php echo date("Y"); ?> &copy; </p>
   </footer>



</body>
</html>