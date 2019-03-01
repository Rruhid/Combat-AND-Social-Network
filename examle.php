<!DOCTYPE html>
<?php
ob_start();

session_start();
include("includes/header.php");
include("includes/connection.php");
if(!isset($_SESSION['user_email'])){
	header("location: index.php");

}

?>

<?php
//key == x==vertilkal

//$i==y==horizontal
	
	$select="SELECT * FROM button where user_id='$user_id'";

	$run = mysqli_query($con,$select);
	
	while($row=mysqli_fetch_array($run)){
	$run_id = $row['id']; 
	 $x = $row['x'];//x row in a table
 	$y = $row['y'];//y row in a table
 	$derece=$row['degree'];
 	echo $derece;

 }

?>

<?php


	$string=file('file.txt');


	if(isset($_POST['up']) AND isset($_POST['x']) AND isset($_POST['y'])){

		$x=intval($_POST['x']);
		$y=intval($_POST['y']);

	// echo $key;
	// echo $i;
 
	            if ($derece == 90 || $derece== -270) {

			        $y++;//right

			    } else if ($derece == 180 || $derece== -180) {

			        $x++;//down

			    } else if ($derece == 270 || $derece == -90) {

			        $y--;//left

			    } else if ($derece == 0) {

			        $x--;//up

			    }
			
	

		foreach ($string as $key => $value) {
			   $r=rtrim($value);
			  $massiv = str_split($r); 
		
		for($i=0;$i<count($massiv);$i++){

		// echo $key;
		// echo $i;
		     if($key==$x AND $i==$y  AND $massiv[$i]==1){
		            $sql="UPDATE button SET x=$x,y=$y WHERE user_id='$user_id'";
		 	        mysqli_query($con,$sql);

		}
	 
	}

 }
 //echo $i;


}


 
 ?>
	
<?php	


if(isset($_POST['down']) AND isset($_POST['x']) AND isset($_POST['y'])){
	      $x=intval($_POST['x']);
		$y=intval($_POST['y']);
	            if ($derece == 90 || $derece== -270) {

			        $y--;//right


			    } else if ($derece == 180 || $derece== -180) {

			        $x--;//down

			    } else if ($derece == 270 || $derece== -90) {

			        $y++;

			    } else if ($derece == 0) {

			        $x++;//up

			    }

		

		foreach ($string as $key => $value) {

			   $r=rtrim($value);
			  $massiv = str_split($r); 
		
		for($i=0;$i<count($massiv);$i++){			
		//echo $key;
		// echo $i;

		     if($key==$x AND $i==$y AND $massiv[$i]==1){
		            $sql="UPDATE button SET x=$x,y=$y WHERE user_id='$user_id'";
		 	        mysqli_query($con,$sql);

		}
	 
	}

 }
}

if(isset($_POST['right']) AND isset($_POST['x']) AND isset($_POST['y'])){
	$x=intval($_POST['x']);
		$y=intval($_POST['y']);

	            if ($derece == 90 || $derece== -270) {

			        $x++;

			    } else if ($derece == 180 || $derece== -180)  {

			        $y++;//down

			    } else if ($derece == 270 || $derece== -90)  {

			        $x--;//left

			    } else if ($derece == 0) {

			       $y++;

			    }


		foreach ($string as $key => $value) {

			   $r=rtrim($value);
			  $massiv = str_split($r); 
		
		for($i=0;$i<count($massiv);$i++){			
		//echo $key;
		// echo $i;

		     if($key==$x AND $i==$y AND $massiv[$i]==1){
		     $sql="UPDATE button SET x=$x,y=$y WHERE user_id='$user_id'";
	         	mysqli_query($con,$sql);

		}
	 
	}

 }
}


if(isset($_POST['left']) AND isset($_POST['x']) AND isset($_POST['y'])){

	
		$x=intval($_POST['x']);
		$y=intval($_POST['y']);
     
       if ($derece == 90 || $derece== -270) {

			        $x--;

			    } else if ($derece == 180 || $derece== -180)  {

			        $y--;//down

			    } else if ($derece == 270 || $derece== -90)  {

			        $x--;//left

			    } else if ($derece == 0) {

			       $y--;

			    }
 
	
		foreach ($string as $key => $value) {

			   $r=rtrim($value);
			  $massiv = str_split($r); 
		
		for($i=0;$i<count($massiv);$i++){			
		//echo $key;
		// echo $y;
			//echo $y; !(a >= b)
        // if($y-4<=$i && $i<=$y+4){

		     if($key==$x AND $i==$y AND $massiv[$i]==1){
		         $sql="UPDATE button SET x=$x,y=$y WHERE user_id='$user_id'";
	         	mysqli_query($con,$sql);

		}
	  
   //  }   

  }
 }
}

	?>

<?php


if(isset($_POST['rotate_right']) AND isset($_POST['x']) AND isset($_POST['y'])){

			$x=intval($_POST['x']);
		    $y=intval($_POST['y']);


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


		header("Refresh:0");
 
}

 




if(isset($_POST['rotate_left']) AND isset($_POST['x']) AND isset($_POST['y'])){

        $x=intval($_POST['x']);
		$y=intval($_POST['y']);

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
	      header("Refresh:0");



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
    font-size: 52px;
    text-align: center;
    padding-top: 18px;
    padding-left: 28px;
    padding-right: 28px;
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
.gift_icon{
    font-size: 52px;
    text-align: center;
    padding-top: 20px;
    padding-left: 8px;
    padding-right: 28px;
      position:relative;

}








</style>


<div class="row">

	<div class="col-md-4 col-md-offset-1 " >

	<?php
//ko
// the function of defining x and y to variables via content 
	$select="SELECT * FROM button where user_id='$user_id'";

	$run = mysqli_query($con,$select);
	
	while($row=mysqli_fetch_array($run)){
	$run_id = $row['id']; 
	 $x = $row['x'];
 	 $y = $row['y'];


	};



	?>

<?php

$slll="SELECT * FROM gift WHERE up='2'";
$runn=mysqli_query($con,$slll);
$count_rows=mysqli_num_rows($runn);
?>
<h2 style='color:green'>The number of gifts <?php echo $count_rows; ?></h2>




<?php

  $value_button_4='';
 

			

//the function of the content 
$string=file('file.txt');

foreach ($string as $key => $value) {

	   $r=rtrim($value);
	   //$l=rtrim($key);
	  $massiv = str_split($r);
	 //  $arr = str_split($l);
	?>

				<?php

		for($i=0;$i<count($massiv);$i++){


				if($x==0){

				        $c=4;
					} else if($x==1){
				      $c=3;
					}else{
						$c=2;
					}


						if($x==5){
				         $yan=4;
						} else if($x==4){
					      $yan=3;
						}else{
							$yan=2;
						}
							

							

							if($y==0){

					        $boyur=4;
						} else if($y==1){
					      $boyur=3;
						}else{
							$boyur=2;
						}




						if($y==7){
				         $sag_boyur=4;

						} else if($y==6){
					      $sag_boyur=3;

						}else{

							$sag_boyur=2;
						}



			    

			if($x-$yan<=$key && $x+$c>=$key && $y-$sag_boyur<=$i && $i<=$y+$boyur ){

					if($massiv[$i]==1){

							if($key==$x AND $i==$y){

							echo "<div name='div2' id='$i' style='height:70px;width:70px;display:inline-block'><span class='fas fa-male big-icon rotate_icon'></span></div>";
							
						 	} else {

						 		echo "<div id='div1' id='$i' style='background:#98bf21;height:70px;width:70px;display:inline-block'></div>";
						 	}


								}else if($massiv[$i]==4){

						$sql2="SELECT * FROM wolf WHERE  x=$key AND y=$i AND user_id='$user_id'";
							$run=mysqli_query($con,$sql2); 
                         	$row2=mysqli_fetch_array($run);
                         		$wolf=$row2['wolf'];

                         		

							//if($present==1 || $present==0){

									
					       echo "<div class='div2' id='$i' style='height:70px;width:70px;display:inline-block'><span class='fab fa-wolf-pack-battalion gift_icon'></span></div>";

								// 	}else if($present==2 || $present==0)
								// 	{
								//  echo "<div class='div3' id='$i' style='height:70px;width:70px;display:inline-block'><span class='fa fa-folder-open gift_icon' aria-hidden='true'></span></div>";
								// 	}





									$sql_1="SELECT wolf FROM wolf where user_id='$user_id'";

									$run_1=mysqli_query($con,$sql_1);


										$count=mysqli_num_rows($run_1);


		                               if($count <1){
		                               	   $wolf="INSERT INTO wolf (user_id,x,y,present,wolf,can,zombi_can) VALUES ($user_id,$key,$i,0,1,100,100)";

		 	                              $a= mysqli_query($con,$wolf);

		                               }
		 	                         

                       if($x==1 AND $y==0 AND $derece==0 OR $x==0 AND $y==1 AND $derece== -90 OR   $x==0 AND $y==1 AND  $derece==270){

							$update_gift="UPDATE wolf SET present=1 WHERE user_id='$user_id' AND x=$x-1 AND y=$y OR x=$x AND y=$y-1";
							$run_update=mysqli_query($con,$update_gift);
							
						}



									  
							
							}else if($massiv[$i]==3){

								$sql2="SELECT * FROM gift WHERE  x=$key AND y=$i AND user_id='$user_id'";
									$run=mysqli_query($con,$sql2); 
                                 	$row2=mysqli_fetch_array($run);
                                 		$present=$row2['up'];

									if($present==1 || $present==0){

										
					           echo "<div class='div2' id='$i' style='height:70px;width:70px;display:inline-block'><span class='fas fa-gift gift_icon'></span></div>";

									}else if($present==2 || $present==0){
								 echo "<div class='div3' id='$i' style='height:70px;width:70px;display:inline-block'><span class='fa fa-folder-open gift_icon' aria-hidden='true'></span></div>";
									}





									$sql_1="SELECT present FROM gift where user_id='$user_id'";

									$run_1=mysqli_query($con,$sql_1);

										$count=mysqli_num_rows($run_1);


		                               if($count <=2){
		                               	   $sqll="INSERT INTO gift  (user_id,x,y,present,up) VALUES ($user_id,$key,$i,0,1)";

		 	                               mysqli_query($con,$sqll);

		                               }




		                               if($x==1 AND $y==4 AND $derece==0 OR $x==0 AND $y==5 AND $derece== -90 OR   $x==0 AND $y==5 AND  $derece==270 OR $x==0 AND $y==3 AND $derece== 90 OR $x==0 AND $y==3 AND $derece== -270 ){

											$update_gift="UPDATE gift SET present=1 WHERE user_id='$user_id' AND x=$x-1 AND y=$y OR x=$x AND y=$y-1 OR x=$x AND y=$y+1";
											$run_update=mysqli_query($con,$update_gift);
											
										}else if ($x==3 AND $y==4 AND $derece==270 OR $x==3 AND $y==4 AND $derece== -90 OR $x==4 AND $y==3 AND $derece==0){
											
											$update_gift="UPDATE gift SET present=1 WHERE user_id='$user_id' AND y=$y-1 AND x=$x OR y=$y AND x=$x-1";
											$run_update=mysqli_query($con,$update_gift);
											
										}else if ($x==3 AND $y==5 AND $derece==90 OR $x==3 AND $y==5 AND $derece== -270 OR $x==2 AND $y==6 AND $derece==180 OR  $x==2 AND $y==6 AND 
											$derece==-180 OR $x==3 AND $y==7 AND $derece== -90 OR $x==3 AND $y==7 AND $derece==270){
											
											$update_gift="UPDATE gift SET present=1 WHERE user_id='$user_id' AND x=$x AND y=$y+1 OR y=$y AND x=$x+1 OR x=$x AND
											y=$y-1";
											$run_update=mysqli_query($con,$update_gift);
											
										}


									  
							
							}else if($massiv[$i]==2){

								echo "<div style='background:red;height:70px;width:70px;display:inline-block'></div>";
									
							}

		}
	
//	}

		?> 
	  <?php


	  
   
	  }	
	 
	 ?>

		
 <?php
 echo "<br>";

}
//}


?>    



<!-- gift function  -->




<?php

echo "x".$x;
echo "<br>";
echo "y".$y;

?>



<form method="post">





<?php
//function for gift 
$value_button="";
	$sql2="SELECT * FROM gift WHERE up=1 AND x=$x-1 AND y=$y AND $derece=0 OR x=$x AND y=$y-1 AND $derece=-90 OR  x=$x AND y=$y-1 AND $derece= 270 OR x=$x AND y=$y+1 AND $derece=90 OR  x=$x AND y=$y+1 AND $derece=-270 OR x=$x+1 AND y=$y AND $derece =180 AND user_id='$user_id'";
	$run=mysqli_query($con,$sql2); 
while($row2=mysqli_fetch_array($run)){

		$value_button=$row2['up'];

}

	    if($value_button==1){
?>
		

        <input type='submit' name='sub' class='btn btn-danger btn-lg' style='display:block;margin-left:400px; border-radius:15px;' value='Gift'>



        <?php
	}else{

		echo "<input type='submit' name='gif' class='btn btn-danger' style='display:none'; value='Gift'>";
	}

	
	
	?>
	  
</form>

	<form method="post">





<?php
//function for wolf
$wolf_button="";
	$sql3="SELECT * FROM wolf WHERE wolf=1 AND x=$x-1 AND y=$y AND $derece=0 OR x=$x AND y=$y-1 AND $derece=-90 OR  x=$x AND y=$y-1 AND $derece= 270 AND user_id='$user_id'";
	$run=mysqli_query($con,$sql3); 
while($row2=mysqli_fetch_array($run)){

		$wolf_button=$row2['wolf'];

}

	    if($wolf_button==1){
?>
		

        <input type='submit' name='wolf' class='btn btn-primary btn-lg' style='display:block;margin-left:400px; border-radius:15px;' value='Fight'>



        <?php
	}else{

		echo "<input type='submit' name='gif' class='btn btn-danger' style='display:none'; value='Gift'>";
	}

	
	
	?>
	  
</form>









	<?php

if (isset($_POST['sub'])) {
//do something if the value is not empty

$sql="UPDATE gift SET up=2 WHERE  x=$x-1 AND y=$y AND $derece=0 OR x=$x AND y=$y-1 AND $derece=-90 OR  x=$x AND y=$y-1 AND $derece= 270 OR x=$x AND y=$y+1 AND $derece=90 OR  x=$x AND y=$y+1 AND $derece=-270 OR x=$x+1 AND y=$y AND $derece =180 AND user_id='$user_id'"; 
$run_query=mysqli_query($con,$sql);





$page = $_SERVER['PHP_SELF'];
echo '<meta http-equiv="Refresh" content="0;' . $page . '">';

}
?>




	<?php

if (isset($_POST['wolf'])) {
//do something if the value is not empty

header("Location:fight.php");
$sql="UPDATE wolf SET can=100,zombi_can=100 WHERE  user_id='$user_id'"; 
$run_query=mysqli_query($con,$sql);

// $sql2="INSERT into actions (id,user_id,action) VALUES(null,'$user_id','OYUN STATISTIKASI')";
// $run2=mysqli_query($con,$sql2);





}
?>







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

</form>
<style>
/*	.full-width {
    position: relative;
   
}*/
img.imgone {
    position:absolute;
    z-index:3;
    top:120px;
    right:180px;
}

.imgone_boyur{
	  position:absolute;
    z-index:3;
    top:120px;
    right:80px;
}


img.imgtwo{

	top:80px;
	 position:absolute; 
	 z-index:2;
}

img.imgone_2 {
    position:absolute;
    z-index:3;
    top:80px;
    right:200px;
}



img.imgtwo_2{

	top:80px;
	 position:absolute; 
	 z-index:2;
}

img.imgone_3 {
    position:absolute;
    z-index:3;
    top:50px;
    right:350px;
}



img.imgtwo_3{

	top:50px;
	 position:absolute; 
	 z-index:2;
}




img.imgone_4 {
    position:absolute;
    z-index:3;
    top:50px;
    right:350px;
}



img.imgtwo_4{

	top:10px;
	 position:absolute; 
	 z-index:2;
	 left:365px;
	 height: 300px;
	 width:100px;
}



img.imgtwoo{

	left:15px;
	top:80px;
	 position:absolute; 
	 z-index:2;
}

img.img_wall{
	top:50px;
	position:absolute;
	width:450px;
	height:170px;
	z-index:3;
}
img.img_wall2{
	top:40px;
	position:absolute;
	width:450px;
	height:130px;
	z-index:3;
}
img.img_wall3{
	top:40px;
	position:absolute;
	width:450px;
	height:80px;
	z-index:3;
}


img.img_wall_sand{
	top:170px;
	position:absolute;
	width:100px;
	height:60px;
	z-index:3;
	left: 200px;
}
img.img_sandright{
top:170px;
	position:absolute;
	width:100px;
	height:60px;
	z-index:3;
	left: 280px;

}
img.img_wall_sand_4{
	top:10px;
	position:absolute;
	width:100px;
	height:300px;
	z-index:3;
	left: 370px;
}

img.img_sand2{
	top:170px;
	position:absolute;
	width:100px;
	height:60px;
	z-index:2;
	left: 350px;
}
img.img_sand3{
	top:170px;
	position:absolute;
	width:150px;
	height:80px;
	z-index:2;
	left: 150px;
}
img.img_sand_small{
	top:170px;
	position:absolute;
	width:80px;
	height:40px;
	z-index:2;
	left: 150px;
}
img.img_sand_small_left{
	top:170px;
	position:absolute;
	width:80px;
	height:40px;
	z-index:2;
	left: 70px;
}
img.img_sand5{
	top:190px;
	position:absolute;
	width:100px;
	height:80px;
	z-index:2;
	left: 10px;
}
img.img_sand4{
	top:170px;
	position:absolute;
	width:150px;
	height:80px;
	z-index:2;
	left: 50px;
}
img.img_sand6{
	top:170px;
	position:absolute;
	width:150px;
	height:80px;
	z-index:2;
	left: 10px;
}


img.img_wall_sand_2{
top:10px;
	position:absolute;
	width:100px;
	height:300px;
	z-index:3;
	left: 15px;
}




</style>

<a  href="home.php" class="btn btn-success">geri</a>
</div>
</div>

<div class="col-md-4 col-md-offset-1">
<div class='full-width'>
 <img style='width:450px; height:320px;' style='position:absolute; z-index:3'; src='sprites/_/bg.gif'>
 <img style='width:450px;  height:80px; ' class='imgtwoo' src='sprites/1_front_wall.gif'>
</div>


<!--Bunu funksiya olaraq map ucun tekrar verirem-->
<?php
	$sql="SELECT up FROM gift WHERE  x=$x-1 AND y=$y AND $derece=0 OR x=$x AND y=$y-1 AND $derece=-90 OR  x=$x AND y=$y-1 AND $derece= 270 OR x=$x AND y=$y+1 AND $derece=90 OR  x=$x AND y=$y+1 AND $derece=-270 OR x=$x+1 AND y=$y AND $derece =180  OR x=$x  AND y=$y-2 AND $derece=270 OR x=$x  AND y=$y-2 AND $derece=-90 OR x=$x AND y=$y+2 AND $derece=90 OR x=$x AND y=$y+2 AND $derece=-270  OR x=$x-1 AND y=$y+1 AND $derece=0  OR x=$x-1 AND y=$y-1 AND $derece=0 OR y=$y AND x=$x-2  AND $derece=0 OR x=$x+1 AND y=$y-1 AND $derece=180 OR x=$x+1 AND y=$y-1 AND $derece=180  OR x=$x+1 AND y=$y+1 AND $derece=180 OR x=$x+1 AND y=$y+1 AND $derece=-180 OR x=$x-1 AND y=$y-1 AND $derece=270 OR x=$x-1 AND y=$y-1 AND $derece=-90 OR x=$x-1 AND y=$y-1 AND $derece=0  OR x=$x+1 AND y=$y-1 AND $derece=0 OR x=$x-1 AND y=$y+1 AND $derece=90 OR x=$x-1 AND y=$y+1 AND $derece=-270 AND user_id='$user_id'";
	$run=mysqli_query($con,$sql);
$que=mysqli_fetch_array($run);
$run=$que['up'];

if($x==0 AND $y==1 AND $derece==0 OR $x==0 AND $y==1 AND $derece==-180  OR $x==0 AND $y==1 AND $derece==180 ){//yuxari
              //echo "<img style='width:450px; height:320px;'src='sprites/_/bg.gif'>";

	}elseif ($x==0 AND $y==1 AND $derece== -90 OR $x==0 AND $y==1 AND $derece== 270 OR $x==1 AND $y==0 AND $derece==0) { //solu

			echo "<div class='full-width'>";
			echo "<img style='width:150px;  height:150px;' class='imgone' src='sprites/1012.gif'>";//canavar
        	echo "<img style='width:450px;  height:80px;' class='imgtwo' src='sprites/1_front_wall.gif'>";//divar
        	echo "</div>";

	 }elseif ($x==1 AND $y==1 AND $derece== 0) { //solu

			echo "<div class='full-width'>";
			echo "<img style='width:150px;  height:150px;' class='imgone_4' src='sprites/1012.gif'>";//canavar
        	echo "<img class='imgtwo_4' src='sprites/_/2_right_wall.gif'>";//divar

        	echo "</div>";

	 }elseif ($x==2 AND $y==0 AND $derece== 0) { //solu

			echo "<div class='full-width'>";
			echo "<img style='width:100px;  height:100px;' class='imgone_2' src='sprites/1012.gif'>";//canavar
        	echo "<img style='width:350px;  height:40px;' class='imgtwo_2' src='sprites/1_front_wall.gif'>";//divar
        	echo "</div>";

	 }elseif ($x==3 AND $y==0 AND $derece== 0) { //solu

			echo "<div class='full-width'>";
			echo "<img style='width:50px;  height:70px;' class='imgone_2' src='sprites/1012.gif'>";//canavar
	echo "<img style='float:right;' class='img_wall_sand_4'  src='sprites/_/2_right_wall.gif'>";//divar

        	echo "<img style='width:200px;  height:30px;' class='imgtwo_2' src='sprites/1_front_wall.gif'>";//divar
        	echo "</div>";

	 }elseif ($x==0 AND $y==1 AND $derece== 90 OR $x==0 AND $y==1 AND $derece== -270 OR $x==1 AND $y==1 AND $derece==180 OR $x==1 AND $y==1 AND $derece==-180 OR $x==1 AND $y==2 AND $derece==0 OR $x==1 AND $y==2 AND $derece==180 OR $x==0 AND $y==3 AND $derece==-90 OR $x==0 AND $y==3 AND $derece==270 OR $x==1 AND $y==3 AND $derece==-180 OR $x==1 AND $y==3 AND $derece==180 OR $x==1 AND $y==5 AND $derece==90 OR $x==1 AND $y==5 AND $derece==-270 OR $x==0 AND $y==5 AND $derece==90 OR $x==0 AND $y==5 AND $derece==-270 OR $x==2 AND $y==4 AND $derece==-90 OR $x==2 AND $y==4 AND $derece==270 OR $x==2 AND $y==6 AND $derece==0 OR $x==1 AND $y==7 AND $derece==-90 OR $x==1 AND $y==7 AND $derece==270 OR $x==0 AND $y==7 AND $derece==-90 OR $x==0 AND $y==7 AND $derece==270 OR $x==4 AND $y==7 AND $derece==270 OR $x==4 AND $y==7 AND $derece==-90 OR $x==5 AND $y==4 AND $derece==270 OR $x==5 AND $y==4 AND $derece==-90 OR $x==4 AND $y==3 AND $derece==-180 OR $x==4 AND $y==3 AND $derece==180 OR $x==4 AND $y==2 AND $derece==0 OR $x==4 AND $y==2 AND $derece==180 OR $x==4 AND $y==2 AND $derece==-180 OR $x==5 AND $y==1 AND $derece==90 OR $x==5 AND $y==1 AND $derece==-270 OR $x==4 AND $y==5 AND $derece==90 OR $x==4 AND $y==5 AND $derece==-270  OR $x==5 AND $y==6 AND $derece==0 OR $x==2 AND $y==0 AND $derece==90 OR $x==2 AND $y==0 AND $derece==-270 OR $x==3 AND $y==1 AND $derece==90 OR $x==3 AND $y==1 AND $derece==-270 OR $x==3 AND $y==1 AND $derece==0 ) {

			echo "<img class='img_wall' src='sprites/_/2_front_wall.gif'";//divar
        

	 }elseif ($x==1 AND $y==4 AND $derece==90 OR $x==1 AND $y==4 AND $derece== -270) { //solu

		  echo "<img class='img_wall2' src='sprites/_/2_front_wall.gif'";//divar
        

	 // }elseif ($x==1 AND $y==3 AND $derece==90 OR $x==1 AND $y==3 AND $derece== -270) { //solu

		//   echo "<img class='img_wall3' src='sprites/_/2_front_wall.gif'";//divar
        

	 // }
	 }elseif ($x==2 AND $y==7 AND $derece==0 OR $x==1 AND $y==7 AND $derece== 0) { //solu

        		echo "<img class='img_wall_sand_2' src='sprites/_/2_left_wall.gif'>";//divar
        

	 }if ($x==3 AND $y==7 AND $derece==180 OR $x==3 AND $y==7 AND $derece== -180) { //solu

		  echo "<img class='img_wall_sand_2' src='sprites/_/2_left_wall.gif'";//divar
        

	 }if ($x==5 AND $y==7 AND $derece==0 OR $x==5 AND $y==7 AND $derece== 0) { //solu

		  echo "<img class='img_wall_sand_2' src='sprites/_/2_left_wall.gif'";//divar
        

	 }if ($x==1 AND $y==0 AND $derece==90 OR $x==1 AND $y==0 AND $derece== -270) { //solu

	echo "<img style='float:right;' class='img_wall_sand_4'  src='sprites/_/2_right_wall.gif'>";//divar
        

	 }if ($x==1 AND $y==1 AND $derece==90 OR $x==1 AND $y==1 AND $derece== -270) { //solu

echo "<div class='full-width'>";
				echo "<img style='float:right;' class='img_wall_sand_4'  src='sprites/_/2_right_wall.gif'>";//divar

        		echo "<img class='img_wall_sand_2' src='sprites/_/2_left_wall.gif'>";//divar

        	echo "</div>";        

	 }if ($x==1 AND $y==2 AND $derece==90 OR $x==1 AND $y==2 AND $derece== -270) { //solu

	echo "<img style='float:right;' class='img_wall_sand_4'  src='sprites/_/2_right_wall.gif'>";//divar
        

	 }elseif ($x==1 AND $y==4 AND $derece== -90  OR $x==1 AND $y==4 AND $derece==270) { //solu

		  echo "<img class='img_wall_sand_2' src='sprites/_/2_left_wall.gif'";//divar

			
        
	 }


	 if ($x==1 AND $y==3 AND $derece== -90  OR $x==1 AND $y==3 AND $derece==270) { //solu

		  echo "<div class='full-width'>";
				echo "<img style='float:right;' class='img_wall_sand_4'  src='sprites/_/2_right_wall.gif'>";//divar

        		echo "<img class='img_wall_sand_2' src='sprites/_/2_left_wall.gif'>";//divar

        	echo "</div>";   
        
	 }








	 if ($x==1 AND $y==2 AND $derece== -90  OR $x==1 AND $y==2 AND $derece==270) { //solu

		  echo "<img class='img_wall_sand_2' src='sprites/_/2_left_wall.gif'";//divar

			
        
	 }elseif ($x==4 AND $y==1 AND $derece== -270  OR $x==4 AND $y==1 AND $derece==90) { //solu
           echo "<div class='full-width'>";
				echo "<img style='float:right;' class='img_wall_sand_4'  src='sprites/_/2_right_wall.gif'>";//divar

        		echo "<img class='img_wall_sand_2' src='sprites/_/2_left_wall.gif'>";//divar

        	echo "</div>";  
        
	 }elseif ($x==4 AND $y==2 AND $derece== -270  OR $x==4 AND $y==2 AND $derece==90) { //solu

					echo "<div class='full-width'>";
			echo "<img class='img_sand5' src='sprites/san.gif'>";//divar
        	echo "<img class='imgtwo_4' src='sprites/_/2_right_wall.gif'>";//divar

        	echo "</div>";
        
	 }elseif ($x==1 AND $y==1 AND $derece== -90  OR $x==1 AND $y==1 AND $derece==270) { //solu
			echo "<img style='width:150px;  height:150px;' class='imgone_boyur' src='sprites/1012.gif'>";//canavar

        
	 }


















//ortadaki divar ozaqdan
	 if ($x==0 AND $y==1 AND $derece==180 OR $x==0 AND $y==1 AND $derece== -180 OR $x==0 AND $y==3 AND $derece==180 OR $x==0 AND $y==3 AND $derece== -180 ) { //solu

		  echo "<img class='img_wall2' src='sprites/_/2_front_wall.gif'";//divar
        

	 }if ($x==2 AND $y==5 AND $derece==270 OR $x==2 AND $y==5 AND $derece== -90) { //solu

		  echo "<img class='img_wall2' src='sprites/_/2_front_wall.gif'";//divar
        

	 }if ($x==2 AND $y==6 AND $derece==270 OR $x==2 AND $y==6 AND $derece== -90) { //solu

		  echo "<img class='img_wall3' src='sprites/_/2_front_wall.gif'";//divar
        

	 }if ($x==1 AND $y==4 AND $derece==180 OR $x==1 AND $y==4 AND $derece== -180) { //solu

		  echo "<img class='img_wall_sand_2' src='sprites/_/2_left_wall.gif'>";//divar
        

	 }elseif ($x==4 AND $y==3 AND $derece==-90 OR $x==4 AND $y==3 AND $derece== 270) { //solu

				echo "<div class='full-width'>";
				echo "<img style='float:right;' class='img_wall_sand_4'  src='sprites/_/2_right_wall.gif'>";//divar

        		echo "<img class='img_wall_sand_2' src='sprites/_/2_left_wall.gif'>";//divar

        	echo "</div>";
	 }if ($x==1 AND $y==4 AND $derece==180 OR $x==1 AND $y==4 AND $derece== -180) { //solu

		  echo "<img class='img_wall_sand_2' src='sprites/_/2_left_wall.gif'>";//divar
        

	} if ($x==4 AND $y==4 AND $derece==-270 OR $x==4 AND $y==4 AND $derece== 90) { //solu

		  echo "<img class='img_wall2' src='sprites/_/2_front_wall.gif'>";//divar


	}

	if($x==4 AND $y==4 AND $derece==180 OR $x==4 AND $y==4 AND $derece==-180 ) { //solu

        		echo "<img class='img_wall_sand_2' src='sprites/_/2_left_wall.gif'>";//divar



        
	} 




      if ($x==3 AND $y==5 AND $derece==180 OR $x==3 AND $y==5 AND $derece== -180) { //solu

				echo "<img style='float:right;' class='img_wall_sand_4'  src='sprites/_/2_right_wall.gif'>";//divar


	}  if ($x==5 AND $y==5 AND $derece==0) { //solu

				echo "<img style='float:right;' class='img_wall_sand_4'  src='sprites/_/2_right_wall.gif'>";//divar


	} 



	if ($x==5 AND $y==5 AND $derece==-90 OR $x==5 AND $y==5 AND $derece==270) { //solu

		  echo "<img class='img_wall2' src='sprites/_/2_front_wall.gif'>";//divar


	} if ($x==4 AND $y==1 AND $derece==0) { //solu
		      echo "<img class='img_wall2' src='sprites/_/2_front_wall.gif'>";//divar

				echo "<img style='float:right;' class='img_wall_sand_4'  src='sprites/_/2_right_wall.gif'>";//divar


	}

	if ($run==2 AND $x==1 AND $y==3 AND $derece==90  OR $run==2 AND  $x==1 AND $y==3 AND $derece== -270) { //solu
			echo "<img class='img_sand_small_left' src='sprites/chest.gif'>";//divar

        
	}elseif($run==1 AND $x==1 AND $y==3 AND $derece==90  OR $run==1 AND  $x==1 AND $y==3 AND $derece== -270){
		  echo "<img class='img_sand_small_left' src='sprites/san.gif'";//divar

	}





	





	if ($x==2 AND $y==5 AND $derece==0) { //solu

				echo "<img style='float:right;' class='img_wall_sand_4'  src='sprites/_/2_right_wall.gif'>";//divar
        
	} 

	

					










	












//hediyye meselesi
	 if ($x==0 AND $y==3 AND $derece==90 OR $x==0 AND $y==3 AND $derece== -270) { //solu

		  echo "<img class='img_sand3' src='sprites/san.gif'";//divar

        

	 }elseif ($x==0 AND $y==5 AND $derece==-90  OR $x==0 AND $y==5 AND $derece==270) { //solu

		echo "<img class='img_sand3' src='sprites/san.gif'";//divar

        


	 }


	if ($run==2 AND $x==1 AND $y==3 AND $derece==0) { //solu

				echo "<div class='full-width'>";
			  echo "<img class='img_sand2' src='sprites/chest.gif'>";//divar
        		echo "<img class='img_wall_sand_2' src='sprites/_/2_left_wall.gif'>";//divar

        	echo "</div>";

	 }elseif($run==1 AND $x==1 AND $y==3 AND $derece==0){
	 		echo "<div class='full-width'>";
	 		        		echo "<img class='img_wall_sand_2' src='sprites/_/2_left_wall.gif'>";//divar

              echo "<img class='img_sand2' src='sprites/san.gif'";//divar

        	echo "</div>";
	 		
	 }








	 if ($x==2 AND $y==5 AND $derece==90 OR $x==2 AND $y==5 AND $derece== -270) { //solu

				echo "<div class='full-width'>";
		   		echo "<img class='img_sand2' src='sprites/san.gif'>";//divar
        		echo "<img class='img_wall_sand_2' src='sprites/_/2_left_wall.gif'>";//divar

        	echo "</div>";

	 }
	 if ($run==2 AND $x==2 AND $y==6 AND $derece==180 OR $run==2 AND $x==2 AND $y==6 AND $derece== -180) { //solu
			echo "<img class='img_sand3' src='sprites/chest.gif'>";//divar



	 }elseif($run==1 AND $x==2 AND $y==6 AND $derece==180 OR $run==1 AND $x==2 AND $y==6 AND $derece== -180){
	 							echo "<img class='img_sand3' src='sprites/san.gif'";//divar

	 }



    if ($run==2 AND $x==3 AND $y==7 AND $derece==270 OR $run==2 AND $x==3 AND $y==7 AND $derece== -90) { //solu
			echo "<img class='img_sand3' src='sprites/chest.gif'>";//divar



	 }elseif($run==1 AND $x==3 AND $y==7 AND $derece==270 OR $run==1 AND $x==3 AND $y==7 AND $derece== -90){
	 							echo "<img class='img_sand3' src='sprites/san.gif'";//divar

	 }


	








	 // if ($x==2 AND $y==7 AND $derece==180 OR $x==2 AND $y==7 AND $derece== -180) { //solu

		// 	echo "<img class='img_sand_small_left' src='sprites/chest.gif'>";//divar


	 // }elseif($run==1 AND $x==2 AND $y==7 AND $derece==180 OR $run==1 AND  $x==2 AND $y==7 AND $derece== -180 ){
	 // 							echo "<img class='img_sand4' src='sprites/san.gif'";//divar

	 // }







	if ($run==2 AND $x==3 AND $y==4 AND $derece==270 OR $run==2 AND  $x==3 AND $y==4 AND $derece== -90) { //solu

			echo "<img class='img_sand3' src='sprites/chest.gif'>";//divar


	 }elseif($run==1 AND $x==3 AND $y==4 AND $derece==270 OR $run==1 AND  $x==3 AND $y==4 AND $derece== -90){
	 			echo "<img class='img_sand3' src='sprites/san.gif'";//divar

	 }



	 // if ($x==4 AND $y==4 AND $derece==0) { //solu

		// 				echo "<img class='img_sand5' src='sprites/san.gif'";//divar


	 // }

 if ($run==2 AND  $x==4 AND $y==4 AND $derece==0) { //solu

			echo "<img class='img_sand_small_left' src='sprites/chest.gif'>";//divar


	 }elseif($run==1 AND  $x==4 AND $y==4 AND $derece==0){

	 	echo "<img class='img_sand5' src='sprites/san.gif'";//divar

	 }








	 // if ($x==4 AND $y==5 AND $derece==0) { //solu

		// 				echo "<img class='img_sandright' src='sprites/san.gif'";//divar


	 // }



 if ($run==1 AND  $x==4 AND $y==5 AND $derece==0) { //solu

			echo "<img class='img_sandright' src='sprites/chest.gif'>";//divar


	 }elseif($run==2 AND  $x==4 AND $y==5 AND $derece==0){

						echo "<img class='img_sandright' src='sprites/san.gif'";//divar

	 }






	 elseif ($x==4 AND $y==7 AND $derece==0) { //solu

						echo "<img class='img_sand4' src='sprites/san.gif'";//divar


	 }elseif ($x==2 AND $y==7 AND $derece==-90 OR $x==2 AND $y==7 AND $derece== 270) { //solu

					echo "<div class='full-width'>";
			echo "<img class='img_sand5' src='sprites/san.gif'>";//divar
        	echo "<img class='imgtwo_4' src='sprites/_/2_right_wall.gif'>";//divar

        	echo "</div>";
	 }elseif ($x==4 AND $y==4 AND $derece==-90 OR $x==4 AND $y==4 AND $derece== 270) { //solu

				echo "<div class='full-width'>";
		   		echo "<img class='img_sand2' src='sprites/san.gif'>";//divar
        		echo "<img class='img_wall_sand_2' src='sprites/_/2_left_wall.gif'>";//divar

        	echo "</div>";
	 }






if ($run==1 AND $x==2 AND $y==4 AND $derece==180  OR $run==1 AND $x==0 AND $y==4 AND $derece==-180) { //solu

		echo "<img class='img_sand6' src='sprites/san.gif'";

        
	 }elseif($run==2 AND $x==2 AND $y==4 AND $derece==180  OR $run==2 AND $x==0 AND $y==4 AND $derece==-180){

			echo "<img class='img_sand_small_left'  src='sprites/chest.gif'>";//divar

	 }




		if ($run==2  AND $x==1 AND $y==5 AND $derece==-90  OR $run==2  and $x==1 AND $y==5 AND $derece==270) {//sandig ucun funksiya
					echo "<img class='img_sandright' src='sprites/chest.gif'>";//divar


			}elseif($run==1  AND $x==1 AND $y==5 AND $derece==-90  OR $run==1 AND  $x==1 AND $y==5 AND $derece==270){
				echo "<img class='img_sand3' src='sprites/san.gif'>";//divar

			}








if ($run==2 AND $x==1 AND $y==4 AND $derece==0) {//sandig ucun funksiya
			echo "<img class='img_sand3' src='sprites/chest.gif'>";//divar


	}elseif($run==1 AND $x==1 AND $y==4 AND $derece==0){
		echo "<img class='img_sand3' src='sprites/san.gif'>";//divar

	}


	



	if($run==2 AND $x==2 AND $y==4 AND $derece==0) {//sandig ucun funksiya
			//echo "<img class='img_sand3' style='width:70px; height:40px; right:10px;' src='sprites/chest.gif'>";//divar


	}elseif($run==1 AND $x==2 AND $y==4 AND $derece==0){
			echo "<img  style='' class='img_sand_small' src='sprites/san.gif'>";//divar

	}

	// if ($x==3 AND $y==5 AND $derece==-90 OR $x==3 AND $y==5 AND $derece== 270) { //solu

	// 		echo "<img class='img_sand_small' src='sprites/san.gif'>";//divar


	// }

		if ($run==2 and $x==3 AND $y==4 AND $derece==-270 OR $run==2 AND $x==3 AND $y==4 AND $derece==90) { //solu

			echo "<img class='img_sand3' style='width:70px; height:40px; right:10px;' src='sprites/chest.gif'>";//divar

		}elseif($run==1 AND $x==3 AND $y==4 AND $derece==-270 OR $run==1 AND $x==3 AND $y==4 AND $derece==90){
			        echo "<img class='img_sand_small' src='sprites/san.gif'>";//divar

		}



	if ($run==2 and $x==3 AND $y==5 AND $derece==-90 OR $run==2 AND $x==3 AND $y==5 AND $derece==270) { //solu

			echo "<img class='img_sand3' style='width:70px; height:40px; right:10px;' src='sprites/chest.gif'>";//divar

}elseif($run==1 AND $x==3 AND $y==5 AND $derece==-90 OR $run==1 AND $x==3 AND $y==5 AND $derece==270){
	        echo "<img class='img_sand_small' src='sprites/san.gif'>";//divar

}

	if ($run==2 and $x==3 AND $y==5 AND $derece==90 OR $run==2 AND $x==3 AND $y==5 AND $derece==-270) { //solu

			echo "<img class='img_sand3' src='sprites/chest.gif'>";//divar

}elseif($run==1 AND $x==3 AND $y==5 AND $derece==90 OR $run==1 AND $x==3 AND $y==5 AND $derece==-270){
       echo "<img class='img_sand3' src='sprites/san.gif'";//divar

}






	if ($run==2 AND $x==2 AND $y==5 AND $derece==180 OR $run==2 AND  $x==2 AND $y==5 AND $derece== -180 ) { //solu

			echo "<img class='img_sandright' src='sprites/chest.gif'>";//divar

		}elseif($run==1 AND $x==2 AND $y==5 AND $derece==180 OR $run==1 AND  $x==2 AND $y==5 AND $derece== -180){
		       echo "<img class='img_sandright' src='sprites/san.gif'>";//divar

		}










if ($x==5 AND $y==5 AND $derece==90 OR $x==5 AND $y==5 AND $derece== -270) { //solu

        		echo "<img class='img_wall_sand_2' src='sprites/_/2_left_wall.gif'>";//divar


	} if ($x==5 AND $y==7 AND $derece==-90 OR $x==5 AND $y==7 AND $derece== 270) { //solu

				echo "<img style='float:right;' class='img_wall_sand_4'  src='sprites/_/2_right_wall.gif'>";//divar


	}  if ($x==3 AND $y==4 AND $derece==0) { //solu

		  echo "<img class='img_wall_sand_2' src='sprites/_/2_left_wall.gif'";//divar


	} 

		if ($run==2 AND $x==4 AND $y==3 AND $derece==0) { //solu

			echo "<img class='img_sand3' src='sprites/chest.gif'>";//divar

		}elseif($run==1 AND $x==4 AND $y==3 AND $derece==0){
		       echo "<img class='img_sand3' src='sprites/san.gif'";//divar

		}


	if ($run==1 AND $x==1 AND $y==5 AND $derece==0) { //solu
//bu sehvdi
				echo "<div class='full-width'>";
		   		echo "<img class='img_sand4' src='sprites/san.gif'>";//divar
				echo "<img style='float:right;' class='img_wall_sand_4'  src='sprites/_/2_right_wall.gif'>";//divar

        	echo "</div>";

	 }

	 if($run==2 AND $x==1 AND $y==5 AND $derece==0){
	 		echo "<div class='full-width'>";
		   		echo "<img class='img_sand4' src='sprites/chest.gif'>";//divar
				echo "<img style='float:right;' class='img_wall_sand_4'  src='sprites/_/2_right_wall.gif'>";//divar

        	echo "</div>";
	 }
		
		
		
		
		
							

?> 






</div>


</div>


</body>
</html>