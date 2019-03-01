	                     <!--  echo "<a href='readen.php?id=$msg_id' class='btn btn-info btn-sm'>$user_msg</a><br>"; -->
<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");
if(!isset($_SESSION['user_email'])){
	header("Location:index.php");

}
?>
<html>
<head>
	<title>Signin</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style>
#scroll_messages{
		max-height: 500px;
		overflow: scroll;
	}
	#btn-msg{
		width:20%;
		height: 28px;
		border-radius: 5px;
		border:none;
		color:#fff;
		float:right;
		background-color:#2ecc71;
	}
		#select_user{
		max-height: 500px;
		overflow: scroll;
	}
	#select_user2{
		max-height: 500px;
		overflow: scroll;
	}
#green{
	background-color: #2ecc71;
	border-color:#2980b9;
	width:45%;
	padding:2.5px;
	font-size:16px;
	border-radius:3px;
	float:left;
	margin-bottom:5px;
}
#blue{
background-color: #3498db;
	border-color:#2980b9;
	width:45%;
	padding:2.5px;
	font-size:16px;
	border-radius:3px;
	float:right;
	margin-bottom:5px;
}


</style>

<body>

<style>
	.inline {
  display: inline;
}

.link-button {
  background: none;
  border: none;
  color: blue;
  text-decoration: underline;
  cursor: pointer;
  font-size: 1em;
  font-family: serif;
}
.link-button:focus {
  outline: none;
}
.link-button:active {
  color:red;
}
</style>
<!-- https://www.youtube.com/watch?v=8T8yonm_zbw
 -->	<div class="row">
			<div class="col-sm-4 col-sm-offset-2" id="select_user">
  
<?php
	
		if(isset($_GET['u_id'])){
		$get_id=$_GET['u_id'];

	}

		$get_user="select * from users where id='$get_id'";
		$run_user=mysqli_query($con,$get_user);
		$row_user=mysqli_fetch_array($run_user);

		$user_to_msg=$row_user['id'];//url of each user 
		$user_to_name=$row_user['f_name'];
		



	$user=$_SESSION['user_email'];
	$get_user="select * from users where user_email='$user'";
	$run_user=mysqli_query($con,$get_user);
	$row=mysqli_fetch_array($run_user);


     $user_from_msg=$row['id']; //session
     $user_from_name=$row['user_name'];
     $gonderen=$row['f_name'];
?>

<?php

	if(isset($_GET['u_id'])){
			$u_id=$_GET['u_id'];
		
			$sql="UPDATE user_messages SET msg_seen='1' where user_from=$user_to_msg AND user_from=$u_id";
		mysqli_query($con,$sql); 
		}	
	  

?>

	<?php


	
   	 $sql = "SELECT * FROM users WHERE id!=$user_from_msg";

    $run_messages = mysqli_query($con,$sql);
		while($row_user=mysqli_fetch_array($run_messages)){
			$user_id=$row_user['id'];
			$user_name=$row_user['user_name'];
			$first_name=$row_user['f_name'];
			$last_name=$row_user['l_name'];
			$user_image=$row_user['user_image'];


			

		$count_messages="SELECT * FROM user_messages WHERE msg_seen='0' AND user_to=$user_from_msg AND user_from=$user_id";
		$count_query=mysqli_query($con,$count_messages);
		$countt=mysqli_num_rows($count_query);

			echo 
		"<form method='POST' action='messages.php?u_id=$user_id' class='inline'>

		<div class='container-fluid'>
		  <input type='hidden' name='extra_submit_param' value='extra_submit_value'>
		  <button style='text-decoration:none;' type='submit' name='submit_param' value='submit_value' class='link-button'>
		   <img class='img-circle' src='users/$user_image' width='90px' height='80px' title='$user_name'><strong>&nbsp $first_name $last_name<span class='badge badge-secondary'>$countt</span></strong><br><br>
		  </button>
		</div>
		 
</form>";
	
	

	}


		?>





	</div>

	<div class='col-sm-3' >
	</div>
	
	<!--select yeri 6-->
	<div class="col-sm-4">

<?php

//boyurdeki sekil ve dosu elave etme 
		if(isset($_GET['u_id'])){

		global $con;
		$get_id=$_GET['u_id'];

		$get_user="select * from users where id='$get_id'";
		$run_user=mysqli_query($con,$get_user);
		$row=mysqli_fetch_array($run_user);
		    $user_id = $row['id']; 
			$user_name = $row['user_name'];
			$f_name = $row['f_name'];
			$l_name = $row['l_name'];
			$describe_user = $row['describe_user'];
			$user_country = $row['user_country'];
			$user_image = $row['user_image'];
            $register_date = $row['user_reg_date'];
			$gender = $row['user_gender'];
          }
			if($get_id == "new"){



			}else{


      	echo "
         	<div class='row'>
         		<div class='col-sm-2'>
         		</div>
         		<center>
         		<div style='background-color:#e6e6e6;' class='col-sm-9'>
         		<h2>Infomation About</h2>
         		<img class='img-circle 'src='users/$user_image' width='150' height='150'>
         		<br><br>
         		<ul class='list-group'>
         		<li class='list-group-item' title='username'><strong>$f_name $l_name</strong></li>
         		<li class='list-group-item' title='user status'><strong>$describe_user</strong></li>
         		<li class='list-group-item' title='Gender'><strong>$gender</strong></li>
                <li class='list-group-item' title='Gender'><strong>$register_date</strong></li>
         	";}
                  ?>   

                    <form method='POST' action='messages.php?<?php echo "u_id=$user_id" ?>'>


		    <?php
		    $friend_value='';        
		    $sql="SELECT * FROM friend_requests  WHERE  user_from='$gonderen'AND user_to='$user_to_name'";
		    $run_f=mysqli_query($con,$sql);
		    while($row=mysqli_fetch_array($run_f)){
		      $friend_name=$row['user_to'];
		      $friend_name_fr=$row['user_from'];
		    //  $friend_value[$row['user_to']] = $row['value'];
		      $friend_value=$row['value'];

  			}


  				

		      if($friend_value ==1){

		      	echo "    <li><input type='submit'  value='Decline'  name='decline' type='submit' class='btn btn-danger dec'><br>
                </form>
		        </ul>
         		</div>
         		<div class='col-sm-1'>
         		</div>
         	</div>";

		      }else{

		      	echo "    <li><input type='submit'  value='Decline'  name='decline' type='submit' class='btn btn-danger dec'><input type='submit' name='addfriend' value='Add' id='$user_id' type='submit' class='btn btn-primary ad'><br>
                </form>
		        </ul>
         		</div>
         		<div class='col-sm-1'>
         		</div>
         	</div>";
		      
		      }

      
    ?>

    <?php
//     var_dump($gonderen);
//     var_dump($user_to_name);
//     exit;
if(isset($_POST['submit_param'])){


         $sql="SELECT * FROM friend_requests WHERE user_from='$gonderen' AND user_to='$user_to_name' || user_from='$user_to_name' AND user_to='$gonderen'";
                $run_select=mysqli_query($con,$sql);
		     $check_friend = mysqli_num_rows($run_select);



                if($check_friend >=1){

                   ?>
                <script>
				$(document).ready(function(){
                 $('.ad').hide();
               

			});
              </script>
           <?php


			    //              echo "<h4 style='margin-right:260px; color:green;'>Your request has been send already</h4>";
			            

			    //         }else{

			    //         $create_request=mysqli_query($con,"INSERT INTO friend_requests (user_from,user_to,value) VALUES ('$gonderen','$user_to_name','1')");

			    //           //echo "<strong>".$gonderen."</strong>"." send  a friendship to "."<strong>".$user_to_name."</strong>";
			    //          echo "<h4 style='margin-right:260px;'><span style='color:red'>".$gonderen."</span> send a friendship to <span style='color:red'>".$user_to_name."</span></h4>";
			          
			    //         }


			      
			    // }

    	}
    }
 


?>



<?php

    if(isset($_POST['decline'])){
    	$get_id_friend=$_GET['u_id'];
?>         

     <script>
		$(document).ready(function(){

                 
                 $('.ad').show();
		});

           </script>
       
           <?php

         $sqll="DELETE FROM friend_requests WHERE user_from='$gonderen' AND user_to='$user_to_name'";
 
                $run_selectt=mysqli_query($con,$sqll);

         //   }
              
    }


  ?>
















	

	</div>
</div>
<div style='float:right; margin-right:20px'>





<?php

    if(isset($_POST['addfriend'])){


     $get_id_friend=$_GET['u_id'];
      echo $get_id_friend;
     
     //  $friend_request=$_POST['addfriend'];


    ?>
                <script>
				$(document).ready(function(){
                 $('.ad').hide();
               

			});
              </script>
           <?php

$connn='';

         $sql="SELECT * FROM friend_requests WHERE user_from='$gonderen' AND user_to='$user_to_name' || user_from='$user_to_name' AND user_to='$gonderen'";
                $run_select=mysqli_query($con,$sql);
		     $check_friend = mysqli_num_rows($run_select);



                if($check_friend >=1){

                   ?>
                <script>
				$(document).ready(function(){
                 $('.ad').hide();
               

			});
              </script>
           <?php


                 echo "<h4 style='margin-right:260px; color:green;'>Your request has been send already</h4>";
            

            }else{

            $create_request=mysqli_query($con,"INSERT INTO friend_requests (user_from,user_to,value) VALUES ('$gonderen','$user_to_name','1')");

              //echo "<strong>".$gonderen."</strong>"." send  a friendship to "."<strong>".$user_to_name."</strong>";
             echo "<h4 style='margin-right:260px;'><span style='color:red'>".$gonderen."</span> send a friendship to <span style='color:red'>".$user_to_name."</span></h4>";
          
            }


      
    }

    	
  ?>


</div>
 

</body>
</html>





