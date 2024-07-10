<?php 

session_start();
include("config/db.php");

$msg = array('msg'=>'');
if(isset($_POST['login'])){
    $username = $_POST['admin_name'];
    $password = $_POST['password'];
    if($username != '' && $password != ''){
        $passwd = sha1($password);
        $sql = "SELECT * FROM admin WHERE admin_name = '$username' AND password = '$passwd'";
        $result = mysqli_query($conn,$sql) or die ('Error');
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $id = $row['id'];
                $username = $row['admin_name'];
                $email = $row['email'];
                $password = $row['password'];
                

                $_SESSION['id'] = $id;
                $_SESSION['admin_name'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                

            }
        }
        else{
            $msg['msg'] = 'username or password incorrect! ';
        }
    }
    else{
        $msg['msg'] = 'please fill all the details! ';
    }
}

?>

<?php if(isset($_SESSION['admin_name'])): ?>
    <?php header('Location:dashboard.php'); ?>
<?php else: ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>login</title>
</head>
<body style="background:lightblue;">
    <div class="container-fluid ">
        <div class="row " style="width:700px; margin:0 auto; margin-top:260px">
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
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>

                    <button type="submit" class="btn btn-success" name="login" value="login" style="width:100%;">Login</button>
                </form>
                <div>
                <a class="btn btn-outline-success" href="adminsignin.php" style="width:100%; margin-top:20px;">Signup</a>
                </div>
            </div>
        </div>
        <?php //include('inc/footer.php'); ?>
    </div>
</body>
</html>
<?php endif; ?>



       