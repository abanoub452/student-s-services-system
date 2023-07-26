<?php
    if (!isset($_SESSION)) {
    session_start();
    }
  // connection to database
  require_once('../Connections/syscon.php');  

  //test
  function testmessage( $connection , $message)
  {
    if($connection)
    {
    echo "<div class='alert alert-success col-5 mx-auto'>
    $message successfuly
    </div>";
    }
    else
    { 
        echo "<div class='alert alert-success col-5 mx-auto'>
        $message failed
        </div>";
    }

  }

    //testmessage($bis , "Connection");

    $user_id=$_SESSION['userid'];

    
    //selct data that have Receipt image from database
    $selcet_not_null = "SELECT *
    FROM p63_order
    JOIN p63_student
    ON (p63_student.student_id=p63_order.student_id)
    JOIN p63_services 
    ON (p63_services.service_id=p63_order.service_id)
    WHERE receipt_image IS NOT null && order_status_id = 3
    ORDER BY p63_order.apply_date;
    ";

    $snn = mysqli_query($bis,$selcet_not_null); 
    

    //count orders that have been accepted their receipt image and need to work on it
    $select_count_not_null = "SELECT COUNT(order_id) as on_working
    FROM p63_order
    where order_status_id = 3;";

    $cnn = mysqli_query($bis,$select_count_not_null);
    $number_cnn = mysqli_fetch_assoc($cnn);
    $no_of_nn =$number_cnn['on_working'];


    //update and send payment code to database
    $studentID = null;
    $servicetype = null;
    $orderImage = null;
    if(isset($_GET['edit']))
    {
        $id = $_GET['edit'];
        $update_rej = "UPDATE p63_order SET order_status_id = 4 , finish_order_date = now() Where order_id = $id ";
        // $delete = "DELETE from p63_order where  order_id = $id ";
        $upd = mysqli_query($bis , $update_rej);
        // testmessage($upd , "reject");
        header("location: employee2.php");
    } 

    //update image
    if(isset($_GET['upload'])){
        $id=$_GET['upload'];
        
        $select = "SELECT *
        FROM p63_order
        JOIN p63_student
        ON (p63_student.student_id=p63_order.student_id)
        JOIN p63_services 
        ON (p63_services.service_id=p63_order.service_id)
        JOIN p63_order_statuses
        ON (p63_order_statuses.order_status_id=p63_order.order_status_id)
        WHERE p63_order.order_id= $id
        ORDER BY p63_order.apply_date;";
        $s=mysqli_query($bis,$select);
        $row=mysqli_fetch_assoc($s);

        $studentID = $row['student_id'];
        $servicetype = $row['service_name'];
        $orderImage = $row['scan_order_img'];
    
    
    //upload image
    if(isset($_POST['update'])){
        
        // img code
        if(!empty( $_FILES['image']['name'])){
            $img_name=time() . $_FILES['image']['name'];
            $tmp_name=$_FILES['image']['tmp_name'];
            $location='../p63images/services/'.$img_name;  
            move_uploaded_file($tmp_name,$location);
            $imgname=$row['scan_order_img'];
            unlink("./../p63images/services/$imgname");
        
        }
        else{
            $img_name=$row['scan_order_img'];
        }
        
            $update=" UPDATE `p63_order` SET order_status_id = 4,finish_order_date = now(),`scan_order_img`='$img_name'WHERE order_id= $id ";
            $u=mysqli_query($bis,$update);
            header("location: employee2.php");
        }
        };
        


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emplyee- check the bill</title>
    <link rel="stylesheet" href="../p63css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../p63css/styleee.css">

</head>
<body>

<?php include 'admin-header.php';?>

    <!-- navbar -->
    <div class="topnav text-center" id="myTopnav">
        <a href="employee4.php">طلبات تم استلامها</a>
        <a href="employee3.php">طلبات تم الانتهاء منها</a>
        <a href="employee2.php"class="active">طلبات قيد التنفيذ</a>
        <a href="employee1.php">مراجعة وصل الدفع</a>
        <a href="employee.php">الطلبات المقدمة</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>



    <br>
    <h1 class="text-center display-5"style="color:#283a5ae6;">طلبات قيد التنفيذ</h1>
    <div class="container col-md-6 text-center">
        <div class="card">
            <div class="card-body">
                <form method="post"  enctype="multipart/form-data">
                    <div class="form-group">
                        <label>كود الطالب</label>
                        <input type="text" name="studentid" value="<?= $studentID ?>" class="form-control" placeholder="كود الطالب" readonly>
                    </div>
                    <div class="form-group">
                        <label>نوع الخدمة</label>
                        <input type="text" name="orderfees" value="<?= $servicetype?>" class="form-control" placeholder="نوع الخدمة" readonly>
                    </div>
                    <div class="form-group">
                        <label>صورة الخدمة</label>
                        <input type="file" name="image" class="form-control" placeholder="image.jpg"></td>
                        <!-- <input type="number" name="paymentcode" value="<?= $paymentCode ?>"  -->
                    </div>
                    <button class="btn btn-info" name="update">أرسال</button>
                </form>
            </div>
        </div>
    </div>

    
    <!-- search  -->
    <div class="container mt-5 col-6">
            <form >
                <div class="card">
                        <input id="myInput" type="text" placeholder="Search" class="form-control">
                </div>
            </form>
    </div>
    
    <!-- orders that have a receipt image -->
    <div class="container mt-5 col-11">
        <h4 class="container mt-5 text-center"style="color:#283a5ae6;">الطلبات الي يجب تنفيذها</h4>
        <br><br>
        <h6>عدد الطلبات الي يجب تنفيذها : <?= $no_of_nn ?> </h6>
        <table id="myTable" class="table table-hover text-center">
            <th>تم الانتهاء من الخدمة</th>
            <th>ارسال صورة الخدمة</th>
            <th>اريد نسخه الكترونيه</th>
            <th>تاريخ مراجعه الايصال</th>
            <th>تاريخ الدفع</th>
            <th>ملاحظات</th>
            <th>موجه الى</th>
            <th>نوع الخدمة</th>
            <th>المعدل التراكمي</th>
            <th>مستوى الطالب</th>
            <th>أسم الطالب</th>
            <th>كود الطالب</th>


            <form method="post" enctype="multipart/form-data"> 
                <?php foreach($snn as $data) : ?>

                <tr>
                <td><a href="employee2.php?edit=<?= $data['order_id']?>" name="send" id="end"class=" btn btn-primary">تم الانتهاء</a></td>
                <td><a href="employee2.php?upload=<?= $data['order_id']?>" name="upload" id="end"class=" btn btn-primary">رفع الصورة</a></td>
                
                


                <!-- <td><input name ="payment_codee" type="text"></td> -->
                <!-- <td><img width="200" class="mt-2" src="upload/<?= $data['receipt_image']?>" alt=""></td> -->
                <!-- <td> <?= $data['payment_code']?></td> -->
                <!-- <td> <?= $data['fees']?></td> -->
                <td> <?= $data['soft_copy']?></td>
                <td> <?= $data['check_receipt_date']?></td>
                <td> <?= $data['payment_date']?></td>
                <td> <?= $data['notes']?></td>
                <td> <?= $data['addressed_to']?></td>
                <td> <?= $data['service_name']?></td>
                <td> <?= $data['gpa']?></td>
                <td> <?= $data['level']?></td>
                <!-- <td> <?= $data['phone']?></td> -->
                <td> <?= $data['arb_name']?></td>
                <td> <?= $data['student_id']?></td>
                </tr>

                <?php endforeach; ?>
            </form>
        </table>
    </div>
    

    <?php include 'footer.php';?>
    

    <script>
    /* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
        function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
        }
    </script>
    <script src="../p63assets/js/jquery-3.6.4.min.js"></script>
    <script src="../p63assets//jquery.slim.min.js"></script>
    <script src="../p63assets/js/main.js"></script>
    <script src="../p63assets/js/search.js"></script>
    <script src="../p63assets/bootstap/popper.min.js"></script>
    <script src="../p63assets/bootstap/bootstrap.min.js" ></script>
</body>
</html>