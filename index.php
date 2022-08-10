<?php
require_once 'baglanti.php';
require_once 'evrak_listele.php';
require_once 'evrak_silme.php';

if (empty($_SESSION['email'])) {
    header("location:login.php");
    exit;
}
if(isset($_GET['admingiris'])){
    echo '<script type="text/javascript">';
    echo ' alert("Hoşgeldin Admin")';  //not showing an alert box.
    echo '</script>';
}
if(isset($_GET['usergiris'])){
    echo '<script type="text/javascript">';
    echo ' alert("Hoşgeldin Kullanıcı")';  //not showing an alert box.
    echo '</script>';
}

if(isset($_GET['codekullanıcıyok'])){
    echo '<script type="text/javascript">';
    echo ' alert("Böyle Bir Kullanıcı Yok")';  //not showing an alert box.
    echo '</script>';
}

if(isset($_GET['codegeldi'])){
    echo '<script type="text/javascript">';
    echo ' alert("Kod Gönderildi")';  //not showing an alert box.
    echo '</script>';
}

if(isset($_GET['codehata'])){
    echo '<script type="text/javascript">';
    echo ' alert("Hata Var")';  //not showing an alert box.
    echo '</script>';
}

if(isset($_GET['codeemailyok'])){
    echo '<script type="text/javascript">';
    echo ' alert("E-mail Boş")';  //not showing an alert box.
    echo '</script>';
}

//echo '<pre>'.print_r($_SESSION,true).'</pre>';

?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">


    <title>INSPINIA | Data Tables</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">
    
    <link href="css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
   
<!-- Tablonun kodları -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>



    <style>
        .deneme {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Roboto', sans-serif;
        }

        .table-responsive {
        
        margin: 5%;
        width: 100%;
       
           
        }
        .table-wrapper {
            min-width: 1000px;
            background: #fff;
            padding: 20px;
            box-shadow: 0 1px 1px rgba(0,0,0,.05);
        }
        .table-title {
            padding-bottom: 10px;
            margin: 0 0 10px;
            min-width: 100%;
        }
        .table-title h2 {
            margin: 8px 0 0;
            font-size: 22px;
        }
        .search-box {
            position: relative;        
            float: right;
        }
        .search-box input {
            height: 34px;
            border-radius: 20px;
            padding-left: 35px;
            border-color: #ddd;
            box-shadow: none;
        }
        .search-box input:focus {
            border-color: #3FBAE4;
        }
        .search-box i {
            color: #a0a5b1;
            position: absolute;
            font-size: 19px;
            top: 8px;
            left: 10px;
        }
        table.table tr th, table.table tr td {
            border-color: #e9e9e9;
            text-align: center;
        }
        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }
        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
            
        }
        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }
        table.table td:last-child {
            width: 130px;
        }
        table.table td a {
            color: #a0a5b1;
            display: inline-block;
            margin: 0 5px;
        }
        table.table td a.view {
            color: #03A9F4;
        }
        table.table td a.edit {
            color: #FFC107;
        }
        table.table td a.delete {
            color: #E34724;
        }
        table.table td i {
            font-size: 19px;
        }    
        .pagination {
            float: right;
            margin: 0 0 5px;
        }
        .pagination li a {
            border: none;
            font-size: 95%;
            width: 30px;
            height: 30px;
            color: #999;
            margin: 0 2px;
            line-height: 30px;
            border-radius: 30px !important;
            text-align: center;
            padding: 0;
        }
        .pagination li a:hover {
            color: #666;
        }	
        .pagination li.active a {
            background: #03A9F4;
        }
        .pagination li.active a:hover {        
            background: #0397d6;
        }
        .pagination li.disabled i {
            color: #ccc;
        }
        .pagination li i {
            font-size: 16px;
            padding-top: 6px
        }
        .hint-text {
            float: left;
            margin-top: 6px;
            font-size: 95%;
        }    
        </style>
        
        <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
        </script>
            
</head>

<body>

   <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <img alt="image" class="rounded-circle" src="img/profile_small.jpg" />
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold"><?php
                                 if (isset($_SESSION['user'])) {

                                    echo $_SESSION['user'];
                                 }  
                                 ?></span>
                            <span class="text-muted text-xs block">Art Director <b class="caret"></b></span>
                            <?php
                                if (isset($_SESSION['email'])) {
                                   echo $_SESSION['email'];
                                } 
                                ?>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                            <li><a class="dropdown-item" href="contacts.html">Contacts</a></li>
                            <li><a class="dropdown-item" href="mailbox.html">Listeleme</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="cikis.php?cikis=1">Çıkış Yap</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>
                    <li class="active">
                        <a href="index.php"><i class="fa fa-laptop"></i> <span class="nav-label">Evrak Listeleme</span></a>
                </li>
                <li>
                    <a href="evrak_girme.php"><i class="fa fa-laptop"></i> <span class="nav-label">Evrak Yazma</span></a>
                </li>
                
                
                
                <li>
                    <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">Dİğer Sayfalar</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="login.php">Giriş Yap</a></li>
                        <li><a href="forgot_password.html">Şifremi Unuttum</a></li>
                        <li><a href="register.php">Kayıt Ol</a></li>
                    </ul>
                </li>
            </ul>    
        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
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
                        <i class="fa fa-sign-out"></i> Çıkış Yap
                    </a>
                </li>
            </ul>

        </nav>


     <div class="deneme">
        <div class="container-x1">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-8"><h2><b>Evraklar</b></h2></div>
                            <div class="col-sm-4">
                                <div class="search-box">
                                    <i class="material-icons">&#xE8B6;</i>
                                    <input type="text" class="form-control" placeholder="Search&hellip;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="table_data_tables.php">
                        <button>tablo</button>
                    </form>
                    <form action="pdf_acma.php">
                        <button>ac</button>
                    </form>

                    <form method="post" action="<?= htmlspecialchars('result.php');?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="file" class="form-control-file" name="myFile">
                    </div>
                    
                    <button type="submit" class="btn btn-danger block full-width m-b">Dosya Yükle</button>
                </form>
                <
                    
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                            <th>ID <i class="fa fa-sort"></i></th>
                            <th>Evrak No <i class="fa fa-sort"></i></th>
                            <th>Evrak Türü <i class="fa fa-sort"></i></th>
                            <th>Evrak Adı <i class="fa fa-sort"></i></th>
                            <th>Evrak Tarihi <i class="fa fa-sort"></i></th>
                            <th>Getiren Kişi <i class="fa fa-sort"></i></th>
                            <th>Alan Kişi <i class="fa fa-sort"></i></th>
                            <th>İşlemler </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($personellist as $person){?>
                            <tr>
                                <td><?=$person->evrak_id?></td>
                                <td><?=$person->evrak_no?></td>
                                <td><?=$person->evrak_turu?></td>
                                <td><?=$person->evrak_adi?></td>
                                <td><?=$person->evrak_gelistarih?></td>
                                <td><?=$person->evrak_getirenkisi?></td>
                                <td><?=$person->evrak_alankisi?></td>
                                <td>
                                <a href="evrak_detay.php?evrak_id=<?=$person->evrak_id?>" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                                <a href="evrak_guncelle.php?evrak_id=<?=$person->evrak_id?>" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                <a href="?sil=<?=$person->evrak_id?>" onclick="return confirm('Silmekte Mutabık Mısınız ?')" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                                </td>                                            
                            </tr>
                            <?php } ?>
                        </tbody>                        
                    </table>
                    
                    <div class="clearfix">
                        <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                        <ul class="pagination">
                            <li class="page-item disabled"><a href="#"><i class="fa fa-angle-double-left"></i></a></li>
                            <li class="page-item"><a href="#" class="page-link">1</a></li>
                            <li class="page-item"><a href="#" class="page-link">2</a></li>
                            <li class="page-item active"><a href="#" class="page-link">3</a></li>
                            <li class="page-item"><a href="#" class="page-link">4</a></li>
                            <li class="page-item"><a href="#" class="page-link">5</a></li>
                            <li class="page-item"><a href="#" class="page-link"><i class="fa fa-angle-double-right"></i></a></li>
                        </ul>
                    </div>
                </div>
                </div>
            </div>  
        </div>   
       </div>
        </div>
        </div>
    </div>
    
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <!-- Mainly scripts -->
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>

    <!-- Peity -->
    <script src="js/plugins/peity/jquery.peity.min.js"></script>
    <script src="js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- GITTER -->
    <script src="js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="js/plugins/toastr/toastr.min.js"></script>

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
    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

        });

    </script>

</body>

</html>
