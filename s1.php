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
			<div class="col-sm-3" id="select_user">
  
<?php
	
		if(isset($_GET['u_id'])){
		$get_id=$_GET['u_id'];

	}

		$get_user="select * from users where id='$get_id'";
		$run_user=mysqli_query($con,$get_user);
		$row_user=mysqli_fetch_array($run_user);

		$user_to_msg=$row_user['id'];//url of each user 
		$user_to_name=$row_user['f_name'];
		


//session
	$user=$_SESSION['user_email'];
	$get_user="select * from users where user_email='$user'";
	$run_user=mysqli_query($con,$get_user);
	$row=mysqli_fetch_array($run_user);


     $user_from_msg=$row['id']; //session
     $user_from_name=$row['user_name'];
     $gonderen=$row['f_name'];
?>

<div class='col-sm-3'>
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
      	$friend_name_from='';

   	// var_dump($gonderen);
   	// var_dump($friend_name_from);
   	// exit;

  $sql="SELECT * FROM friend_requests where value=2 AND user_to='$gonderen' OR user_from='$friend_name_from'";

    $run_f=mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($run_f)){
      $friend_id=$row['id'];
      $friend_too=$row['user_to'];
      $friend_value=$row['value'];
      $friend_fromm=$row['user_from'];

if($gonderen == $friend_too ){
  echo 
		"<form method='POST' action='s1.php?u_id=$friend_id' class='inline'>

		<div class='container-fluid'>
	 <button style='text-decoration:none;' type='submit' name='submit_param' value='submit_value' class='link-button'>
		   <img class='img-circle' src='users/$user_image' width='90px' height='80px' title='$user_name'><strong>&nbsp $friend_fromm</strong><br><br>
		  </button>
		</div>
		 
</form>";

}else{
	echo 
	"<form method='POST' action='s1.php?u_id=$friend_id' class='inline'>

		<div class='container-fluid'>
	 <button style='text-decoration:none;' type='submit' name='submit_param' value='submit_value' class='link-button'>
		   <img class='img-circle' src='users/$user_image' width='90px' height='80px' title='$user_name'><strong>&nbsp $friend_too</strong><br><br>
		  </button>
		</div>
		 
</form>";


}




			
	
	

	}


		?>

<?php


	// if(isset($_GET['u_id'])){
	// 		$u_id=$_GET['u_id'];
		
	// 		$sql="UPDATE user_messages SET msg_seen='1' where user_from='$friend_id' AND user_from='$u_id'";
	// 	mysqli_query($con,$sql); 
	// 	}	
	  

?>


	</div>

	</div>

		<div class='col-sm-6' >
		<div class='load-msg' id='select_user2' id='scroll-messages'>
		<?php

	if(isset($_POST['send_msg'])){
		$u_id=$_GET['u_id'];

			$textcode=array(':D',':P');
			$smiles=array('<img src="images/smile.png">','<img src="images/smile7.png">');
			$str_replace=str_replace($textcode,$smiles,$_POST['msg_box']);

			$msg1=htmlentities($_POST['msg_box']);
			 $msg=str_replace($msg1,$str_replace,$_POST['msg_box']);
			if($msg ==""){
				echo "<h4 style='color:red;text-align:center;'>Message was unable to send</h4>";
			}else if(strlen($msg)>37){
				echo "<h4 style='color:red;text-align:center;'>Message was unable too long!use only 37 characters</h4>";
			}else{
			$insert="insert into user_messages (user_to,user_from,msg_body,date,msg_seen) value ('$u_id','$user_from_msg','$msg',NOW(),'0')";
				$run_insert=mysqli_query($con,$insert);
				
			}


		}


	?>






	
	<?php

//sexsi chat yeri
		if(isset($_GET['u_id'])){
			$u_id=$_GET['u_id'];
   $sel_msg="select * from user_messages where( user_to='$u_id' && user_from='$user_from_msg') OR(user_from='$u_id' AND user_to='$user_from_msg') ORDER BY 1 ASC";


	$run_msg=mysqli_query($con,$sel_msg);
	while($row_msg=mysqli_fetch_array($run_msg)){
		$msg_id=$row_msg['m_id'];
		$user_to=$row_msg['user_to'];
		$user_msg=$row_msg['msg_seen'];
		$user_from=$row_msg['user_from'];
		$msg_body=$row_msg['msg_body'];
		$msg_date=$row_msg['date'];

		?>

		<div id="loaded_msg">
			<p><?php

		if($user_to == $u_id AND $user_from == $user_from_msg){ 
				echo "<div class='message' id='blue' data-toogle='tooltip' title='$msg_date'>$msg_body<br><small>$msg_date</small></div><br><br><br>";

	    }else if	($user_from == $u_id AND $user_to=$friend_id){
	    	echo "<div class='message' id='green' data-toogle='tooltip' title='$msg_date'>$msg_body<br><small>$msg_date</small></div><br><br>";
	    	      echo "<br>";

			}?></p>

		</div>
	
	<?php } }?>




			
</div>



<?php


//textarea yeri

		if(isset($_GET['u_id'])){
			$u_id=$_GET['u_id'];
			if($u_id == "new"){
				echo '

				<form>
				<center><h3>Select someone to start conversation</h3></center>
				<textarea  class="form-control" name="msg_box" placeholder="Enre your message"></textarea>
				<input type="submit" name="send_msg" disabled class="btn btn-default" value="send">
				</form>

				';
			}else{

				echo '

				<form action="" method="POST">
				<textarea class="form-control" placeholder="Enter your message" name="msg_box" id="message_textarea"></textarea>
				<input type="submit" name="send_msg" id="btn-msg" class="btn btn-default"  value="send">
				</form><br><br>

				';
			}

	}

?>


	</div>

	</div>
<script>

</script>


</body>
</html>





