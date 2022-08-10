<?php
require_once 'baglanti.php'; 

if(isset($_GET['verigirdi'])){
    echo '<script type="text/javascript">';
    echo ' alert("Veri Girildi")';  //not showing an alert box.
    echo '</script>';
} 
            
if (isset($_POST['ekle'])) {

	try
	{
	$sql='INSERT into evrak(evrak_turu,evrak_adi,evrak_getirenkisi,evrak_alankisi,evrak_metin) VALUES(?,?,?,?,?)';
	$stmt= $db->prepare($sql);
    $stmt->execute([$_POST['turu'],$_POST['adi'], $_POST['veren'],$_POST['alan'],$_POST['alan']]);
    $rs = $db->lastInsertId();

    Header("Location:evrak_girme.php?verigirdi=1");
	}
	catch(Exception $e)
	{
		var_dump($e->getMessage());

	}
}

?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Mailbox</title>
    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/plugins/summernote/summernote-bs4.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

  
</head>

<body>

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <img alt="image" class="rounded-circle" src="img/profile_small.jpg"/>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="block m-t-xs font-bold">David Williams</span>
                            <span class="text-muted text-xs block">Art Director <b class="caret"></b></span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                            <li><a class="dropdown-item" href="contacts.html">Contacts</a></li>
                            <li><a class="dropdown-item" href="mailbox.html">Mailbox</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="login.html">Çıkış Yap</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>
                
                
                <li >
                    
                        <a href="index.php"><i class="fa fa-laptop"></i> <span class="nav-label">Evrak Listeleme</span></a>
                </li>
               
                <li class="active">
                    <a href="evrak_girme.php"><i class="fa fa-laptop"></i> <span class="nav-label">Evrak Yazma</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">Dİğer Sayfalar</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                       
                        
                        <li><a href="login.php">Giriş Yap</a></li>
                        
                        <li><a href="forgot_password.php">Şifremi Unuttum</a></li>
                        <li><a href="register.php">Kayıt Ol</a></li>
                       
                    </ul>
                </li>
            </ul>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
          <div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <a href="cikis.php?cikis=1">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>
              
         
    </div>
    
    <div class="passwordBox animated fadeInDown">
        <div class="row">

            <div class="col-md-12">
                <div class="ibox-content">

                    <h2 class="font-bold">Evrak Ekleme</h2>

                    <p>
                    Evrak Bilgilerini Girin
                    </p>

                    <div class="row">

                        <div class="col-lg-12">
                            <form class="m-t" role="form"  method="post">
                                <div class="form-group">
                                    <input  name="turu" type="text" class="form-control" placeholder="Evrak Türü" required="">
                                </div>
                                <div class="form-group">    
                                    <input name="adi" type="text" class="form-control" placeholder="Evrak Adı" required="">
                                </div>
                                <div class="form-group">
                                    <input name="veren" type="text" class="form-control" placeholder="Evrak Getiren Kişi" required="">
                                </div>
                                <div class="form-group">
                                    <input name="alan" type="text" class="form-control" placeholder="Evrak Alan Kişi" required="">
                                </div>

                                <script src="ckeditor/ckeditor.js"></script>
                                <textarea name="metin" class="ckeditor" id="ckeditor1"></textarea>

                                <button name="ekle" type="submit" class="btn btn-danger block full-width m-b">Evrak Ekle</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>

    <!-- SUMMERNOTE -->
    <script src="js/plugins/summernote/summernote-bs4.js"></script>
    

    <script>
        $(document).ready(function(){

            $('.summernote').summernote();

        });

    </script>
</body>

</html>
