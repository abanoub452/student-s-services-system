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


    //selct data that didnot have payment code from database
    $selcet_null = "SELECT *
    FROM p63_order
    JOIN p63_student
    ON (p63_student.student_id=p63_order.student_id)
    JOIN p63_services 
    ON (p63_services.service_id=p63_order.service_id)
    WHERE payment_code IS null && order_status_id = 1
    ORDER BY p63_order.apply_date;
    ";

    $sn = mysqli_query($bis,$selcet_null);

    //count orders that didnot have payment code
    $select_count_null = "SELECT COUNT(order_id) as no_pay_code
    FROM p63_order
    where payment_code is NULL && order_status_id = 1;";

    $cn = mysqli_query($bis,$select_count_null);

    $number_cn = mysqli_fetch_assoc($cn);

    $no_of_n =$number_cn['no_pay_code'];

    
    //selct data that have payment code from database
    $selcet_not_null = "SELECT *
    FROM p63_order
    JOIN p63_student
    ON (p63_student.student_id=p63_order.student_id)
    JOIN p63_services 
    ON (p63_services.service_id=p63_order.service_id)
    WHERE payment_code IS NOT null && order_status_id = 2
    ORDER BY p63_order.apply_date;
    ";

    $snn = mysqli_query($bis,$selcet_not_null); 
    


    //count orders that have payment code
    $select_count_not_null = "SELECT COUNT(order_id) as pay_code
    FROM p63_order
    where payment_code is NOT NULL && order_status_id = 2;";

    $cnn = mysqli_query($bis,$select_count_not_null);
    $number_cnn = mysqli_fetch_assoc($cnn);
    $no_of_nn =$number_cnn['pay_code'];


    //reject order 
    if(isset($_GET['rejected']))
    {
        $id = $_GET['rejected'];
        $update_rej = "UPDATE p63_order SET order_status_id = 6 , done_by_user = $user_id, reject_order_date = now() Where order_id = $id ";
        // $delete = "DELETE from p63_order where  order_id = $id ";
        $upd = mysqli_query($bis , $update_rej);
        // testmessage($upd , "reject");
        header("location: employee.php");
    } 
    
    //update and send payment code to database
    $studentID = null;
    $serviceFees = null;
    $paymentCode = null;
    if(isset($_GET['edit']))
    {
        $id = $_GET['edit'];
        

        $Selcet = "SELECT *
        FROM p63_order
        JOIN p63_student
        ON (p63_student.student_id=p63_order.student_id)
        JOIN p63_services 
        ON (p63_services.service_id=p63_order.service_id)
        Where p63_order.order_id = $id;
        ";
        $ss = mysqli_query($bis , $Selcet);

        $data = mysqli_fetch_assoc($ss);

        $studentID = $data['student_id'];
        $serviceFees = $data['fees'];
        $paymentCode = $data['payment_code'];

        if(isset($_POST['update']))
        {
            $studentID = $_POST['studentid'];
            $serviceFees = $_POST['orderfees'];
            $paymentCode = $_POST['paymentcode'];

            $update = "UPDATE p63_order SET order_status_id = 2, done_by_user = $user_id , payment_code = '$paymentCode' , send_pay_code_date = now() Where order_id = $id ";
            $up = mysqli_query($bis , $update);

            
            // testmessage($up , "update");
            header("location: employee.php");

        }

    }
    
    
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emplyee- Applyied Service</title>
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
        <a href="employee2.php">طلبات قيد التنفيذ</a>
        <a href="employee1.php">مراجعة وصل الدفع</a>
        <a href="employee.php"class="active">الطلبات المقدمة</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>


<br>
    <h1 class="text-center display-5 " style="color:#283a5ae6;">الطلبات المقدمة</h1>
    <div class="container col-md-6 text-center">
        <div class="card">
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label>أسم الطالب</label>
                        <input type="text" name="studentid" value="<?= $studentID ?>" class="form-control" placeholder="Student ID" readonly>
                    </div>
                    <div class="form-group">
                        <label>سعر الخدمة</label>
                        <input type="number" name="orderfees" value="<?= $serviceFees ?>" class="form-control" placeholder="Service Fees" readonly>
                    </div>
                    <div class="form-group">
                        <label>كود الدفع</label>
                        <input type="number" name="paymentcode" value="<?= $paymentCode ?>" class="form-control" placeholder="Payment Code">
                    </div>
                    <button class="btn btn-info" name="update">ارسال</button>
                </form>
            </div>
        </div>
    </div>

    
    <!-- search 1 -->
    <div class="container mt-5 col-6">
        <form >
            <div class="card">
                    <input id="myInput" type="text" placeholder="Search" class="form-control">
            </div>
        </form>
    </div>
    

    <div class="container mt-5 col-10">
        <h4 class="container mt-5 text-center"style="color:#283a5ae6;">الطلبات التي لم يتم ارسال كود دفع لها</h4>
        <h6>الطلبات التي لم يتم ارسال كود دفع لها : <?= $no_of_n ?> </h6>
        <table id="myTable" class="table table-hover text-center">
            <th colspan="2">الموقف من الخدمة</th>
            <th>سعر الخدمة</th>
            <th>تاريخ التقديم</th>
            <th>موجه الى</th>
            <th>نوع الخدمة</th>
            <th>مستوى الطالب</th>
            <th>أسم الطالب</th>
            <th>كود الطالب</th>


            
            <form method="$_POST"> 
                <?php foreach($sn as $data) : ?>

                <tr>
                <td><a href="employee.php?rejected=<?=$data['order_id']?>" name="send" id="delete" class=" btn btn-danger">رفض الخدمة</a></td>
                <td><a href="employee.php?edit=<?= $data['order_id']?>" name="send" id="end"class=" btn btn-primary">ارسال كود الدفع</a></td>
                <!-- <td><input name ="payment_codee" type="text"></td> -->
                <td> <?= $data['fees']?></td>
                <td> <?= $data['apply_date']?></td>
                <!-- <td> <?= $data['notes']?></td> -->
                <td> <?= $data['addressed_to']?></td>
                <td> <?= $data['service_name']?></td>
                <!-- <td> <?= $data['gpa']?></td> -->
                <td> <?= $data['level']?></td>
                <!-- <td> <?= $data['phone']?></td> -->
                <td> <?= $data['arb_name']?></td>
                <td> <?= $data['student_id']?></td>
                </tr>

                <?php endforeach; ?>
            </form>
        </table>
    </div>

    <br>

    <!-- search 2-->
    <div class="container mt-5 col-6">
        <form >
            <div class="card">
                    <input id="myInput2" type="text" placeholder="Search" class="form-control">
            </div>
        </form>
    </div>

    <div class="container mt-5 col-11">
        <h4 class="container mt-5 text-center" style="color:#283a5ae6;">الطلبات التي  تم ارسال كود دفع لها</h4>
        <h6>الطلبات التي  تم ارسال كود دفع لها : <?= $no_of_nn ?> </h6>
        <table id="myTable2" class="table table-hover text-center">
            <th>تعديل كود دفع </th>
            <th>كود الدفع</th>
            <th>سعر الخدمة</th>
            <th>تاريخ ارسال كود الدفع</th>
            <th>تاريخ التقديم</th>
            <th>موجه الى</th>
            <th>نوع الخدمة</th>
            <th>مستوى الطالب</th>
            <th>أسم الطالب</th>
            <th>كود الطالب</th>


            <form method="$_POST"> 
                <?php foreach($snn as $data) : ?>

                <tr>
                <td><a href="employee.php?edit=<?= $data['order_id']?>" name="send" id="end"class=" btn btn-primary">تعديل  </a></td>
                <!-- <td><input name ="payment_codee" type="text"></td> -->
                <td> <?= $data['payment_code']?></td>
                <td> <?= $data['fees']?></td>
                <td> <?= $data['send_pay_code_date']?></td>
                <td> <?= $data['apply_date']?></td>
                <!-- <td> <?= $data['notes']?></td> -->
                <td> <?= $data['addressed_to']?></td>
                <td> <?= $data['service_name']?></td>
                <!-- <td> <?= $data['gpa']?></td> -->
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