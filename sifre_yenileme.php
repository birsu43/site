<?php
require_once 'baglanti.php';
if (isset($_POST['yenile'])) {
    $email=strip_tags($_POST['email']);
    $sifre=strip_tags($_POST['sifre']);
    $sifretekrar=strip_tags($_POST['sifretekrar']);
    $kod=strip_tags($_POST['kod']);

    if ($email!="" and $sifre!="" and $sifretekrar!="" and $kod!="") {
        if ($sifretekrar == $sifre) {
            $control = $db->prepare("SELECT * FROM giris WHERE user_code=? and user_email=?");
            $control->execute(array($kod,$email));
            $sonuc=$control->rowCount();
            if ($sonuc!=0) {
                $sorgu = $db->prepare("UPDATE giris set user_password = ? , user_code = ? WHERE user_email = ?");
                $calistir = $sorgu -> execute(array($sifre,"",$email));
                if ($calistir) {
                    echo "Şifre Değişti";
                }
                else {
                    echo "Şifre Değişmedi";
                }
            }
            else {
                echo "Kod Yanlış";
            }
        }
        else {
            echo "Yeni Şifreler Uymuyor";
        }
    }
    else {
        echo "Tüm Alanları Doldurun";
    }

}    

?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Şifre Yenile</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    
    <style>
        .bosluk {
        margin-bottom: 10px;
        }
    </style>

</head>

<body class="gray-bg">

    <div class="passwordBox animated fadeInDown">
        <div class="row">

            <div class="col-md-12">
                <div class="ibox-content">

                    <h2 class="font-bold">Şifre Yenile</h2>

                    <p>
                    Size Gelen Kodu Yazın.
                    </p>

                    <div class="row">

                        <div class="col-lg-12">
                            <form class="m-t" role="form"  method="post">
                                <div class="form-group">
                                    <input  name="email" type="email" class="form-control" placeholder="Email address" required="">
                                </div>
                                <div class="form-group">    
                                    <input name="sifre" type="text" class="form-control" placeholder="Yeni Şifre" required="">
                                </div>
                                <div class="form-group">
                                    <input name="sifretekrar" type="text" class="form-control" placeholder="Yeni Şifre Tekrar" required="">
                                </div>
                                <div class="form-group">
                                    <input name="kod" type="text" class="form-control" placeholder="Size Gelen Kod" required="">
                                </div>

                                <button name="yenile" type="submit" class="btn btn-primary block full-width m-b">Şifre Yenile</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>