<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");

if(!isset($_SESSION['user_email'])){
  header("location: index.php");
}
?>
<html>
<head>
  <?php
    $user = $_SESSION['user_email'];
    $get_user = "select * from users where user_email='$user'";
    $run_user = mysqli_query($con,$get_user);
    $row = mysqli_fetch_array($run_user);

    $user_name = $row['user_name'];
  ?>
  <title><?php echo "$user_name"; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>

<body>

</body>
</html>




<?php
  
    if(isset($_GET['u_id'])){

    global $con;
    $get_id=$_GET['u_id'];

    $get_user="select * from users where id='$get_id'";
    $run_user=mysqli_query($con,$get_user);
    $row_user=mysqli_fetch_array($run_user);

    $user_to_msg=$row_user['id'];//url of each user 
    $user_to_name=$row_user['f_name'];
    


  }



  $user=$_SESSION['user_email'];
  $get_user="select * from users where user_email='$user'";
  $run_user=mysqli_query($con,$get_user);
  $row=mysqli_fetch_array($run_user);


     $user_from_msg=$row['id']; //session
     $user_from_name=$row['user_name'];
     $gonderen=$row['f_name'];

?>


  <h1 style='text-align:center;'>Your friend requests </h1>
  <div class="well">
       <?php



    $sql="SELECT * FROM friend_requests where  user_to='$gonderen'";
    $run_f=mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($run_f)){
      $friend_name=$row['user_to'];
      $friend_value=$row['value'];
      $friend_name_from=$row['user_from'];


}




?>
 



        <?php


    $sql="SELECT * FROM friend_requests where value=1 AND user_to='$gonderen'";
    $run_f=mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($run_f)){
      $friend_name=$row['user_to'];
      $friend_value=$row['value'];
    
    
    


    ?>
    <div<?php if ($friend_value == 0) echo " style='display: none';"; ?>>

  <?php
       echo '<h3 class="confirm">'.$friend_name_from.'<form method="POST"><input type="submit"  name="confirm" class="btn btn-success confirm" value="accept"><input type="submit"  name="decline" class="btn btn-danger dec" value="decline"></form></h3>'."<br>";


   } 

    ?>

<?php

    if(isset($_POST['decline'])){

      //$get_id_friend=$_GET['u_id'];
   
 ?>

<script>
    $(document).ready(function(){

                 
     $('.confirm').hide();


         });

           </script>
<?php
         $sqll="DELETE  FROM friend_requests WHERE value=1 AND user_from='$friend_name_from'";
 
                $run_selectt=mysqli_query($con,$sqll);
               //header("Location:messages.php?u_id?$gonderen");

           

              
    }


  ?>



     
<?php


//request for confirming
    if(isset($_POST['confirm'])){

?>
  <script>
    $(document).ready(function(){

         $('.confirm').hide();

             });

           </script>



<?php
      //$friend_request2=$_POST['confirm'];

         $sql="SELECT * FROM friend_requests WHERE '$gonderen'=user_from";
                $run_select=mysqli_query($con,$sql);
               $count_row=mysqli_num_rows($run_select);

                if($count_row >0){

            echo "You can not accept a friendship instead of ".$friend_name_from;
      

                }else{

                   $create_request=mysqli_query($con,"UPDATE friend_requests  SET value='2'");
              echo "<strong style='color:red'>".$gonderen."</strong> "." Confirmed a request from "."<strong style='color:red'>".$friend_name_from."</strong>";
            
               }



           }
            

      
    


  ?>















    </div>



