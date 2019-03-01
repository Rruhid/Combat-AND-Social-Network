<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");
include("includes/connection.php");
if(!isset($_SESSION['user_email'])){
	header("location: index.php");
}
?>

<?php
	
	$select="SELECT * FROM button where user_id='$user_id'";

	$run = mysqli_query($con,$select);
	
	while($row=mysqli_fetch_array($run)){
	$run_id = $row['id']; 
	 $x = $row['x'];
 	$y = $row['y'];
 	$derece=$row['degree'];
 	echo $derece;

 }

?>



<?php


	$string=file('file.txt');


	if(isset($_POST['up']) AND isset($_POST['x']) AND isset($_POST['y'])){

		$x=$_POST['x'];
		$y=$_POST['y'];

		foreach ($string as $key => $value) {

			   $r=rtrim($value);
			  $massiv = str_split($r); 
		
		for($i=0;$i<count($massiv);$i++){			
		//echo $key;
		// echo $i;
			

		     if($key==$x-1 AND $i==$y  AND $massiv[$i]==1){
		            $sql="UPDATE button SET x=x-1  WHERE user_id='$user_id'";
		 	        mysqli_query($con,$sql);

		}
	 
	}

 }
 	
}


 
 ?>
	
<?php	


if(isset($_POST['down']) AND isset($_POST['x']) AND isset($_POST['y'])){

		$x=$_POST['x'];
		$y=$_POST['y'];

		foreach ($string as $key => $value) {

			   $r=rtrim($value);
			  $massiv = str_split($r); 
		
		for($i=0;$i<count($massiv);$i++){			
		//echo $key;
		// echo $i;

		     if($key==$x+1 AND $i==$y AND $massiv[$i]==1){
		            $sql="UPDATE button SET x=x+1 WHERE user_id='$user_id'";
		 	        mysqli_query($con,$sql);

		}
	 
	}

 }
}


if(isset($_POST['right']) AND isset($_POST['x']) AND isset($_POST['y'])){

		$x=$_POST['x'];
		$y=$_POST['y'];

		foreach ($string as $key => $value) {

			   $r=rtrim($value);
			  $massiv = str_split($r); 
		
		for($i=0;$i<count($massiv);$i++){			
		//echo $key;
		// echo $i;

		     if($key==$x AND $i==$y+1 AND $massiv[$i]==1){
		     $sql="UPDATE button SET y=y+1 WHERE user_id='$user_id'";
	         	mysqli_query($con,$sql);

		}
	 
	}

 }
}


if(isset($_POST['left']) AND isset($_POST['x']) AND isset($_POST['y'])){

		$x=$_POST['x'];
		$y=$_POST['y'];

		foreach ($string as $key => $value) {

			   $r=rtrim($value);
			  $massiv = str_split($r); 
		
		for($i=0;$i<count($massiv);$i++){			
		//echo $key;
		// echo $i;

		     if($key==$x AND $i==$y-1 AND $massiv[$i]==1){
		         $sql="UPDATE button SET y=y-1 WHERE user_id='$user_id'";
	         	mysqli_query($con,$sql);

		}
	 
	}

 }
}






   	


	?>

<?php


if(isset($_POST['rotate_right']) AND isset($_POST['x']) AND isset($_POST['y'])){

		$x=$_POST['x'];
		$y=$_POST['y'];		
		//echo $key;
		// echo $i;

		           $sql="UPDATE button SET degree=degree+90 WHERE user_id='$user_id'";
	         	$roww=mysqli_query($con,$sql);
	
	           $sqll="SELECT * FROM button where user_id='$user_id'";
	         	$run_query=mysqli_query($con,$sqll);
	         	$row=mysqli_fetch_array($run_query);
	        	$degree=$row['degree'];

	       if($degree > 270){
             $sql="UPDATE button SET degree=0 WHERE user_id='$user_id'";
	         	$roww=mysqli_query($con,$sql);

	       }


		
 
}

 




if(isset($_POST['rotate_left']) AND isset($_POST['x']) AND isset($_POST['y'])){

		$x=$_POST['x'];
		$y=$_POST['y'];

           $sql="UPDATE button SET degree=degree-90 WHERE user_id=$user_id";
	         	$roww=mysqli_query($con,$sql);

	         	 $sqll="SELECT * FROM button where user_id='$user_id'";
	         	$run_query=mysqli_query($con,$sqll);
	         	$row=mysqli_fetch_array($run_query);
	        	$degree=$row['degree'];

	       if($degree < -270){
             $sql="UPDATE button SET degree=0 WHERE user_id='$user_id'";
	         	$roww=mysqli_query($con,$sql);

	       }



}






?>





<head>
	<?php
		$user = $_SESSION['user_email'];
		$get_user = "select * from users where user_email='$user'";
		$run_user = mysqli_query($con,$get_user);
		$row = mysqli_fetch_array($run_user);
		$user_id=$row['id'];
		$user_name = $row['user_name'];
	?>
	<title><?php echo "$user_name"; ?></title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>
<body>

<style>
	table, th, td {
  border: 1px solid black;
}
.big-icon {
    font-size: 42px;
    text-align: center;
    padding-top: 28px;
    padding-left: 48px;
      position:relative;

   
   }

.btnRotate {
	padding: 5px 10px;
	background-color: #09F;
	border: 0;color: #FFF;
	cursor: pointer;
}
.rotate_icon{

	transform:rotate(<?php echo $derece."deg"?>);

}





</style>


<div class="row">
	<div class="col-md-12 col-md-offset-5 " >



	<?php

// the function of defining x and y to variables via content 
	$select="SELECT * FROM button where user_id='$user_id'";

	$run = mysqli_query($con,$select);
	
	while($row=mysqli_fetch_array($run)){
	$run_id = $row['id']; 
	 $x = $row['x'];
 	 $y = $row['y'];

	};



	?>




	<table style="width:20%">

<?php
//the function of the content 
$string=file('file.txt');

//function foo(){


   // more code


foreach ($string as $key => $value) {
echo "<tr id=$key>";
	   $r=rtrim($value);
	  $massiv = str_split($r); 


	?>
	
				<?php
		
		for($i=0;$i<count($massiv);$i++){

		if($massiv[$i]==1){
			

			if($key==$x AND $i==$y ){
			echo "<td id=$i><div name='div2' style='background:#98bf21;height:70px;width:70px;display:inline-block'><i  class='fas fa-male big-icon rotate_icon'></i></div></td>";
			
		 	} else {


		 		echo "<td id=$i><div id='div1' style='background:#98bf21;height:70px;width:70px;display:inline-block'></div></td>";
		 	}


			}else if($massiv[$i]==2){
			echo "<td id=$i><div id='div2' style='background:red;height:70px;width:70px;display:inline-block'></div></td>";
				
		}

		?> 
	  <?php

	  }	
	  echo "</tr>"
	 ?>

		
 <?php
}
//}


?>       


       
  </table>


	

<div id="frm">
	<form method="post" action="combat.php">
	<input type="hidden" name='x' value="<?php echo $x ?>" >
		<input type="hidden" name='y' value="<?php echo $y ?>" >
		<input type="submit" name="rotate_left" class="btn btn-secondary" value="rotate left">
		<input type="submit" name="rotate_right" class="btn btn-secondary rotate_right" value="rotate right">
		<input type="submit" name="up" class="btn btn-secondary" value="up">
		<input type="submit" name="down" class="btn btn-secondary" value="down">
		<input type="submit" name="left" class="btn btn-secondary" value="left">
		<input type="submit" name="right" class="btn btn-secondary" value="right">
		<input type="submit" name="rotate" class="btnRotate" value="right">

</form>


<a  href="home.php" class="btn btn-success">geri</a>
</div>
</div>
	
</div>
</body>
</html>