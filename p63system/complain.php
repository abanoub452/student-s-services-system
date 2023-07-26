<?php
if (!isset($_SESSION)) {
  session_start();
}
// connection to database
require_once('../Connections/syscon.php');  
 
 
 if(isset($_POST['send']))
 {
     $s_id = $_SESSION['student_id'];
     $s_name = $_POST['name'];
     $complain_text = $_POST['text'];
     $type = $_POST['reason'];

    //insert image
    $img_name=time() . $_FILES['image']['name'];
    $tmp_name=$_FILES['image']['tmp_name'];
    $location='../p63images/comlpain/'.$img_name;
    move_uploaded_file($tmp_name,$location );
 
     $insert = "INSERT  INTO p63_complain VALUES(null,'$complain_text','$type',now(),$s_id ,null,'$img_name',null,null,null,null,DeFAULT)";
     $s=mysqli_query($bis,$insert);
     
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
    <link rel="stylesheet" href="../p63css/main1.css">
    <link rel="stylesheet" href="../p63assets/assets/webfonts/all.min.cs">
    <link rel="stylesheet" href="../p63assets/assets/bootstap/bootstrap.min.css">
    <title>تقديم شكوى</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {margin:0;}

.topnav {
  overflow: hidden;
  background-color: #283a5ae6;
  text-align: center;
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
  <a href="complain.php" class="active">تقديم شكوى </a>
  <a href="message.php">رسائل الكليه</a>
  <a href="service status.php">متابعه الطلب </a>
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

    <div class="register col-lg-6">
        <header>
            <h1>تقديم شكوة</h1>
        </header>
        <form method="post" enctype="multipart/form-data">
            <div class="form-row">
            <div class="form-group col-lg-6">

                <label>كود الطالب</label>
                <input name="student_id" type="number" class="form-control"  readonly placeholder="كود الطالب" value="<?php echo $_SESSION['student_id']; ?>" >
                </div>
                <div class="form-group col-lg-6">
                    <label>الاسم</label>
                    <input name="name" type="text" class="form-control" readonly placeholder="اسم الطالب" value="<?php echo $_SESSION['eng_name']; ?>"> 
                </div>
            </div>

            <div class="form-group">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">الشكوة</label>
                    <textarea required name="text" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label for="inputCity">ايصال المصاريف</label>
                    <input type="file" name="image" class="form-control" id="inputCity">
                </div>
                <div class="form-group col-lg-6">
                    <label for="inputState">السبب</label>
                    <select name="reason" id="inputState" class="form-control">
                        <option>حجب النتيجة </option>
                        <option>مشكلة في الكتب</option>
                        <option selected>اخري</option>
                    </select>
                </div>
               
            </div>
            <div class="button">
                <button name="send" type="submit">ارسال</button>
            </div>
            <br>
            
        </form>
        <div class="button_1">
            <a href="com.php"><button>متابعه الشكوى</button></a>
            </div>
    </div><br><br>
    <?php include 'footer.php';?>
    <script src="../p63assets/assets/bootstap/jquery.slim.min.js"></script>
    <script src="../p63assets/assets/bootstap/popper.min.js"></script>
    <script src="../p63assets/assets/bootstap/bootstrap.min.js"></script>>
</body>

</html>