<?php require_once 'process.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
  <?php include "./css/styles.css" ?>
</style>

</head>
<body>



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
    <!-- <div> </div>
    <div> <h1><a class="header-btn" href="">GO TO &#127902;</a></h1></div> -->
</header>


<form class="form-container form__group field" action="process.php" method="POST">
   <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="form-inputs form-inputs-1 ">
       <!-- <label>Title:</label> -->
       <input required type="text" name="name" class="form-single " value="<?php echo $name; ?>" placeholder="Title:">
       </div>
       

       <div class="form-inputs form-inputs-2">
       
       <textarea class="plot form-single" placeholder="Plot:" name="plot" ><?php echo $plot; ?></textarea>

       </div>

       <div class="form-inputs form-inputs-3">
       <!-- <label>Seen on:</label> &#128190; // floppy desk -->
       <input  type="text" name="seen" class="form-single seen-input" value="<?php echo $seen; ?>"  placeholder="Seen on:">
       </div>
       <div>
          <!-- <input type="checkbox"  name="babe" value="babe friendly">
          <label for="babe">Babe Friendly</label> -->
          <select class="select-babe" name="babe">
  <option name="babe1" value="Babe Friendly">Babe friendly</option>
  <option name="babe2" value="Not Babe Friendly">Not babe friendly</option>

</select>
       </div>

       <div class="submit-container">
       <?php if ($update == true): ?>
        <div > <button   class="update-btn" type="submit" name="update">Update</button> </div>
       <?php else: ?>
        <div> <button class="save-btn" type="submit" name="save">Save</button> </div>
       <?php endif; ?>
       </div>

   </form> 
   <!-- <div class="results-container"> &#127902; -->

<div class="list-title">
   <h2>&#127902;list</h2>
</div>

<?php 

// this becomes objected oriented???
$mysqli = new mysqli('localhost', 'musaa', '1234', 'crud-tut-1') or die(mysqli_error($mysqli));
//$mysqli = new mysqli('localhost', 'ubvbtwazxdfbm', '1F15(do^15sj', 'dbt6jaem5yn8tj') or die(mysqli_error($mysqli));

// -> calls/sets object variables. // The object operator, ->, is used in object scope to access methods and properties of an object. It’s meaning is to say that what is on the right of the operator is a member of the object instantiated into the variable on the left side of the operator. Instantiated is the key term here.
$result = $mysqli->query("SELECT * FROM data ORDER BY created_at DESC") or die($mysqli->error);
// pre_r($result); //mysqli_result Object all the records from the database 
//pre_r($result->fetch_assoc()); // prints out a record to the screen 
?>

<?php 
   while ($row = $result->fetch_assoc()): ?>
    <section class="result-indie">
       <!-- 📝 -->
           <article class="title-row info-row"><div class="row-name"><p class="make-bigger">🎬</p></div>  <div> <p><?php echo $row['name']; ?></p> </div></article> 
           <article class="plot-row info-row"><div class="row-name"><p class="make-bigger">📖</p></div>  <div class="plot-writing"> <p><?php echo $row['plot']; ?></p> </div></article> 
           <div class="split-div">
           <article class="seen-row info-row"><div class="row-name"><p class="make-bigger">👀</p></div>  <div class="seen-writing"> <p><?php echo $row['seen']; ?></p> </div></article> 
           <article class="seen-row info-row"><div class="row-name"><p class="make-bigger">🔞</p></div>  <div class="seen-writing"> <p class="make-small"><?php echo $row['babe']; ?></p> </div></article>
          </div>
        <div class="buttons-container">
           <div class="buttons-wrapper">
               <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info make-bigger">✏️</a>
               <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger make-bigger">&#128465;
                </a>
        </div>
        </div>
   </section>
    <?php endwhile; ?>
   
<?php  

?>
<!-- </div> -->
<footer>
   <p> Musaa Muhsen <?php echo date("Y"); ?> &copy; </p>
   </footer>



</body>
</html>