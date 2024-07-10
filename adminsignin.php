<?php
session_start(); 
include("config/db.php");

$msg = array('msg'=>'');
if (isset($_POST['submit'])) {

  $username = $_POST['admin_name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];
  if($password != $cpassword){
    $msg['msg'] = "Passwords Doesn't Match";
  }elseif($username != '' && $email != '' && $password != ''){
    $pwd_hash = sha1($password);
    $sql = "INSERT INTO admin (admin_name, email, password)".
    "VALUES ('$username', '$email', '$pwd_hash')";
    $query = $conn->query($sql);
    if($query){
      header('Location:admin.php');
    }
    else{
      $msg['msg'] =  'failed to register user!';
    }
  }
  else{
    $msg['msg'] = 'please fill all the details';
  }
 
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
    <body style="background:lightblue;">
        <div class="set-container">
            <div class="row" style="width:700px; margin:0 auto; margin-top:220px">
                <div class="col-auto" style=" margin:0 auto; width:500px;">
                <?php if($msg['msg']!="") { ?>
                <h5 class="alert alert-danger" style=" margin-bottom:30px; text-align:center;width: 470px;position: absolute;margin-top: -140px;"><?php echo $msg['msg']; ?></h5>
                <?php } ?>
                <h1>𝐊𝐧𝐨𝐰𝐥𝐞𝐝𝐠𝐞 𝐒𝐡𝐚𝐫𝐞</h1>
                <a  class="navbar-brand color" href="index.php" style="margin-left:20px;"><img style="height:100px; width:100px; border-radius:80px;margin-left: 340px;margin-top: -210px;" src="assets/img/logom.png"></a>
                    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                        <div class="form-group">
                        <input type="text" class="form-control" name="admin_name" placeholder="Admin Name">
                        </div>

                        <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="name@example.com">
                        </div>

                        <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>

                        <div class="form-group">
                        <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password">
                        </div>

                        <button type="submit" class="btn btn-success" name="submit" value="submit" style="width:100%;">Signup</button>
                    </form>
                    <div>
                    <a class="btn btn-outline-success" href="login.php" style="width:100%; margin-top:20px;">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>




       