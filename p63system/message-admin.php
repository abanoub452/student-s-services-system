<?php
if (!isset($_SESSION)) {
    session_start();
  }
  // connection to database
  require_once('../Connections/syscon.php');  


  //get messages data from database
    $selcet = "SELECT *
    FROM p63_announcement
    JOIN users
    ON (users.user_id=p63_announcement.message_by)
    JOIN p63_student_level
    ON (p63_student_level.student_level=p63_announcement.student_level)
    ORDER BY message_date DESC;
    ";
    $s = mysqli_query($bis , $selcet); 
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../p63css/main1.css">
    <link rel="stylesheet" href="../p63assets/assets/bootstap/bootstrap.min.css">
    <title>Message</title>
    <link href="../p63assets/assets/css/style.css" rel="stylesheet">
   
  <link href="../p63assets/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

</head>

<body>
<?php include 'admin-header.php';?>


<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
 <ul class="sidebar-nav" id="sidebar-nav">
   <li class="nav-item ">
     <a class="nav-link collapsed " href="admin.php">
       <i class="bi bi-grid"></i>
       <span>لوحة القيادة</span>
     </a>
   </li><!-- End Dashboard Nav -->
   <li class="nav-item">
     <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
       <i class="bi bi-layout-text-window-reverse"></i><span>جداول البيانات</span><i style="padding:0 140px;" class="bi bi-chevron-down ms-auto"></i>
     </a>
     <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
       <li>
         <a href="order-requests.php">
         <i class="bi bi-circle"></i><span>الطلبات المقدمه</span>
         </a>
       </li>
       <li>
         <a href="paid orders.php">
         <i class="bi bi-circle"></i><span>الطلبات المدفوعه</span>
         </a>
       </li>
       <li>
         <a href="in-progress requests.php">
         <i class="bi bi-circle"></i><span>طلبات قيد العمل </span>
         </a>
       </li>
       <li>
         <a href="requests-completed.php">
         <i class="bi bi-circle"></i><span>طلبات تم انتهاء منها</span>
         </a>
       </li>
       <li>
     <a href="order_request_rejected.php">
     <i class="bi bi-circle"></i><span>الطلبات التى تم رفضها</span>
     </a>
   </li>
   <li>
     <a href="complain_tables_respond.php">
     <i class="bi bi-circle"></i><span>الشكاوى التى تم الرد عليها</span>
     </a>
   </li>
     </ul>
   </li><!-- End Tables Nav -->
   <li class="nav-item">
     <a class="nav-link collapsed " href="Announcement.php">
       <i class="bi bi-grid"></i>
       <span>ارسال رساله</span>
       </a>
   </li><!-- End Announcement Nav -->
   <li class="nav-item">
     <a class="nav-link  " href="message-admin.php">
       <i class="bi bi-grid"></i>
       <span>رسائل الكليه</span>
       </a>
   </li><!-- End message-admin Nav -->
   <li class="nav-item">
     <a class="nav-link collapsed " href="admin-complain.php">
       <i class="bi bi-grid"></i>
       <span>الشكاوى</span>
       </a>
   </li><!-- End complain Nav -->
   </ul>
   </aside>
   <main id="main" class="main">

<div class="">
        <h1>الرسائل</h1>
    </div>
    <?php foreach($s as $data):?>
    <div class="message col-lg-12">
        <div class="info">

            <div class="person">
                <div class="container-fluid">
                    <div class="row">
                        <img src="../p63images/users/<?= $data['image']?>" alt="">
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
            <p style="text-align:center;"><?=$data['level_text']?></p>
            <p style="text-align:center;"><?=$data['message_text']?></p>
            </div>

        <?php    
        }
        else
        {
            ?>
            <div class="news" style="text-align: center;">
            <p style="text-align:center;"><?=$data['level_text']?></p>
            <p style="text-align:center;"><?=$data['message_text']?></p>
            <img width="300" class="mt-3" src="../p63images/messages/<?= $data['message_image']?>" alt="">
            </div>

        <?php
        }
        ?>
       
        
    </div>
    <?php endforeach;?>

    </main><!-- End #main -->
    <?php include 'footer.php';?>


    <script src="../p63assets/assets/bootstap/jquery.slim.min.js"></script>
    <script src="../p63assets/assets/bootstap/popper.min.js"></script>
    <script src="../p63assets/assets/bootstap/bootstrap.min.js"></script>
    <!-- Vendor JS Files -->
  <script src="../p63assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../p63assets/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../p63assets/assets/vendor/echarts/echarts.min.js"></script>
  <script src="../p63assets/assets/vendor/quill/quill.min.js"></script>
  <script src="../p63assets/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../p63assets/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../p63assets/assets/vendor/php-email-form/validate.js"></script>


    <script src="app.js"></script>
</body>