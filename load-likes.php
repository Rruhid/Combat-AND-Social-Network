
<?php
$msg_id = $_GET['id'];
?>


<?php
include('includes/connection.php');
 
$id = $msg_id;

 $sel_ms="SELECT * from users INNER JOIN likes ON users.id=likes.user_id and likes.post_id=$id";
  $run_ms=mysqli_query($con,$sel_ms);

  while($row_ms=mysqli_fetch_array($run_ms)){ 
    $name=$row_ms['f_name'];
  echo $name."<br>";
 } 


  ?>