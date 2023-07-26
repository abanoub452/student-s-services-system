<?php
 if (!isset($_SESSION)) {
  session_start();
}
// connection to database

require_once('../Connections/syscon.php');  

 
 
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="utf-8">
   <meta content="width=device-width, initial-scale=1.0" name="viewport">
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title><?php echo $_SESSION['app_name']; ?></title>
 
   <title></title>
   <meta content="" name="description">
   <meta content="" name="keywords">
 

   <style type="text/css">
 
 .style225 {
     color: #FFFFFF;
     font-weight: bold;
 }
 .link {
     font-family: Calibri;
     color: #FFFFFF;
     font-weight: bold;
 }
 .link:hover {
     color: #FF0000;
     text-decoration: none;
 }
 .link:link {
     text-decoration: none;
     color: #003366;
 }
 .link:visited {
     text-decoration: none;
     color: #003366;
 }
 .link:active {
     text-decoration: none;
     color: #003366;
 }
 .head,td,th {
     font-family: Calibri;
     font-size: 20px;
     font-weight: bold;
 }  
 .style52 {color: #FFFFFF}
 .style54 {color: #99FF66}
 .style56 {color: #990000}
 .style57 {color: #006699}
 .style58 {color: #FFFF00}
 </style>
 </head>
 
 <body class="head">
 <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr bgcolor="<?php echo $color; ?>">
    <td  height="30" colspan="4" align="center" bgcolor="#3399CC"><span class="style225"><span class="style237 style58"><a href="team/team.html">BIS 2023</a></span> جميع الحقوق محفوظه لــــــــــ <span class="style237 style58"><a href="team/team.html">فريق برنامج </a></span></span></td>
  </tr>
     </table>
</body>