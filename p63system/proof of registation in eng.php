<?php
if (!isset($_SESSION)) {
  session_start();
}
// connection to database
require_once('../Connections/syscon.php');  

// sucssessful message 
function testmessage( $condation , $message)
  {
    if($condation)
    {
    echo "<div class='alert alert-success col-5 mx-auto'>
    $message سوف يتم ارسالك لصفحه متابعه الطلب
    </div>";
    }
    else
    { 
        echo "<div class='alert alert-success col-5 mx-auto'>
        $message failed
        </div>";
    }

  }
mysqli_select_db($bis,$database_bis);
$query_appata = "SELECT service_id FROM `p63_services` WHERE service_name='اثبات قيد باللغه الانجليزيه'";
$appata = mysqli_query($bis,$query_appata) or die(mysqli_error($bis));
$row_appata = mysqli_fetch_assoc($appata);

$_SESSION['service_id'] = $row_appata['service_id'];


if(isset($_POST['send']))
{
    $s_id = $_SESSION['student_id'];
    $s_name = $_POST['name'];
    $s_add = $_POST['addressed'];
    $s_phone = $_SESSION['phone'];  
    $s_note = $_POST['note'];
    $s_s_id = $_SESSION['service_id'];
    $soft=$_POST['soft_copy'];

    $insert = "INSERT INTO `p63_order` VALUES( NULL , NULL ,NULL ,NULL ,'$s_add' , '$s_note',$s_id, now(), NULL,NULL,NULL,NULL,NULL,NULL,NULL,$s_s_id,order_status_id,NULL,'$soft',NULL)";
    $i = mysqli_query($bis , $insert);
    // $insert = "INSERT INTO `p63_student` VALUES( NULL , NULL ,NULL ,NULL ,NULL ,NULL ,'$s_add'  , '$s_note' )";
    // $i = mysqli_query($bis , $insert);
   // echo $s_id , $s_name;
   testmessage($i , "تم الارسال بنجاح");

   //redresh the go to complains page to answer the rest of the complains 
    header('Refresh: 3; url=service status.php');
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../p63assets/assets/bootstap/bootstrap.min.css">
    <link rel="stylesheet" href="../p63css/webfonts/all.min.css">
    <link rel="stylesheet" href="../p63css/form.css">
    <title>اثبات قيد باللغه الانجليزيه</title>
</head>

<body>

    <div class="register col-lg-6">
        <header>
            <h1 >اثبات قيد باللغه الانجليزيه<i class="fa-regular fa-id-card"></i></h1>
        </header>
        <form method="post">
            <div class="form-row">
                <div class="col">
                    <label>كود الطالب</label>
                    <input name="id" type="number" readonly class="form-control" placeholder="كود الطالب" value="<?php echo $_SESSION['student_id']; ?>">
                </div>
                <div class="col">
                    <label>الاسم</label>
                    <input name="name" type="text" readonly class="form-control" placeholder="اسم الطالب" value="<?php echo $_SESSION['eng_name']; ?>">
                </div>

            </div>
            <div class="form-row">
                <div class="col">
                    <label>موجه الي</label>
                    <input name="addressed" type="text" class="form-control" required placeholder="موجه الى">
                </div>
                <div class="col">
                    <label>الهاتف</label>
                    <input name="phone" type="number"  class="form-control" required placeholder="رقم الهاتف" value="<?php echo $_SESSION['phone'];   ?>">
                </div> 
            </div>
            <p>هل تريد نسخه الكترونيه ؟</p>
            <label>لا</label>
            <input type="radio" checked id="vehicle2" name="soft_copy" value="لا"><br>
            <label>نعم</label>
            <input type="radio" id="vehicle2" name="soft_copy" value="نعم">
            
            <div class="form-row">
                <div class="col">   
                    <div class="form-group"> 
                         <div class="form-group"> 
                            <label for="exampleFormControlTextarea1">ملاحظات</label>
                            <input type="text" name="note" class="form-control" id="exampleFormControlTextarea1" rows="3"></input>
                        </div>
                    </div>
                </div>

            </div>
            
            <div class="button">
                <button name="send">ارسال</button>

            </div>
            
        </form>
    </div>





    <script src="../p63assets/assets/bootstap/jquery.slim.min.js"></script>
    <script src="../p63assets/assets/bootstap/popper.min.js"></script>
    <script src="../p63assets/assets/bootstap/bootstrap.min.js"></script>
</body>

</html>