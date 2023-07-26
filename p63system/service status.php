<?php
if (!isset($_SESSION)) {
    session_start();
    }
  // connection to database
  require_once('../Connections/syscon.php');  

  //action message
function testmessage( $condation , $message)
{
  if($condation)
  {
  echo "<div text-align: center class='alert alert-danger col-5 mx-auto'>
  $message 
  </div>";
  }
  
}

  
  // check file type
function validimgtype($imginput){
  if($imginput=="image/jpeg"||$imginput=="image/jpg"||$imginput=="image/png"||$imginput=="image/jif")
  return false;
  // لو الحاجات دي تمام اخرج
  else{
      return true;
  }
}


//to retrive data from database
$ss= $_SESSION['student_id'] ;
$select = "SELECT *
FROM p63_order
JOIN p63_student
ON (p63_student.student_id=p63_order.student_id)
JOIN p63_services 
ON (p63_services.service_id=p63_order.service_id)
JOIN p63_order_statuses
ON (p63_order_statuses.order_status_id=p63_order.order_status_id)
WHERE p63_student.student_id = $ss 
ORDER BY p63_order.apply_date DESC;";

$s = mysqli_query($bis,$select); 

//update image
if(isset($_GET['update'])){
    $id=$_GET['update'];
    
    $select = "SELECT *
    FROM p63_order
    JOIN p63_student
    ON (p63_student.student_id=p63_order.student_id)
    JOIN p63_services 
    ON (p63_services.service_id=p63_order.service_id)
    JOIN p63_order_statuses
    ON (p63_order_statuses.order_status_id=p63_order.order_status_id)
    WHERE p63_student.student_id = $ss && order_id= $id
    ORDER BY p63_order.apply_date;";
    $s=mysqli_query($bis,$select);
    $row=mysqli_fetch_assoc($s);


    if($row['order_status_id']=7)
    {
      //upload image
    if(isset($_POST['edit'])){
        
      // img code
      if(!empty( $_FILES['image']['name'])){
          $img_name=time() . $_FILES['image']['name'];
          $tmp_name=$_FILES['image']['tmp_name'];
          $location='../p63images/services/'.$img_name;
          move_uploaded_file($tmp_name,$location );
          $imgname=$row['receipt_image'];
          unlink("../p63images/services/$imgname");
      
      }
      else{
          $img_name=$row['receipt_image'];
      }
      
          $update=" UPDATE `p63_order` SET `receipt_image`='$img_name',order_status_id =2, payment_date = now() WHERE order_id= $id ";
          $u=mysqli_query($bis,$update);
          header("location: service status.php");
      }

    }
    
    if($row['order_status_id']=2)
    {
      //upload image
      $error= null;
    if(isset($_POST['edit'])){
        
      // img code
      if(!empty( $_FILES['image']['name'])){
          $img_name=time() . $_FILES['image']['name'];
          $tmp_name=$_FILES['image']['tmp_name'];
          $location='../p63images/services/'.$img_name;


          $imgtype=$_FILES['img']['type'];

          if(validimgtype($imgtype)){
            $errors="img must be jbg,jpeg,png,jif";

            if(empty($errors)){
              move_uploaded_file($tmp_name,$location );
              $imgname=$row['receipt_image'];
              unlink("../p63images/services/$imgname");
              
            }
            else{
              testmessage(!empty($errors), $errors);
    
            }
        }
        
        
        
      }
      else{
        $img_name=$row['receipt_image'];
      }

      $update=" UPDATE `p63_order` SET `receipt_image`='$img_name', payment_date = now() WHERE order_id= $id ";
      $u=mysqli_query($bis,$update);
      header("location: service status.php");
           
      }
      
      
          
      }
    }

    
    
  




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
    <title>متابعة حالة الطلب</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {margin:0;}

.topnav {
  overflow: hidden;
  background-color: #283a5ae6;
  text-align: center;
  /* position: absolute; */
    /* position: fixed; */
    /* position: sticky; */
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
  <a href="com.php" > متابعه الشكوى</a>
  <a href="complain.php" >تقديم شكوى </a>
  <a href="message.php">رسائل الكليه</a>
  <a href="service status.php" class="active">متابعه الطلب </a>
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
        <h1 >حالة الطلب</h1>
        </header>
        <form method="post" enctype="multipart/form-data">


        <?php foreach($s as $data): ?> 
        <table class="table  col-md-6 table-striped student-table ">
            <thead>
                
                <tr>
                    <th class="text" scope="col"><?= $data['student_id']?></th>
                    <th class="text" scope="col"  id="head">كود الطالب</th>
    
                    <th class="text" scope="col" ><?= $data['arb_name']?></th>
    
                    <th class="text" scope="col"  id="head" >الاسم</th>
    
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2"> <?= $data['service_name']?> </td>
                    <td colspan="2" id="head">نوع الطلب</td>
    
    
                </tr>
                <tr>
                    <td colspan="2"><?= $data['apply_date']?></td>
                    <td colspan="2" id="head">تاريخ التقديم</td>
    
                </tr>
                <tr>
                    <td colspan="2"><?= $data['fees']?></td>
                    <td colspan="2" id="head">السعر</td>
    
                </tr>
                <tr>
                    <td colspan="2"><?= $data['payment_code']?></td>
                    <td colspan="2" id="head">كود الدفع</td>
    
                </tr>
                <tr>
                    <img src="" alt="">
                    <td colspan="2" ><form method="post">
                    <a href="service status.php?update=<?=$data['order_id']?>"> <input type="file" name="image" class="form-control"></a><br><button name="edit" type="submit">ارسال</button> </td>
                    </form> 
                    <td colspan="2" id="head">رفع الايصال</td>
    
                </tr>
                 
                <?php
                    if($data['order_status_id']==2 or $data['order_status_id']==7)
                    {?>
                <tr>
                    <td colspan="2"><img width="200" class="mt-2" src="../p63images/services/<?= $data['receipt_image']?>" alt="">
                    <br>
                    <a href="service status.php?update=<?=$data['order_id']?>" name="update" id="end"class=" btn btn-primary"> update image </a></td>
                    <td colspan="2"  id="head">الايصال</td>
                    
                </tr>
                <?php
                    }

                    ?>


                <?php
                    if($data['order_status_id']==1 or $data['order_status_id']==3 or $data['order_status_id']==4 or $data['order_status_id']==5 or $data['order_status_id']==6)
                    {?>
                <tr>
                    <td colspan="2"><img width="200" class="mt-2" src="../p63images/services/<?= $data['receipt_image']?>" alt="">
                    <td colspan="2"  id="head">الايصال</td>
                    
                </tr>
                <?php
                    }

                    ?>

                <tr>
                    <td colspan="2"><img width="200" class="mt-2" src="../p63images/services/<?= $data['scan_order_img']?>" alt="">
                    <br>
                    <td colspan="2"  id="head">صورة الطلب</td>
                    
                </tr>
                <tr>
                    <td colspan="2"><?= $data['order_status']?></td>
                    <td colspan="2" id="head">الحالة</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2" ></td>
                </tr>
               
                <?php endforeach; ?>
            </tfoot>
        </table>
        
        </form>
        
    

   
    </div> 
 

    <?php include 'footer.php';?>


    <script src="../p63assets/assets/bootstap/jquery.slim.min.js"></script>
    <script src="../p63assets/assets/bootstap/popper.min.js"></script>
    <script src="../p63assets/assets/bootstap/bootstrap.min.js"></script>

    <script src="../p63assets/app.js"></script>

</body>

</html>