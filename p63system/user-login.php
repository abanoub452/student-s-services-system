<?php
if (!isset($_SESSION)) {
  session_start();
}
// connection to database
require_once('../Connections/syscon.php');  


  $loginFormAction = $_SERVER['PHP_SELF'];


if (isset($_POST['user'])) {
  $loginUsername=$_POST['user'];
  $password=$_POST['pass'];
  //$MM_fldUserAuthorization = "type";
  $MM_redirectLoginSuccess = "admin.php";
  $MM_redirectLoginFailed = "user-login.php?id=1";
  //$MM_redirecttoReferrer = false;
  //mysqli_select_db($bis,$database_bis);
  	
  $query="SELECT * FROM users WHERE username='$loginUsername' AND Password='$password' AND is_enable = 'Yes' ";

  $LoginRS = mysqli_query($bis,$query) ;//or die(mysqli_error($bis));
  $row_LoginRS = mysqli_fetch_assoc($LoginRS);
  $loginFoundUser = mysqli_num_rows($LoginRS);
  if($row_LoginRS['user_type_id']==1 ) {
    
    $loginStrGroup  = $row_LoginRS['Type'];
    
    //declare two session variables and assign them
    $_SESSION['userid'] = $row_LoginRS['user_id'];
	$_SESSION['userarname'] = $row_LoginRS['user_ar_name'];
  $_SESSION['username'] = $row_LoginRS['username'];
	$_SESSION['userimage'] = $row_LoginRS['image'];
  $_SESSION['user_type']=$row_LoginRS['user_type_id'];
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      
   /* if (isset($_SESSION['PrevUrl']) && $_SESSION['user_type']==1 ) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }*/
    header("Location: " . $MM_redirectLoginSuccess );
  }elseif($row_LoginRS['user_type_id']==2){
    $_SESSION['userid'] = $row_LoginRS['user_id'];
    $_SESSION['userarname'] = $row_LoginRS['user_ar_name'];
    $_SESSION['username'] = $row_LoginRS['username'];
    $_SESSION['userimage'] = $row_LoginRS['image'];
  $_SESSION['user_type']=$row_LoginRS['user_type_id'];
    header('location:employee.php');
  }else {
    header("Location: " . $MM_redirectLoginFailed );
  }
///////////////////////////////////////////




}


?>
<?php
   
   mysqli_select_db($bis,$database_bis);
   $query_appata = "SELECT *  FROM `application_data`";
   $appata = mysqli_query($bis,$query_appata) or die(mysqli_error($bis));
   $row_appata = mysqli_fetch_assoc($appata);
   
   $_SESSION['app_name'] = $row_appata['app_name'];
   $_SESSION['uniname'] = $row_appata['Uni_name'];
   $_SESSION['faclutyname'] = $row_appata['Faculty_name'];
   $_SESSION['programnanme'] = $row_appata['Program_name'];
   $_SESSION['facultylogo'] = $row_appata['Faculty-Uni_logo'];
   $_SESSION['programlogo'] = $row_appata['Program_logo'];
   $_SESSION['deanname'] = $row_appata['Faculty_Dean'];
   $_SESSION['postvicedean'] = $row_appata['Post_grad_vice_dean'];
   $_SESSION['affairsvicedean'] = $row_appata['st_affairs_vice_dean'];
   $_SESSION['programcoordinator'] = $row_appata['Program_coordinator'];
   ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>User Login</title>
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

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>
                  <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
                  <form <?php echo $loginFormAction; ?> method="post" class="row g-3 needs-validation" novalidate>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="user" class="form-control" id="user" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="pass" class="form-control" id="pass" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                    <input name="prog" type="hidden" id="prog" value="<?php echo $prog; ?>" />
                      <button name="log"  class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                
                

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->


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