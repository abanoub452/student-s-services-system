<?php
 if (!isset($_SESSION)) {
  session_start();
}
// connection to database
require_once('../Connections/syscon.php');  


$selcet = "SELECT *
 FROM p63_complain
 JOIN p63_student
 ON (p63_student.student_id=p63_complain.sid)
 ORDER BY complain_date DESC
 
 ";
 
 
 $s = mysqli_query($bis , $selcet);

 // complian respond
 
$user_ID = $_SESSION['userid'];

$studentID = null;
$studentName = null;
$studentlevel = null;
$complain_type = null;
$complian_text = null;
 if(isset($_GET['respond']))
 {
    $id = $_GET['respond'];


     
    $selcet = "SELECT *
    FROM p63_complain
    JOIN p63_student
    ON (p63_student.student_id=p63_complain.sid)
    JOIN p63_complain_status 
    ON (p63_complain_status.respond_status_id=p63_complain.complain_status_id)
    Where p63_complain.complain_id = $id;
    ";
    $s = mysqli_query($bis , $selcet);

     $data = mysqli_fetch_assoc($s);

     $studentID = $data['student_id'];
     $studentName = $data['arb_name'];
     $studentlevel = $data['level'];
     $complain_type=$data['complain_type'];
     $complian_text= $data['complain_text'];

     $update = "UPDATE p63_complain SET complain_status_id = 2, respond_by = $user_ID , seen_complain_date = now() Where complain_id = $id ";
     $up = mysqli_query($bis , $update);


     if(isset($_POST['send']))
     {
         $respond_text = $_POST['text'];
         

         $update = "UPDATE p63_complain SET complain_status_id = 3, respond_by = $user_ID, complain_respond = '$respond_text' , respond_date = now() Where complain_id = $id ";
         $up = mysqli_query($bis , $update);

         
         // testmessage($up , "update");
         header("location: admin-complain.php");

     }

 }



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Complain respond</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,
  600,600i,700,700i|Nunito:300,300i,
  400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,
  500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../p63assets/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../p63assets/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../p63assets/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../p63assets/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../p63assets/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../p63assets/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../p63assets/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <link href="../p63assets/assets/css/style.css" rel="stylesheet">

  
  <style>
    .button {
  background-color: #012970;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
    
    
    /* .button1 {background-color: #4CAF50;} Green */
    .button2 {background-color: #008CBA;} /* Blue */
    </style>
</head>

<body>
<?php include 'admin-header.php';?>
   <!-- ======= Sidebar ======= -->
   <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed " href="admin.php">
          <i class="bi bi-grid"></i>
          <span>لوحة القيادة</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>جداول البيانات</span><i class="bi bi-chevron-down ms-auto"></i>
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
        <a class="nav-link collapsed  " href="Announcement.php">
          <i class="bi bi-grid"></i>
          <span>ارسال رساله</span>
          </a>
      </li><!-- End Announcement Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed " href="message-admin.php">
          <i class="bi bi-grid"></i>
          <span>رسائل الكليه</span>
          </a>
      </li><!-- End message-admin Nav -->
      <li class="nav-item">
        <a class="nav-link  " href="admin-complain.php">
          <i class="bi bi-grid"></i>
          <span>الشكاوى</span>
          </a>
      </li><!-- End complain Nav -->
      </ul>
      </aside>
      <main id="main" class="main">
      
      <div class="pagetitle">
      <h1>الشكاوى</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">الشكاوى</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

<div class="col-lg-12">

  <!-- Card with an image on top -->
  <div class="card">
   <div class="card-body"> 
  <h5    class="card-title">Complain Details</h5>
  <h5><span style="font-size: 30px;">name</span>: <?=$studentName?>  </h5>
  <h5><span style="font-size: 30px;">ID</span>: <?=$studentID?>  </h5>
  <h5><span style="font-size: 30px;">type</span>: <?=$complain_type?>   </h5>
  <span style="font-size: 30px;">complain message</span>
  <p class="card-text"><?=$complian_text?></p>
<div class="gallery">
  <a class="image" href="../p63images/comlpain/<?= $data['image']?>"><img width="200" class="mt-2" src="../p63images/comlpain/<?= $data['image']?>" alt=""></a>
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
    <div class="card-body">
      <h5 class="card-title">Respond in a comlain</h5>
     <form method="post">
    <div class="form-row">
    <div class="form-group col-lg-6">
        <div class="form-group col-lg-6">
            <label>Name</label>
            <input name="name" type="text" class="form-control"  value="<?php echo $_SESSION['username']; ?>"> 
        </div>
    </div>

    <div class="form-group">
        <div class="form-group">
            <label for="exampleFormControlTextarea1">message</label>
            <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
    </div>
    
    </div>
    <br>
    <div >
        <button class="button" name="send" type="submit">send respond</button>
    </div>
    <br>
</form>
    </div>
  </div><!-- End Card with an image on top -->



</div>


</section>

   

</main><!-- End #main -->
<?php include 'footer.php';?>


  <!-- Vendor JS Files -->
  <script src="../p63assets/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../p63assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../p63assets/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../p63assets/assets/vendor/echarts/echarts.min.js"></script>
  <script src="../p63assets/assets/vendor/quill/quill.min.js"></script>
  <script src="../p63assets/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../p63assets/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../p63assets/assets/vendor/php-email-form/validate.js"></script>

  <script src="../p63assets/assets/js/main.js"></script>
  </body>
  </html>