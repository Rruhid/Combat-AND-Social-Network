 
<?php
sss
//request for confirming
    if(isset($_POST['confirm'])){

      $friend_request2=$_POST['confirm'];

         $sql="SELECT * FROM friend_requests WHERE '$gonderen'=user_from";
                $run_select=mysqli_query($con,$sql);
                $count_row=mysqli_num_rows($run_select);

                if($count_row >0){

            echo "You can not accept a friendship instead of "."<strong>".$user_to_name."<strong>";
      

                }else{

                   $create_request=mysqli_query($con,"UPDATE friend_requests  SET value='2'");
              echo "<strong>".$gonderen."</strong>"."Confirmed a request from"."<strong>".$user_to_name."</strong>";
            
                }

               




         //   }
            

      
    }


  ?>


      <?php



         $sql="SELECT * FROM friend_requests WHERE user_from='$gonderen' AND user_to='$user_to_name'";
                $run_select=mysqli_query($con,$sql);
                $count_select=mysqli_num_rows($run_select);

                if($count_select > 0 || $count_select==2){
                 echo "<h4 style='margin-right:260px; color:green;'>Your request has been send already</h4>";
            

            }else{

            $create_request=mysqli_query($con,"INSERT INTO friend_requests (user_from,user_to,value) VALUES ('$gonderen','$user_to_name','1')");
              //echo "<strong>".$gonderen."</strong>"." send  a friendship to "."<strong>".$user_to_name."</strong>";

             echo "<h4 style='margin-right:260px;'><span style='color:red'>".$gonderen."</span> send a friendship to <span style='color:red'>".$user_to_name."</span></h4>";
          
            }


      
    }


  ?>