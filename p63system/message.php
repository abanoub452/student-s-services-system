<?php
if (!isset($_SESSION)) {
  session_start();
}
// connection to database
require_once('../Connections/syscon.php');  

//variable for student level
$lev= $_SESSION['level'];
$level = $lev;

// for students
if($level!=5)
{
    $selcet = "SELECT *
    FROM p63_announcement
    JOIN users
    ON (users.user_id=p63_announcement.message_by)
    JOIN p63_student
    on (p63_student.level=p63_announcement.student_level)
    WHERE p63_announcement.student_level = $lev or  p63_announcement.student_level = 6
    ORDER BY message_date DESC;
    ";
    $s = mysqli_query($bis , $selcet); 
}
else
{
    $selcet = "SELECT *
    FROM p63_announcement
    JOIN users
    ON (users.user_id=p63_announcement.message_by)
    JOIN p63_student
    on (p63_student.level=p63_announcement.student_level)
    WHERE p63_announcement.student_level = $lev or  p63_announcement.student_level = 7
    ORDER BY message_date DESC;
    ";
    $s = mysqli_query($bis , $selcet); 
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../p63css/main1.css">
    <link rel="stylesheet" href="../p63assets/assets/webfonts/all.min.css">
    <link rel="stylesheet" href="../p63assets/assets/bootstap/bootstrap.min.css">
    <title>Message</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {margin:0;}

.topnav {
  overflow: hidden;
  background-color: #283a5ae6;
  text-align: center;
}

.topnav a {
  /* float: left; */
  float:center;
  display: inline-block;
  color: #f2f2f2;
  text-align: center;
  padding: 20px 16px;
  text-decoration: none;
  font-size: 17px;
  height:70px;
}

.active {
  background-color: #152033 ;
  height:70px;
  color: white;
}

.topnav .icon {
  display: none;
}



.topnav a:hover, .dropdown:hover .dropbtn {
  background-color: #ddd;
  color: black;
}

.dropdown-content a:hover {
  background-color: #ddd;
  color: black;
}

.dropdown:hover .dropdown-content {
  display: block;
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child), .dropdown .dropbtn {
    display: none;
  }
  .topnav a.icon {
    float: right ;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: center;
  }
  .topnav.responsive .dropdown {float: none;}
  .topnav.responsive .dropdown-content {position: relative;}
  .topnav.responsive .dropdown .dropbtn {
    display: block;
    width: 100%;
    text-align: left;
  }
}
</style>
</head>

<body>
<?php include 'student_header.php';?>
<div class="topnav" style="text-align: center;" id="myTopnav">
  <a href="com.php" > متابعه الشكوى</a>
  <a href="complain.php" >تقديم شكوى </a>
  <a href="message.php" class="active">رسائل الكليه</a>
  <a href="service status.php">متابعه الطلب </a>
  <a href="service.php" >الخدمات</a>

  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div>
<script>
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }
    </script>
    
    <div class="header" style="display:flex;">
        <i class="fa-solid fa-message"></i> <h1>messages</h1>
    </div>
    <?php foreach($s as $data):?>
    <div class="message col-lg-7">
        <div class="info">

            <div class="person">
                <div class="container-fluid">
                    <div class="row">
                    <img  src="../p63images/users/<?= $data['image']?>" alt="">
                        
                        <h1><?=$data['username']?> <br>
                            <span><?=$data['message_date']?></span>
                        </h1>
                    </div>
                </div>
            </div>
        


        </div>


        <!-- retrive message image -->
        <?php
        if(empty($data['message_image']))
        {
            ?>
            <div class="news" style="text-align: center;">
            <p style="text-align:center;"><?=$data['message_text']?></p>
            </div>

        <?php    
        }
        if(!empty($data['message_image']))
        {
            ?>
            <div class="news" style="text-align: center;">
            <p style="text-align:center;"><?=$data['message_text']?></p>
            <div class="gallery">
            <a class="image" href="../p63images/messages/<?= $data['message_image']?>"><img width="300" class="mt-3" src="../p63images/messages/<?= $data['message_image']?>" alt=""></a>
        </div>
            <script>
                            $(".gallery").magnificPopup({
                                delegate: 'a',
                                type: 'image',
                                gallery:{
                                    enabled: true
                                }
                            });
                        </script>
            </div>

        <?php
        }
        ?>


       
        
    </div>
    <?php endforeach;?>
    <br><br>
    <?php include 'footer.php';?>


    <script src="../p63assets/assets/bootstap/jquery.slim.min.js"></script>
    <script src="../p63assets/assets/bootstap/popper.min.js"></script>
    <script src="../p63assets/assets/bootstap/bootstrap.min.js"></script>

    <script src="app.js"></script>
</body>

</html>