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
	//userin id 
	$user=$_SESSION['user_email'];
	$get_user="select * from users where user_email='$user'";
	$run_user=mysqli_query($con,$get_user);
	$row=mysqli_fetch_array($run_user);


     $user_from_msg=$row['id']; //session
     $user_from_name=$row['user_name'];
     $gonderen=$row['f_name'];

//messaglarin cixdigi yer
  $sel_msg="select * from messages LEFT JOIN users ON messages.user_id=users.id ORDER BY 5 ASC LIMIT 7";
  $run_msg=mysqli_query($con,$sel_msg);
  while($row_msg=mysqli_fetch_array($run_msg)){ 
   //$id=$row_msg['id'];
    $id = $row_msg[0];

    $user_id=$row_msg['user_id'];
    $msg2=$row_msg['messages'];
    $date=$row_msg['date'];
    $username=$row_msg['f_name'];
}
    ?>


