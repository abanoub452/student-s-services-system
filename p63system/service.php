<?php
 if (!isset($_SESSION)) {
  session_start();
}
// connection to database
require_once('../Connections/syscon.php');  


//select fees 1
 $select_1= "SELECT fees from p63_services 
 WHERE p63_services.service_id=1;
 ";
$s1 = mysqli_query($bis,$select_1);
//select fees 2
$select_2= "SELECT fees from p63_services 
WHERE p63_services.service_id=2;
";
$s2 = mysqli_query($bis,$select_2);
//select fees 3
$select_3= "SELECT fees from p63_services 
WHERE p63_services.service_id=3;
";
$s3 = mysqli_query($bis,$select_3);
//select fees 4
$select_4= "SELECT fees from p63_services 
WHERE p63_services.service_id=4;
";
$s4 = mysqli_query($bis,$select_4);
//select fees 5
$select_5= "SELECT fees from p63_services 
WHERE p63_services.service_id=5;
";
$s5 = mysqli_query($bis,$select_5);
//select fees 6
$select_6= "SELECT fees from p63_services 
WHERE p63_services.service_id=6;
";
$s6 = mysqli_query($bis,$select_6);
//select fees 7
$select_7= "SELECT fees from p63_services 
WHERE p63_services.service_id=7;
";
$s7 = mysqli_query($bis,$select_7);
//select fees 8
$select_8= "SELECT fees from p63_services 
WHERE p63_services.service_id=8;
";
$s8 = mysqli_query($bis,$select_8);
//select fees 9
$select_9= "SELECT fees from p63_services 
WHERE p63_services.service_id=9;
";
$s9 = mysqli_query($bis,$select_9);

    ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../p63assets/assets/webfonts/all.min.css">
    <link rel="stylesheet" href="../p63assets/assets/bootstap/bootstrap.min.css">
    <link rel="stylesheet" href="../p63css/main1.css">
    <title>Service show</title>

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

/* .dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 17px;    
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: center;
} */

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
  <a href="com.php"> متابعه الشكوى</a>
  <a href="complain.php" >تقديم شكوى </a>
  <a href="message.php">رسائل الكليه</a>
  <a href="service status.php">متابعه الطلب </a>
  <a href="service.php" class="active">الخدمات</a>

  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div>


    <div class="service">
        <div class="header" style="display:flex;">
            <i class="fa-solid fa-clipboard"></i><h1>services</h1>
        </div>
        <div class="container-fluid">
            <div class="row">

            <!-- اثبات قيد -->
            
                <div class="ser col-lg-5">
                    <div class="info">
                        <div class="text">
                            <h1>اثبات قيد</h1>
                        </div>

                        <div class="icon">
                            <i class="fa-solid fa-file-lines"></i>
                        </div>
                    </div><br>
                    <div class="price">
                        <?php foreach($s1 as $data):?>
                          <p><?=$data['fees']?><span>EGP</span> </p>
                        <?php endforeach;?>
                        <?php
                    if($_SESSION['level']==1 or $_SESSION['level']==2 or $_SESSION['level']==3 or $_SESSION['level']==4)
                    {
                    ?>
                                <a href="proof of registation.php"><button>detail</button></a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    
                    <?php
                    if($_SESSION['level']==5)
                    {
                        ?>
                                    <a href="proof of registation.php"><button disabled>detail</button></a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

            <!-- اثبات قيد باللغه الانجليزيه          -->
                <div class="ser col-lg-5">
                    <div class="info">
                        <div class="text">
                            <h1>اثبات قيد باللغه الانجليزيه</h1>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-file-lines"></i>
                        </div>
                    </div><br>
                    <div class="price">
                    <?php foreach($s3 as $data):?>
                          <p><?=$data['fees']?><span>EGP</span> </p>
                          <?php endforeach;?>
                        <?php
                    if($_SESSION['level']==1 or $_SESSION['level']==2 or $_SESSION['level']==3 or $_SESSION['level']==4)
                    {
                    ?>
                                <a href="proof of registation in eng.php"><button>detail</button></a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    
                    <?php
                    if($_SESSION['level']==5)
                    {
                        ?>
                                    <a href="proof of registation in eng.php"><button disabled>detail</button></a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                
            <!-- بيان حالة -->
                <div class="ser col-lg-5">
                    <div class="info">
                        <div class="text">
                            <h1>بيان حاله</h1>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-file-lines"></i>
                        </div>
                    </div><br>
                    <div class="price">
                    <?php foreach($s7 as $data):?>
                          <p><?=$data['fees']?><span>EGP</span> </p>
                          <?php endforeach;?>
                        <?php
                    if($_SESSION['level']==1 or $_SESSION['level']==2 or $_SESSION['level']==3 or $_SESSION['level']==4)
                    {
                    ?>
                                <a href="Statement case.php"><button>detail</button></a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    
                    <?php
                    if($_SESSION['level']==5)
                    {
                        ?>
                                    <a href="Statement case.php"><button disabled>detail</button></a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

            <!-- بيان درجات -->
            
                <div class="ser col-lg-5">
                    <div class="info">
                        <div class="text">
                            <h1>بيان درجات</h1>
                        </div>

                        <div class="icon">
                        <i class="fa-sharp fa-solid fa-envelope-open-text"></i>                       </div>
                    </div><br>
                    <div class="price">
                    <?php foreach($s4 as $data):?>
                          <p><?=$data['fees']?><span>EGP</span> </p>
                          <?php endforeach;?>
                        <?php
                    if($_SESSION['level']==1 or $_SESSION['level']==2 or $_SESSION['level']==3 or $_SESSION['level']==4)
                    {
                    ?>
                                <a href="Grade statement.php"><button>detail</button></a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    
                    <?php
                    if($_SESSION['level']==5)
                    {
                        ?>
                                    <a href="Grade statement.php"><button disabled>detail</button></a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

            <!-- بيان درجات باللغه الانجليزيه -->
                <div class="ser col-lg-5">
                    <div class="info">
                        <div class="text">
                            <h1>بيان درجات باللغه الانجليزيه</h1>
                        </div>

                        <div class="icon">
                        <i class="fa-sharp fa-solid fa-envelope-open-text"></i>                        </div>
                    </div><br>
                    <div class="price">
                    <?php foreach($s5 as $data):?>
                          <p><?=$data['fees']?><span>EGP</span> </p>
                          <?php endforeach;?>
                        <?php
                    if($_SESSION['level']==1 or $_SESSION['level']==2 or $_SESSION['level']==3 or $_SESSION['level']==4)
                    {
                    ?>
                                <a href="Grade statement in english.php"><button>detail</button></a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    
                    <?php
                    if($_SESSION['level']==5)
                    {
                        ?>
                                    <a href="Grade statement in english.php"><button disabled>detail</button></a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                

            <!-- ايقاف قيد عن تيرم  -->
                <div class="ser col-lg-5">
                    <div class="info">
                        <div class="text">
                            <h1>ايقاف قيد عن تيرم </h1>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-file-lines"></i>
                        </div>
                    </div><br>
                    <div class="price">
                    <?php foreach($s8 as $data):?>
                          <p><?=$data['fees']?><span>EGP</span> </p>
                          <?php endforeach;?>
                        <?php
                    if($_SESSION['level']==1 or $_SESSION['level']==2 or $_SESSION['level']==3 or $_SESSION['level']==4)
                    {
                    ?>
                                <a href="Suspension of a term.php"><button>detail</button></a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    
                    <?php
                    if($_SESSION['level']==5)
                    {
                        ?>
                                    <a href="Suspension of a term.phpp"><button disabled>detail</button></a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

            <!-- ايقاف قيد عن سنه دراسيه  -->
                <div class="ser col-lg-5">
                    <div class="info">
                        <div class="text">
                            <h1>ايقاف قيد عن سنه دراسيه </h1>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-file-lines"></i>
                        </div>
                    </div><br>
                    <div class="price">
                    <?php foreach($s9 as $data):?>
                          <p><?=$data['fees']?><span>EGP</span> </p>
                          <?php endforeach;?>
                        <?php
                    if($_SESSION['level']==1 or $_SESSION['level']==2 or $_SESSION['level']==3 or $_SESSION['level']==4)
                    {
                    ?>
                                <a href="Suspension of year.php"><button>detail</button></a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    
                    <?php
                    if($_SESSION['level']==5)
                    {
                        ?>
                                    <a href="Suspension of year.php"><button disabled>detail</button></a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>


            <!-- افاده دراسه باللغه الانجليزيه            -->
                <div class="ser col-lg-5">
                    <div class="info">
                        <div class="text">
                            <h1>افاده دراسه باللغه الانجليزيه</h1>
                        </div>

                        <div class="icon">
                        <i class="fa-sharp fa-regular fa-calendar-check"></i>                        </div>
                    </div><br>
                    <div class="price">
                    <?php foreach($s6 as $data):?>
                          <p><?=$data['fees']?><span>EGP</span> </p>
                          <?php endforeach;?>
                        <?php
                    if($_SESSION['level']==1 or $_SESSION['level']==2 or $_SESSION['level']==3 or $_SESSION['level']==4)
                    {
                    ?>
                                <a href="Study_statement_in_English.php"><button>detail</button></a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    
                    <?php
                    if($_SESSION['level']==5)
                    {
                        ?>
                                    <a href="Study_statement_in_English.php"><button disabled>detail</button></a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

            <!-- graduation_certificate -->
            <div class="ser col-lg-5">
                    <div class="info">
                        <div class="text">
                            <h1>شهاده تخرج</h1>
                        </div>

                        <div class="icon">
                        <i class="fa-solid fa-user-graduate"></i>
                        </div>
                    </div><br>
                    <div class="price">
                    <?php foreach($s2 as $data):?>
                          <p><?=$data['fees']?><span>EGP</span> </p>
                        <?php endforeach;?>
                        <?php 
                if($_SESSION['level']==5)
                {?>
                        <a href="graduation_certificate.php"><button>detail</button></a>
                <?php
                }
                ?>
                <?php
                if($_SESSION['level']==1 or $_SESSION['level']==2 or $_SESSION['level']==3 or $_SESSION['level']==4)
                {
                ?>
                            <a href="graduation_certificate.php"><button disabled>detail</button></a>
                        </div>
                    </div>
                    <?php
                }
                ?>
                    </div>
                </div>
                <?php include 'footer.php';?>
            </div>
        </div>

    </div>
    <div>
  
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
    <script src="../p63assets/assets/bootstap/jquery.slim.min.js"></script>
    <script src="../p63assets/assets/bootstap/popper.min.js"></script>
    <script src="../p63assets/assets/bootstap/bootstrap.min.js"></script>

    <script src="../p63assets/app.js"></script>


</body>

</html>