<?php
require_once 'baglanti.php';
if(isset($_GET['kodgeldi'])){
    echo '<script type="text/javascript">';
    echo ' alert("Kod Gönderildi")';  //not showing an alert box.
    echo '</script>';
}

if (isset($_POST['unuttum'])) {
    $email=strip_tags($_POST['email']);
    if ($email!="") {
        $control = $db->prepare('SELECT * FROM giris WHERE user_email=:email');
        $control->bindParam(":email",$email,PDO::PARAM_STR);
        $control->execute();
        $sonuc = $control->rowCount();
        
        
        if ($sonuc!=0) {
            $kod = rand(1,9000)."_".rand(1,9000);
            $sorgu =$db->prepare("UPDATE giris set user_code=? WHERE user_email=?");
            $calis=$sorgu->execute(array($kod,$email));
            header("Location:forgot_password.php?kodgeldi=1");
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Forgot password</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="passwordBox animated fadeInDown">
        <div class="row">

            <div class="col-md-12">
                <div class="ibox-content">

                    <h2 class="font-bold">Forgot password</h2>

                    <p>
                    Enter your email address and your password will be reset and emailed to you.
                       
                    </p>

                    <div class="row">

                        <div class="col-lg-12">
                            <form class="m-t" role="form"  method="post">
                                <div class="form-group">
                                    <input name="email" type="email" class="form-control" placeholder="Email Adresi" required="">
                                </div>

                                <button name="unuttum" type="submit" class="btn btn-danger block full-width m-b">Kod Gönder</button>
                            </form>

                            <form class="m-t" role="form"  method="post" action="sifre_yenileme.php">
                                <button type="submit" class="btn btn-primary block full-width m-b">Şifre Değiştirme Sayfasına Git</button>
                            </form>
    
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                Copyright Example Company
            </div>
            <div class="col-md-6 text-right">
               <small>© 2014-2015</small>
            </div>
        </div>
    </div>

</body>

</html>
