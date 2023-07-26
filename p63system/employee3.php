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
    WHERE receipt_image IS NOT null && order_status_id = 4
    ORDER BY p63_order.apply_date;
    ";

    $snn = mysqli_query($bis,$selcet_not_null); 
    

    //count orders that have been accepted their receipt image and need to work on it
    $select_count_not_null = "SELECT COUNT(order_id) as on_working
    FROM p63_order
    where order_status_id = 4;";

    $cnn = mysqli_query($bis,$select_count_not_null);
    $number_cnn = mysqli_fetch_assoc($cnn);
    $no_of_nn =$number_cnn['on_working'];



    
    //update and send payment code to database
    if(isset($_GET['edit']))
    {
        $id = $_GET['edit'];
        $update_rej = "UPDATE p63_order SET order_status_id = 5 , done_by_user = $user_id , receive_order_date = now() Where order_id = $id ";
        // $delete = "DELETE from p63_order where  order_id = $id ";
        $upd = mysqli_query($bis , $update_rej);
        // testmessage($upd , "reject");
        header("location: employee3.php");
    } 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emplyee- finished services</title>
    <link rel="stylesheet" href="../p63css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../p63css/styleee.css">

</head>
<body>
<?php include 'admin-header.php';?>


    <!-- navbar -->
    <div class="topnav text-center" id="myTopnav">
        <a href="employee4.php">طلبات تم استلامها</a>
        <a href="employee3.php"class="active">طلبات تم الانتهاء منها</a>
        <a href="employee2.php">طلبات قيد التنفيذ</a>
        <a href="employee1.php">مراجعة وصل الدفع</a>
        <a href="employee.php">الطلبات المقدمة</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>



    <br>
    <h1 class="text-center display-5"style="color:#283a5ae6;">طلبات تم الانتهاء منها</h1>

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
        <br><br>
        <h6>عدد الطلبات التي تم الانتهاء منها : <?= $no_of_nn ?> </h6>
        <table id="myTable" class="table table-hover text-center">
        <th>رفع او تعديل صورة الخدمة</th>
            <th>تم استلام الخدمة</th>
            <th>تاريخ الانتهاء</th>
            <th>تاريخ الدفع</th>
            <th>تاريخ التقديم</th>
            <th>صورة الخدمة</th>
            <!-- <th>ملاحظات</th> -->
            <th>موجه الى</th>
            <th>نوع الخدمة</th>
            <th>مستوى الطالب</th>
            <th>أسم الطالب</th>
            <th>كود الطالب</th>
            


            <form method="$_POST" enctype="multipart/form-data"> 
                <?php foreach($snn as $data) : ?>

                <tr>
                <td><a href="employee2.php?upload=<?= $data['order_id']?>" name="upload" id="end"class=" btn btn-primary">رفع الصورة</a></td>

                <td><a href="employee3.php?edit=<?= $data['order_id']?>" name="send" id="end"class=" btn btn-primary">تم الاستلام</a></td>
                <!-- <td><input name ="payment_codee" type="text"></td> -->
                <!-- <td> <?= $data['payment_code']?></td> -->
                <!-- <td> <?= $data['fees']?></td> -->
                <td> <?= $data['finish_order_date']?></td>
                <td> <?= $data['payment_date']?></td>
                <td> <?= $data['apply_date']?></td>
                <!-- retreive image -->
                <?php
                    if(empty($data['scan_order_img']))
                    {
                        ?>
                        <td>لا توجد صورة</td>
                        </div>

                    <?php    
                    }
                    else
                    {
                        ?>
                        <td class="gallery"><a class="image" href="../p63images/services/<?= $data['scan_order_img']?>"><img  width="200" class="mt-2" src="../p63images/services/<?= $data['scan_order_img']?>" alt=""></a></td>
                        <script>
                            $(".gallery").magnificPopup({
                                delegate: 'a',
                                type: 'image',
                                gallery:{
                                    enabled: true
                                }
                            });
                        </script>
                    <?php
                    }
                    ?>
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