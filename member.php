<!DOCTYPE html>
<?php
//ikinci variant 
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

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

<script type="text/javascript">

 $(function() {
      
       $("a.like").click(function() {
         
          var nesne = $(this);
        
        var id = nesne.attr("id");
           
        var veri = "id="+id+"&durum=1";
         
         $.ajax({
          
          url: "like.php",
          data: veri,
          type: "post",
          dataType: "json",
            success: function(e) {
              if(e.hata){
                alert(e.hata);
              }
              else
              {
                alert(e.ok);
               //  var c=$("#"+id+".begen").html();
               //  var e=c+1;
               //  //var sayi= parseInt(c)+1;
               // $("#"+id+".begen").html(s);
              }
            
             }
         
       });
       
      });
    });
</script>


<body>

  <div class="row">
  <div class='col-sm-2 col-sm-offset-1'>
  </div>
  <div class='col-sm-6 '>
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="getCode">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<script>
  
$(document).ready(function() {
  $('.btn_user').on('click', function() {
    console.log('test');
    let msg_id = $(this).attr('id');
    console.log(msg_id);
    
   $.ajax({
      type:'GET',
      data: {
        id: msg_id,
      },
      url:"load-likes.php",
      dataType:"html",

    success: function(resp){
      console.log(resp);
        $("#getCode").html(resp);
        
    }


    });

   });

});
 
</script>
 
    <div class='load-msg' id='select_user2' id='scroll-messages'>
      
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
      //$count_like=$row['like_p'];
          
          
      $user_posts = "select * from posts where user_id='$user_id'"; 
      $run_posts = mysqli_query($con,$user_posts); 
      $posts = mysqli_num_rows($run_posts);

//$result=mysqli_query($con,"SELECT like_p from messages where user_id='$user_id'");

      // $user_likes = "select like_p from messages where user_id='$user_id'"; 
      // $run_likes= mysqli_query($con,$user_likes); 
      // $likes = count($run_likes);
  
      
      ?>
<?php

// var_dump($id);
// var_dump($user_id);
// exit;
//error funksiya ve insert
if(isset($_POST['send_msg'])){

    global $con;
    $textcode=array(':D',':P');
    $smiles=array('<img src="images/smile.png">','<img src="images/smile7.png">');
    $str_replace=str_replace($textcode,$smiles,$_POST['msg_box2']);

  $msg1=htmlentities($_POST['msg_box2']);
   $msg1=str_replace($msg1,$str_replace,$_POST['msg_box2']);

  if($msg1 ==""){
    echo "<h4 style='color:red;text-align:center;'>Message was unable to send</h4>";
  }else if(strlen($msg1)>37){
    echo "<h4 style='color:red;text-align:center;'>Message was unable too long!use only 37 characters</h4>";
  }else{

  $insert="insert into messages(user_id,messages,activated,date,like_p) value('$user_id','$msg1','no',NOW(),'0')";
   $send=mysqli_query($con,$insert);   
  }

}

?>
<?php
 // $sql = "SELECT * FROM messages";
 //  if($result = mysqli_query($con,$sql)){
 //    if(mysqli_num_rows($result) > 0){
 //        while($row = mysqli_fetch_array($result)){
 //                $read_id=$row['id'];
 //                $read_name=$row['messages'];
 //                $read_user_id=$row['user_id'];
 //                $read_date=$row['date'];
 //              // echo "<a href='readen.php?$read_id'>readen</a><br>";
             
                
 //          }
 //        }
 //       }
?>


 
  <?php
 
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
    $count_like=$row_msg['like_p'];


    ?>


    <div id="loaded_msg">
      <form method="POST">
      <p>
      
        <?php



        // echo "<div><span style='background-color:yellow;margin-left:430px; margin-top:50px;'>$username<span></div>";
        echo "<div class='message' id='blue' data-toogle='tooltip'>$msg2<br><small>$date</small></div><br><br><br>";
        echo $id;
        echo "<span style='float:right;' id='likess' id='begen' id='$id'>$count_like</span>";
     echo "<a href='javascript:;' id='$id' class='like'  style='margin-left:580px'><i class='fas fa-thumbs-up'></i></a>
";      echo"
           <button type='button' id='$id' class='btn btn-primary btn_user' style='margin-left:530px; margin-top:-35px;' data-toggle='modal' data-target='#exampleModal'>
             +
            </button>";

     
        //  echo"<form method='POST'>";   
        // echo "<input type='submit' id='$id' name='btn_user' class='btn_user' value='$id'>";
        //    echo "</form>";


    ?></p>
</form>
    </div>
  
  <?php } ?>
     <?php

  //  if(isset($_POST['btn_user'])){
 // $sel_ms="SELECT * from users INNER JOIN likes ON users.id=likes.user_id and likes.post_id='$id'";
 //  $run_ms=mysqli_query($con,$sel_ms);

 //  while($row_ms=mysqli_fetch_array($run_ms)){ 
 //    $name=$row_ms['f_name'];
 //  echo $name."<br>";

 //  }
   
  ?>
 
  </div>
  
        <form action="" method="POST">
        <textarea class="form-control" placeholder="Enter your message" name="msg_box2" id="message_textarea"></textarea>
        <input type="submit" name="send_msg" id="btn-msg" class="btn btn-success"  value="send">
  
        </form><br><br><br><br>

  </div>










  
</div>
<script>

</script>


</body>
</html>






