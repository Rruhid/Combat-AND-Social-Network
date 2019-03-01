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
$sel="SELECT * FROM wolf WHERE user_id='$user_id' ";
$run=mysqli_query($con,$sel);
$row=mysqli_fetch_array($run);
$can=$row['can'];
$wolf_can=$row['zombi_can'];
?>
<div class="container">
    <div class="row">
        <div class="col-xs-1">

        	<img style="width:350px; height:320px; border-radius:50%;"src="images/combat.jpg">
            <span class="badge badge-pill  badge-dark" style="margin-left: 140px; margin-top: 20px; width:50px;"><?php echo $can ?></span>

        </div>


         <div class="col-xs-7 col-xs-offset-1">
         	<div class="row">
         			<form method="post" action="fight.php">
         		<div class="col-xs-3 col-xs-offset-3">
         	
				  <div>
				  	<h5>Basdan Zerbe</h5>
				    <input type="radio" id="subscribeNews" name="doyus" value="bas_zerbe">
				  </div>
				   <div>
				  	<h5>Ayaqdan Zerbe</h5>
				    <input type="radio" id="subscribeNews" name="doyus" value="ayaq_zerbe">
				  </div>
				 <div>
				  	<h5>Yumruq Zerbe</h5>
				    <input type="radio" id="subscribeNews" name="doyus" value="yum_zerbe">
				  </div>
		

         	   </div>
         	   	<div class="col-xs-3 col-xs-offset-3">
         		
				  <div>
				  	<h5>Basdan Qorunma</h5>
				    <input type="radio" id="subscribeNews" name="qoru" value="bas_qoru">
				  </div>
				   <div>
				  	<h5>Ayaqdan Qorunma</h5>
				    <input type="radio" id="subscribeNews" name="qoru" value="ayaq_qoru">
				  </div>
				 <div>
				  	<h5>Yumruq Qorunma</h5>
				    <input type="radio" id="subscribeNews" name="qoru" value="yum_qoru">
				  </div>
				

         	   </div>
	
		      <input style="margin-left:250px;margin-top:100px; width:320px;" class="btn btn-primary" name="submit" type="submit" value="Start ">
		</form>
         	</div>
				
        </div>
        <div class="col-xs-1">
           
        	<img style="width:350px; height:320px; border-radius:50%;"src="images/zombi.jpg">
            <span class="badge badge-pill  badge-dark" style="margin-left: 150px; margin-top: 20px; width:50px;"><?php echo $wolf_can ?></span>

        </div>

    </div>
    <div style='margin-left:380px; margin-top:100px;'>

<?php

$ayaq='';
$yumruq='';
$bas='';
$doyus='';
$qoru='';
$r='';
  
  if(isset($_POST['submit'])){

			if(!empty(isset($_POST['doyus']) AND isset($_POST['qoru']))){

				$doyus=$_POST['doyus'];
			$qoru=$_POST['qoru'];



			// echo $doyus;
			// echo "<br>";
			// echo $qoru;
			// echo "<br>";

			$rand=rand(1,3);
				if($rand==1){

				$zerbe='bas_z';

			}else if($rand==2){

				$zerbe='ayaq_z';
				
			}else if($rand==3){

				$zerbe='yumruq_z';
			}



			$rand=rand(1,3);
				if($rand==1){

				$z_qoru='bas_q';

			}else if($rand==2){

				$z_qoru='ayaq_q';
				
			}else if($rand==3){

				$z_qoru='yumruq_q';
			}

			// if($doyus=='' OR $z_qoru=='' OR $qoru=='' OR $zerbe==''){
			// 	echo "Emelliyat ugursuzdur";
			// }


			if($can<=0 OR $wolf_can<=0){
				echo "<h1><i>The game is over</i></h1>";
			echo "<a style='hover:color:red;'href='combat.php'>Would you like to try again?</a><br><br>";
			// echo "<script>location.href='fight.php'</script>";


			}else{
				 if($doyus =='bas_zerbe' AND $z_qoru=='ayaq_q'){

				// $z1='Zombiden 10 xal cixilir Cunki siz onun basindan vurduz';

			 	$sql="UPDATE wolf SET zombi_can=$wolf_can-10, WHERE user_id='$user_id' ";
			 	$run=mysqli_query($con,$sql);
			 $sql2="INSERT INTO actions (user_id,action) VALUES('$user_id','Zombiden 10 xal cixilir Cunki siz onun basindan vurduz')";
			 	$run2=mysqli_query($con,$sql2);//duzdur
			 	
				 

			}else if($doyus=='bas_zerbe' AND $z_qoru=='yumruq_q'){
				 	$sql="UPDATE wolf SET zombi_can=$wolf_can-10 WHERE user_id='$user_id'";
			 	     $run=mysqli_query($con,$sql);

			$sql2="INSERT INTO actions (user_id,action) VALUES('$user_id','Zombiden 10 xal cixilir Cunki siz onun basindan vurduz ve o yumrugnan qorundu')";
			 	$run2=mysqli_query($con,$sql2);
			 	
			 	
				//echo '<h3 style="color:green">zombiden 10 xal cixilir</h3>';

			}else if($doyus=='bas_zerbe' 	AND $z_qoru=='bas_q'){
				 	$sql="UPDATE wolf SET zombi_can=$wolf_can WHERE user_id='$user_id'";
			 	     $run=mysqli_query($con,$sql);
			 	  $sql2="INSERT INTO actions (user_id,action) VALUES('$user_id','zombiden xal cixilmir cunki siz onun basindan vurduz ve o basindan qorundu')";
			 	$run2=mysqli_query($con,$sql2);
			 	
			//	echo '<h3 style="color:green">zombiden 15 xal cixilir</h3>';

			//ayaq zerbeye eyni funksiya veririk 
			}else if($doyus=='ayaq_zerbe' 	AND $z_qoru=='yumruq_q'){
				 	$sql="UPDATE wolf SET zombi_can=$wolf_can-15 WHERE user_id='$user_id'";
			 	     $run=mysqli_query($con,$sql);

			 	     	  $sql2="INSERT INTO actions (user_id,action) VALUES('$user_id','Zombiden 15 xal cixilir Cunki siz ona ayaq zerbesi  vurduz ama o yumrugnan qorundu')";
			 	$run2=mysqli_query($con,$sql2);
				//echo '<h3 style="color:green">zombiden 15 xal cixilir</h3>';

			}else if($doyus=='ayaq_zerbe' AND $z_qoru=='bas_q'){

				 	$sql="UPDATE wolf SET zombi_can=$wolf_can-20 WHERE user_id='$user_id'";
			 	     $run=mysqli_query($con,$sql);
			 	  $sql2="INSERT INTO actions (user_id,action) VALUES('$user_id','Zombiden 20 xal cixilir Cunki siz ona ayaq zerbesi vurduz ama o basdan qorundu')";
			 	$run2=mysqli_query($con,$sql2);
				//echo '<h3 style="color:green">zombiden 20 xal cixilir</h3>';

			}else if($doyus=='ayaq_zerbe' AND $z_qoru=='ayaq_q'){
				 	$sql="UPDATE wolf SET zombi_can=$wolf_can-20 WHERE user_id='$user_id'";
			 	     $run=mysqli_query($con,$sql);
				 $sql2="INSERT INTO actions (user_id,action) VALUES('$user_id','Zombiden xal cixilmir cunki siz ona ayaq  zerbesi  vurduz ama o ayaqnan qorundu')";
				$run2=mysqli_query($con,$sql2);

			//yumruq zerbelere eynifunksiya 
			}else if($doyus='yum_zerbe' AND $z_qoru='yumruq_q'){

				$sql="UPDATE wolf SET zombi_can=$wolf_can WHERE user_id='$user_id'";
			 	     $run=mysqli_query($con,$sql);

			$sql2="INSERT INTO actions (user_id,action) VALUES('$user_id','Zombiden  xal cixilmir cunki  siz  yumruqnan vurduz vurduz ve o yumrugnan qorundu')";
				$run2=mysqli_query($con,$sql2);


				//echo '<i>zombiden Xal cixilmir</i>';
			}else if($doyus='yum_zerbe' AND $z_qoru='ayaq_q'){

				$sql="UPDATE wolf SET zombi_can=$wolf_can-10 WHERE user_id='$user_id'";
			 	     $run=mysqli_query($con,$sql);

			$sql2="INSERT INTO actions (user_id,action) VALUES('$user_id','Zombiden  10 xal cixilir cunki  siz  yumruqnan vurduz vurduz ama o ayaqnan qorundu')";
				$run2=mysqli_query($con,$sql2);

				//echo '<i>zombiden Xal cixilmir</i>';
			}else if($doyus='yum_zerbe' AND $z_qoru='bas_q'){

				$sql="UPDATE wolf SET zombi_can=$wolf_can-10 WHERE user_id='$user_id'";
			 	 $run=mysqli_query($con,$sql);

			$sql2="INSERT INTO actions (user_id,action) VALUES('$user_id','Zombiden  10 xal cixilir cunki  siz  yumruqnan vurduz ama o ayaqnan')";
				$run2=mysqli_query($con,$sql2);

				//echo '<i>zombiden Xal cixilmir</i>';
			}




			if($qoru=='bas_qoru' AND $zerbe=='bas_z'){///qoru funksiyasi


			 	$sql="UPDATE wolf SET can=$can WHERE user_id='$user_id'";
			 	 $run=mysqli_query($con,$sql);


			$sql2="INSERT INTO actions (user_id,action) VALUES('$user_id','Sizden xal cixilmir   cunki  siz  basdan  qorunduz   ve o basdan  vurdu')";
				$run2=mysqli_query($con,$sql2);

				//echo '<i>sizden Xal cixilmir</i>';

			}else if($qoru=='bas_qoru' AND $zerbe=='ayaq_z'){

				$sql="UPDATE wolf SET can=$can-10 WHERE user_id='$user_id'";
			 	 $run=mysqli_query($con,$sql);

				$sql2="INSERT INTO actions (user_id,action) VALUES('$user_id','Sizden  10 xal cixilir cunki  siz basdan  qorunduz ve o ayaqdan vurdu')";
				$run2=mysqli_query($con,$sql2);

			//	echo '<i>Sizden xal cixilmir</i>';
			}else if($qoru=='bas_qoru' AND $zerbe=='yumruq_z'){

				$sql="UPDATE wolf SET can=$can-10 WHERE user_id='$user_id'";
			 	 $run=mysqli_query($con,$sql);


			$sql2="INSERT INTO actions (user_id,action) VALUES('$user_id','Sizden 10 xal cixildi cunki siz basdan qorunduz ama o yumruqnan vurdu')";
				$run2=mysqli_query($con,$sql2);
				//echo '<i>Sizden xal cixilmir</i>';

			}else if($qoru=='ayaq_qoru' AND $zerbe=='ayaq_z'){///qoru funksiyasi

				 	$sql="UPDATE wolf SET can=$can WHERE user_id='$user_id'";
			 	     $run=mysqli_query($con,$sql);

			    $sql2="INSERT INTO actions (user_id,action) VALUES('$user_id','sizden xal cixilmir')";
				$run2=mysqli_query($con,$sql2);

				//echo '<h3 style="color:red">Sizden 10 xal cixilir</h3>';

			}else if($qoru=='ayaq_qoru' AND $zerbe=='yumruq_z'){

				 	$sql="UPDATE wolf SET can=$can-10 WHERE user_id='$user_id'";
			 	     $run=mysqli_query($con,$sql);

			   $sql2="INSERT INTO actions (user_id,action) VALUES('$user_id','Sizden 10 xal cixilir cunki siz ayaqnan qorunduz ve o yumrugnan vurdu')";
				$run2=mysqli_query($con,$sql2);

				//echo '<h3 style="color:red">Sizden 10 xal cixildi</h3>';

			}else if($qoru=='ayaq_qoru' AND $zerbe=='bas_z'){///qoru funksiyasi
				 	$sql="UPDATE wolf SET can=$can-15 WHERE user_id='$user_id'";
			 	     $run=mysqli_query($con,$sql);

			 	      $sql2="INSERT INTO actions (user_id,action) VALUES('$user_id','Sizden 15 xal cixilir Cunki siz ayaqnan qorunduz ama o basindan vurdu')";
				$run2=mysqli_query($con,$sql2);
				//echo '<h3 style="color:red">Sizden 15 Xal cixilir</h3>';

			}else if($qoru=='yum_qoru' AND $zerbe=='yumruq_z'){///qoru funksiyasi
				 	$sql="UPDATE wolf SET can=$can WHERE user_id='$user_id'";
			 	     $run=mysqli_query($con,$sql);
			 	      $sql2="INSERT INTO actions (user_id,action) VALUES('$user_id','Sizden xal cixilmir cunki siz yumrugdan qorunduz ve o yumrugnan vurdu')";
				    $run2=mysqli_query($con,$sql2);

				//echo '<h3 style="color:red"Sizden 15 Xal cixilir</h3>';
			}else if($qoru=='yum_qoru' AND $zerbe=='bas_z'){

				 	$sql="UPDATE wolf SET can=$can-20 WHERE user_id='$user_id'";
			 	     $run=mysqli_query($con,$sql);
			 	      $sql2="INSERT INTO actions (user_id,action) VALUES('$user_id','Sizden 20 xal cixilir cunki siz yumrugnan qorunduz ve o basdan vurdu')";
				   $run2=mysqli_query($con,$sql2);

				//echo '<h3 style="color:red">Sizden 20 xal cixilir</h3>';
			}else if($qoru=='yum_qoru' AND $zerbe=='ayaq_z'){

			 	$sql="UPDATE wolf SET can=$can-20 WHERE user_id='$user_id'";
			 	     $run=mysqli_query($con,$sql);

			   $sql2="INSERT INTO actions (user_id,action) VALUES('$user_id','sizden  20 xal cixilir Cunki siz yumruqdan qorunduz  o ayaqdan vurdu')";
				$run2=mysqli_query($con,$sql2);

				//echo '<h3 style="color:red">Sizden 20 xal cixilir</h3>';
			}






}
	




}else{
		echo "<h3 style='color:gray'>Doyus novu secmelisiz</h3>";
	
}
	if($can<=0 OR $wolf_can<=0){
  		$sql_2="DELETE FROM actions where user_id='$user_id'";
  		$r=mysqli_query($con,$sql_2);
  	}


  	header("Location:fight.php");


}
$sql3="SELECT * FROM actions  WHERE user_id='$user_id' ORDER BY id DESC";
 	$run3=mysqli_query($con,$sql3);
 	while($row3=mysqli_fetch_array($run3)){
 	$action_id=$row3['id'];
 	$action=$row3['action'];

 	echo "<i>$action</i><br>";
 
 
 	
 	};


?>
<br>
</div>
</div>