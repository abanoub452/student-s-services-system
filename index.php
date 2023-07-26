<?php
if (!isset($_SESSION)) {
  session_start();
  require_once('Connections/syscon.php');
}

if (isset($_POST['user'])) {
   $loginUsername=$_POST['user'];
   $password=$_POST['pass'];
   //$MM_fldUserAuthorization = "type";
   $MM_redirectLoginSuccess = "p63system/index_st.php";
   //$MM_redirectLoginFailed = "index.php?id=1";
   $MM_redirecttoReferrer = false;
   mysqli_select_db($bis,$database_bis);
      
   $query="SELECT * FROM p63_student WHERE eng_name='$loginUsername' AND student_id ='$password'";
 
   $LoginRS = mysqli_query($bis,$query) or die(mysqli_error($bis));
   $row_LoginRS = mysqli_fetch_assoc($LoginRS);
   $loginFoundUser = mysqli_num_rows($LoginRS);
   if ($loginFoundUser>0) {
     
    // $loginStrGroup  = $row_LoginRS['Type'];
     
     //declare two session variables and assign them
     $_SESSION['student_id'] = $row_LoginRS['student_id'];
    $_SESSION['eng_name'] = $row_LoginRS['eng_name'];
    $_SESSION['phone'] = $row_LoginRS['phone'];
    $_SESSION['level'] = $row_LoginRS['level'];
    //$_SESSION['userimage'] = $row_LoginRS['image'];
     //$_SESSION['MM_UserGroup'] = $loginStrGroup;	      
 
 
     if (isset($_SESSION['PrevUrl']) && false) {
       $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
     }
     header("Location: " . $MM_redirectLoginSuccess );
   }
   else {
      $error[] = 'incorrect email or password!';
    }
 }
 ?>
 
 <?php
   
 mysqli_select_db($bis,$database_bis);
 $query_appata = "SELECT *  FROM `application_data`";
 $appata = mysqli_query($bis,$query_appata) or die(mysqli_error($bis));
 $row_appata = mysqli_fetch_assoc($appata);
 
 $_SESSION['app_name'] = $row_appata['app_name'];
 $_SESSION['uniname'] = $row_appata['Uni_name'];
 $_SESSION['faclutyname'] = $row_appata['Faculty_name'];
 $_SESSION['programnanme'] = $row_appata['Program_name'];
 $_SESSION['facultylogo'] = $row_appata['Faculty-Uni_logo'];
 $_SESSION['programlogo'] = $row_appata['Program_logo'];
 $_SESSION['deanname'] = $row_appata['Faculty_Dean'];
 $_SESSION['postvicedean'] = $row_appata['Post_grad_vice_dean'];
 $_SESSION['affairsvicedean'] = $row_appata['st_affairs_vice_dean'];
 $_SESSION['programcoordinator'] = $row_appata['Program_coordinator'];
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <!-- custom css file link  -->
   <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');

*{
   font-family: 'Poppins', sans-serif;
   margin:0; padding:0;
   box-sizing: border-box;
   outline: none; border:none;
   text-decoration: none;
}

.container{
   min-height: 100vh;
   display: flex;
   align-items: center;
   justify-content: center;
   padding:20px;
   padding-bottom: 60px;
}

.container .content{
   text-align: center;
}

.container .content h3{
   font-size: 30px;
   color:#333;
}

.container .content h3 span{
   background: crimson;
   color:#fff;
   border-radius: 5px;
   padding:0 15px;
}

.container .content h1{
   font-size: 50px;
   color:#333;
}

.container .content h1 span{
   color:crimson;
}

.container .content p{
   font-size: 25px;
   margin-bottom: 20px;
}

.container .content .btn{
   display: inline-block;
   padding:10px 30px;
   font-size: 20px;
   background: #333;
   color:#fff;
   margin:0 5px;
   text-transform: capitalize;
}

.container .content .btn:hover{
   background: crimson;
}

.form-container{
   min-height: 100vh;
   display: flex;
   align-items: center;
   justify-content: center;
   padding:20px;
   padding-bottom: 60px;
   background: #eee;
}

.form-container form{
   padding:20px;
   border-radius: 5px;
   box-shadow: 0 5px 10px rgba(0,0,0,.1);
   background: #fff;
   text-align: center;
   width: 500px;
}

.form-container form h3{
   font-size: 30px;
   text-transform: uppercase;
   margin-bottom: 10px;
   color:#333;
}

.form-container form input,
.form-container form select{
   width: 100%;
   padding:10px 15px;
   font-size: 17px;
   margin:8px 0;
   background: #eee;
   border-radius: 5px;
}

.form-container form select option{
   background: #fff;
}

.form-container form .form-btn{
   background: #4942E4;
   color:#fff;
   text-transform: capitalize;
   font-size: 20px;
   cursor: pointer;
}

.form-container form .form-btn:hover{
   background: #11009E;
   color:#fff;
}

.form-container form p{
   margin-top: 10px;
   font-size: 20px;
   color:#333;
}

.form-container form p a{
   color:crimson;
}

.form-container form .error-msg{
   margin:10px 0;
   display: block;
   background: crimson;
   color:#fff;
   border-radius: 5px;
   font-size: 20px;
   padding:10px;
}
   </style>

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="user" required placeholder="enter your name">
      <input type="password" name="pass" required placeholder="enter your password">
      <input type="submit" name="submit" value="login now" class="form-btn">
   </form>

</div>

</body>
</html>