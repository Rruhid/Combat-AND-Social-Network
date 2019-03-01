
<?php
include("includes/connection.php");
session_start();
if(!isset($_SESSION['user_email'])){
	header("Location:index.php");

}
?>

   <?php 

      $user = $_SESSION['user_email'];
      $get_user = "select * from users where user_email='$user'"; 
      $run_user = mysqli_query($con,$get_user);
      $row=mysqli_fetch_array($run_user);
          
      $user_id = $row['id']; 
      $user_name = $row['user_name'];
      $first_name = $row['f_name'];
      $last_name = $row['l_name'];
      $describe_user = $row['describe_user'];
      $Relationship_status = $row['Relationship'];
      $user_pass = $row['user_pass'];
      $user_email = $row['user_email'];
      $user_country = $row['user_country'];
      $user_gender = $row['user_gender'];
      $user_birthday = $row['user_birthday'];
      $user_image = $row['user_image'];
      $user_cover = $row['user_cover'];
      $recovery_account = $row['recovery_account'];
      $register_date = $row['user_reg_date'];
          
          
      $user_posts = "select * from posts where user_id='$user_id'"; 
      $run_posts = mysqli_query($con,$user_posts); 
      $posts = mysqli_num_rows($run_posts);

    ?>
<?php


	if(isset($_POST)){

		if($_SESSION){

      $id=$_POST['id'];
   //$msg["hata"]=$user_id;

          $query="SELECT * FROM likes WHERE post_id='$id' AND user_id='$user_id'";
          $query= mysqli_query($con,$query);
         $check_like = mysqli_num_rows($query);
         if($check_like > 0){
          
             $msg["hata"] = "You have already liked it";

           } else{

                    		$sqll="INSERT INTO likes (l_id,post_id,user_id) VALUES (null,'$id','$user_id')";
                     		mysqli_query($con,$sqll);
                        $update="UPDATE messages SET like_p=like_p+1  WHERE id='$id'";
                       mysqli_query($con,$update);


                		
         }

  
		}else{

     		 $msg["hata"] ="Please logged in";


		}


	}

echo json_encode($msg);
?>