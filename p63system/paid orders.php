<?php
if (!isset($_SESSION)) {
  session_start();
}
// connection to database
require_once('../Connections/syscon.php');  

$selcet= "SELECT *
FROM p63_order
JOIN p63_student
ON (p63_student.student_id=p63_order.student_id)
JOIN p63_services
ON (p63_services.service_id=p63_order.service_id)
JOIN users 
ON (users.user_id=p63_order.done_by_user)
WHERE receipt_image IS NOT null && order_status_id = 3
ORDER BY p63_order.apply_date;
";
$s = mysqli_query($bis , $selcet);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin-Data-Tables</title>
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

  
</head>
<?php include 'admin-header.php';?>
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="admin.php">
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
    <a class="nav-link collapsed " href="Announcement.php">
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
<body>


    <div class="pagetitle">
      <h1>جدول البيانات</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">الصفحه الرئيسيه</a></li>
          <li class="breadcrumb-item">الشكاوى</li>
          <li class="breadcrumb-item active">البيانات</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">طلبات تم دفعها</h5>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">الموظف المسئول</th>
                    <th scope="col">وصل الدفع</th>
                    <th scope="col">تاريخ الدفع</th>
                    <th scope="col">تاريخ ارسال الكود</th>
                    <th scope="col">نوع الطلب</th>
                    <th scope="col"> مستوى الطالب</th>
                    <th scope="col">اسم الطالب</th>
                    <th scope="col">كود الطالب</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($s as $data):?>
                  <tr>
                    <td><?= $data['user_ar_name']?></td>
                    <td> <img width=100px; src="upload/<?= $data['receipt_image']?>" alt=""></td>
                    <td><?=$data['payment_date']?></td>
                    <td><?=$data['send_pay_code_date']?></td>
                    <td><?=$data['service_name']?></td>
                    <td><?=$data['level']?></td>
                    <td><?=$data['arb_name']?></td>
                    <th scope="row"><?=$data['student_id']?></th>
                  </tr>
                  <?php endforeach;?>
                  
                </tbody>
              </table>
              <!-- نهايه جدول طلبات تم دفعها -->

            </div>
          </div>

        </div>
      </div>
    </section>
           </main>
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