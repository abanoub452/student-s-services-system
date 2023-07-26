<?php
 if (!isset($_SESSION)) {
  session_start();
}
// connection to database
require_once('../Connections/syscon.php');  

  

//count orders that compelete
 $select_count_null = "SELECT COUNT(order_id) as order_id
    FROM p63_order
    where order_status_id = 5;";

    $cn = mysqli_query($bis,$select_count_null);

    $number_cn = mysqli_fetch_assoc($cn);

    $no_of_n =$number_cn['order_id'];
//count All students in facullty
    $select_count = "SELECT COUNT(student_id) as student_id
    FROM p63_student
    ";

    $ss = mysqli_query($bis,$select_count);

    $number_ss = mysqli_fetch_assoc($ss);

    $no_of_s =$number_ss['student_id'];
 //>>>>>>>>>>>>>>>>>>>>test<<<<<<<<<<<<<<<<<<
 $selcet_sum = "SELECT SUM(fees) as fees
    FROM p63_services
    JOIN p63_order
    ON (p63_order.service_id=p63_services.service_id)
    WHERE order_status_id = 5 or 4 or 5;
    ";
     $sum = mysqli_query($bis,$selcet_sum);

     $number_sum = mysqli_fetch_assoc($sum);
 
     $no_of_sum =$number_sum['fees'];

//>>>>>>>>>>>>>>>>service sold table<<<<<<<<<<<<<<<<<
$selcet="SELECT p63_services.service_name,p63_services.fees, 
COUNT(p63_order.service_id) AS sold  , 
SUM(p63_services.fees) AS Revenue
FROM p63_services
INNER JOIN p63_order 
ON p63_order.service_id = p63_services.service_id
JOIN p63_order_statuses
ON (p63_order_statuses.order_status_id=p63_order.order_status_id)
WHERE p63_order.order_status_id= 5 or 4 or 5
GROUP BY p63_services.service_name,p63_services.fees;
";
 $ss = mysqli_query($bis , $selcet);
 //>>>>>>>>>>>>>>user test<<<<<<<<<<<<<
$selcet="SELECT users.user_ar_name, p63_services.service_name, COUNT(*) AS count 
FROM users 
INNER JOIN p63_order 
ON p63_order.done_by_user = users.user_id 
JOIN p63_services
ON p63_services.service_id=p63_order.service_id
GROUP BY users.user_ar_name,p63_services.service_name;
";
 $u = mysqli_query($bis , $selcet);
 //>>>>>>>>>>>>>>>>>>>complain compair<<<<<<<<<<<<<<<<<<<<<
 $selcet_compair="SELECT 
 YEAR(p63_complain.complain_date) AS year,
 COUNT(*) AS num_complaints
FROM 
 p63_complain
WHERE 
 YEAR(p63_complain.complain_date) IN (YEAR(CURRENT_DATE()), YEAR(CURRENT_DATE()) - 1)
GROUP BY 
 YEAR(p63_complain.complain_date)
";
 $com = mysqli_query($bis , $selcet_compair);

//>>>>>>>>>>>>>>>trafic<<<<<<<<<<<<<<
//count 2sbat el ked  (1)
  $select1 ="SELECT COUNT(service_id) as count1 
  FROM p63_order 
  WHERE service_id = 1;";

  $s1 = mysqli_query($bis,$select1);
  $number_s1 = mysqli_fetch_assoc($s1);
  $no_of_s1 =$number_s1['count1'];

  //count 4ehadt el ta5arog  (2)
  $select2 ="SELECT COUNT(service_id) as count2
  FROM p63_order 
  WHERE service_id = 2;";

  $s2 = mysqli_query($bis,$select2);
  $number_s2 = mysqli_fetch_assoc($s2);
  $no_of_s2 =$number_s2['count2'];

  //count 2sbat el ked in ENG (3)
  $select3 ="SELECT COUNT(service_id) as count3 
  FROM p63_order 
  WHERE service_id = 3;";

  $s3 = mysqli_query($bis,$select3);
  $number_s3 = mysqli_fetch_assoc($s3);
  $no_of_s3 =$number_s3['count3'];

  //count bayan daragat  (4)
  $select4 ="SELECT COUNT(service_id) as count4 
  FROM p63_order 
  WHERE service_id = 4;";

  $s4 = mysqli_query($bis,$select4);
  $number_s4 = mysqli_fetch_assoc($s4);
  $no_of_s4 =$number_s4['count4'];

  //count bayan daragat in ENG (5)
  $select5 ="SELECT COUNT(service_id) as count5 
  FROM p63_order 
  WHERE service_id = 5;";

  $s5 = mysqli_query($bis,$select5);
  $number_s5 = mysqli_fetch_assoc($s5);
  $no_of_s5 =$number_s5['count5'];

  //count 2fadh drash in ENG (6)
  $select6 ="SELECT COUNT(service_id) as count6 
  FROM p63_order 
  WHERE service_id = 6;";

  $s6 = mysqli_query($bis,$select6);
  $number_s6 = mysqli_fetch_assoc($s6);
  $no_of_s6 =$number_s6['count6'];

  //count complain no respond
  $select7 ="SELECT COUNT(*) as count7 
  FROM p63_complain
  WHERE p63_complain.complain_respond is null;
  ";

  $s7 = mysqli_query($bis,$select7);
  $number_s7 = mysqli_fetch_assoc($s7);
  $no_of_s7 =$number_s7 ['count7'];
  // complain responded 
  $select8 ="SELECT COUNT(*) as count8 
  FROM p63_complain
  WHERE p63_complain.complain_respond is not null;
  ";
  $s8 = mysqli_query($bis,$select8);
  $number_s8 = mysqli_fetch_assoc($s8);
  $no_of_s8 =$number_s8['count8'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_SESSION['app_name']; ?></title>

  <title>admin dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../p63assets/assets/img/favicon.png" rel="icon">
  <link href="../p63assets/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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
<body>
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
          <i class="bi bi-layout-text-window-reverse"></i><span>جداول البيانات </span><i class="bi bi-chevron-down ms-auto"></i>
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

<div class="pagetitle">
  <h1>لوحة القيادة</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item active">لوحة القيادة</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">
<!-- Left side columns -->
<div class="col-lg-8">
      <div class="row">

        <!-- Sales Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">المبيعات</h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-cart"></i>
                </div>
                <div class="ps-3">
                  <h6><?= $no_of_n ?></h6>
                </div>
              </div>
            </div>

          </div>
        </div><!-- End Sales Card -->
        <!-- Revenue Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card revenue-card">


            <div class="card-body">
              <h5 class="card-title">الارباح </h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-currency-dollar"></i>
                </div>
                <div class="ps-3">
                  <h6><?= $no_of_sum ?></h6>

                </div>
              </div>
            </div>

          </div>
        </div><!-- End Revenue Card -->

        <!-- Customers Card -->
        <div class="col-xxl-4 col-xl-12">

          <div class="card info-card customers-card">

            
            <div class="card-body">
              <h5 class="card-title">عدد الطلاب فى الكليه</h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                  <h6><?= $no_of_s ?></h6>

                </div>
              </div>

            </div>
          </div>

        </div>
 <!-- complain Card -->
 <div class="col-xxl-4 col-md-6">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">الشكاوى</h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                  <h6><?= $no_of_s7 ?></h6>
                </div>
              </div>
            </div>

          </div>
        </div><!-- End complain Card -->
        <!-- complain responded Card -->
 <div class="col-xxl-4 col-md-6">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">الرد على الشكاوى</h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                  <h6><?= $no_of_s8 ?></h6>
                </div>
              </div>
            </div>

          </div>
        </div><!-- End complain responded Card -->


            <!-- Top Selling -->
            <div class="col-12">
              <div class="card top-selling overflow-auto">
                <div class="card-body pb-0">
                  <h5 class="card-title">اعلى المبيعات</h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">الارباح</th>
                        <th scope="col">عدد المبيعات</th>
                        <th scope="col">سعر الخدمه</th>
                        <th scope="col">الخدمه</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($ss as $data):?>  
                      <tr>                      
                        <td><a href="#" class="text-primary fw-bold"><?=$data['Revenue']?></a></td>
                        <td><?=$data['sold']?></td>
                        <td class="fw-bold"><?=$data['fees']?></td>
                        <td><?=$data['service_name']?></td>
                      </tr>
                      <?php endforeach;?>
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Top Selling -->
            <!-- compare count complain between two year -->
             <!-- Top Selling -->
             <div class="col-12">
              <div class="card top-selling overflow-auto">
                <div class="card-body pb-0">
                  <h5 class="card-title">عدد الشكاوى للسنه الحاليه و السنه السابقه</h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">عدد الشكاوى التى قدمت هذه السنه</th>
                        <th scope="col">السنه</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($com as $data):?>  
                      <tr>                      
                        <td class="fw-bold"><?=$data['num_complaints']?></td>
                        <td><?=$data['year']?></td>
                      </tr>
                      <?php endforeach;?>
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- compare count complain between two year -->
            <!-- >>>>>>>>>>>>>>>>>>user table<<<<<<<<<<<<<<<<<<<< -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">الموظفين</h5>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                  <tr>
                    <th scope="col"> العدد الخدمات الذى قام بانهائها</th>
                    <th scope="col"> نوع الخدمه</th>
                    <th scope="col">اسم الموظف</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($u as $data):?>               
                  <tr>
                    <td><?=$data['count']?></td>
                    <td><?=$data['service_name']?></td>
                    <th scope="row"><?=$data['user_ar_name']?></th>
                <?php endforeach;?>
                  </tr>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>


          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

           <!-- start Website Traffic -->
        <div class="card">
            

            <div class="card-body pb-0">
              <h5  class="card-title">الخدمات </h5>

              <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  echarts.init(document.querySelector("#trafficChart")).setOption({
                    tooltip: {
                      trigger: 'item'
                    },
                    legend: {
                      top: '5%',
                      left: 'center'
                    },
                    series: [{
                      top: '15%',
                      name: 'Access From',
                      type: 'pie',
                      radius: ['40%', '70%'],
                      avoidLabelOverlap: false,
                      label: {
                        show: false,
                        position: 'center'
                        
                      },
                      emphasis: {
                        label: {
                          show: true,
                          fontSize: '18',
                          fontWeight: 'bold'
                        }
                      },
                      labelLine: {
                        show: false
                      },
                      data: [{
                          value: <?=$no_of_s1?>,
                          name: 'اثبات قيد'
                        },
                        {
                          value: <?=$no_of_s2?>,
                          name: 'شهاده تخرج'
                        },
                        {
                          value: <?=$no_of_s3?>,
                          name: 'اثبات قيد باللغه الانجليزيه'
                        },
                        {
                          value: <?=$no_of_s4?>,
                          name: 'بيان درجات'
                        },
                        {
                          value: <?=$no_of_s5?>,
                          name: 'بيان درجات باللغه الانجليزيه'
                        },
                        {
                          value: <?=$no_of_s6?>,
                          name: 'افاده دراسه باللغه الانجليزيه'
                        }
                      ]
                    }]
                  });
                });
              </script>

            </div>
          </div>
          <!-- End Website Traffic -->
          

        </div><!-- End Right side columns -->

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