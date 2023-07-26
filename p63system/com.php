<?php
if (!isset($_SESSION)) {
  session_start();
}
// connection to database
require_once('../Connections/syscon.php');  
 
 $sid= $_SESSION['student_id'];

 $selcet = "SELECT *
 FROM p63_complain
 JOIN p63_student
 ON (p63_student.student_id=p63_complain.sid)
 JOIN p63_complain_status
 ON (p63_complain_status.respond_status_id=p63_complain.complain_status_id)
 WHERE p63_complain.sid = $sid 
 order by p63_complain.complain_date DESC;
 ";
 
 $s = mysqli_query($bis , $selcet);

 
 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../p63assets/assets/bootstap/bootstrap.min.css">
    <link rel="stylesheet" href="../p63assets/assets/webfonts/all.min.css">
    <link rel="stylesheet" href="../p63css/main.css">
    <title>متابعه الشكوى</title>
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
  <a href="com.php" class="active"> متابعه الشكوى</a>
  <a href="complain.php" >تقديم شكوى </a>
  <a href="message.php">رسائل الكليه</a>
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
    <div class="home" id="home-student">
        <header>
            <h1>حالة الشكوى</h1>
        </header>
        <br>
        <?php foreach($s as $data):?>
        <table class="table  col-md-6 table-striped student-table ">
            <thead>
            
                <tr>
                    <th class="text" scope="col"><?=$_SESSION['student_id']?></th>
                    <th class="text" scope="col"  id="head"> كود الطالب </th>
    
                    <th class="text" scope="col" >   <?=$_SESSION['eng_name']?></th>
    
                    <th class="text" scope="col"  id="head" >الاسم</th>
    
                </tr>

            </thead>
            <tbody>
            
                <tr>
                     <td colspan="2" class="com"> حالة الشكوى : <?=$data['respond_status']?></td>
                    <td colspan="2" class="com1">  الشكوى المقدمه : <?=$data['complain_text']?></td>

                </tr>
                
                <tr>
                   <td colspan="2" class="com"> الرد على الشكوى :<?=$data['complain_respond']?></td>
                    <td colspan="2" class="com1"> نوع الشكوى : <?=$data['complain_type']?></td>
                </tr>
                <tr>
                    <td colspan="2"class="com"> </td>
                    <td colspan="2" class="com1"> <img width="200" class="mt-2" src="../p63images/comlpain/<?= $data['image']?>" alt=""><br></td>
    
                </tr>
             
              
               
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2" ></td>
                </tr>
               
             
            </tfoot>
        </table>
        <?php endforeach;?>
    

   
    </div> 
 

    <?php include 'footer.php';?>


    <script src="../p63assets/assets/bootstap/jquery.slim.min.js"></script>
    <script src="../p63assets/assets/bootstap/popper.min.js"></script>
    <script src="../p63assets/assets/bootstap/bootstrap.min.js"></script>
</body>

</html>