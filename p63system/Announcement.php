<?php
 if (!isset($_SESSION)) {
  session_start();
}
// connection to database
require_once('../Connections/syscon.php');  

  

 if(isset($_POST['send']))
 {
     $m_name = $_SESSION['userid'];
     $message_text = $_POST['text'];
     $level = $_POST['reason'];
     $student_level=$_POST['reason'];

    //insert image
    $img_name=time() . $_FILES['image']['name'];
    $tmp_name=$_FILES['image']['tmp_name'];
    $location='../p63images/messages/'.$img_name;
    move_uploaded_file($tmp_name,$location );


     $insert = "INSERT  INTO p63_announcement VALUES(null,'$message_text','$img_name',now(),$level,'$m_name',$student_level)";
     $s=mysqli_query($bis,$insert);
     
 }
 
 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

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
        <a class="nav-link  " href="Announcement.php">
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
        <a class="nav-link collapsed " href="admin-complain.php">
          <i class="bi bi-grid"></i>
          <span>الشكاوى</span>
          </a>
      </li><!-- End complain Nav -->
      </ul>
      </aside>
      <main id="main" class="main">
      <form method="post"  enctype="multipart/form-data">
      <div class="card">
            <div class="card-body">
              <h5 class="card-title">انشاء رساله جديده</h5>
<header>
        </header>
        <form method="post" enctype="multipart/form-data">
            <div class="form-row">
            <div class="form-group col-lg-6">
                <div class="form-group col-lg-6">
                    <label>الاسم</label>
                    <input name="name" type="text" class="form-control"  value="<?php echo $_SESSION['username']; ?>"> 
                </div>
            </div>

            <div class="form-group">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">الرساله</label>
                    <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label for="inputCity"> رفع صوره </label>
                    <input type="file" name="image" class="form-control" id="inputCity">
                </div>
                <div class="form-group col-lg-6">
                    <label for="inputState">المستويات</label>
                    <select name="reason" id="inputState" class="form-control">
                        <option value="6" selected>All Level</option>
                        <option value="1"> المستوى الاول </option>
                        <option value="2">المستوى الثانى</option>
                        <option value="3">المستوى الثالث</option>
                        <option value="4">المستوى الرابع</option>
                        <option value="5">الخريجين</option>
                    </select>
                </div>
               
            </div>
            <br>
            <div >
                <button class="button" name="send" type="submit">ارسال</button>
            </div>
            <br>
        </form>
  
    </div>
  
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