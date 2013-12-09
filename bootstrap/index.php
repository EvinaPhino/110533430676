<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
</head>
<body>
<?php
session_start();
ini_set('display_errors', 1);
define('_VALID', 1);

if(isset($_SESSION['loggedin']) || isset($_SESSION['time'])){
echo '<title>Tugas Bootstrap</title>';
}elseif(!isset($_SESSION['loggedin']) || !isset($_SESSION['time'])){
echo '<title>Login &rarr; Tugas Bootstrap</title>';
}
?>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="js/jquery.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>

  <script language="JavaScript">
    function konfirmasi(Keterangan){
      tanya = confirm('Anda yakin ingin menghapus mahasiswa dengan NIM '+ Keterangan + ' ?');
      if (tanya == true) return true;
      else return false;
    }
  </script>

  <script language="javascript">
    function getKey(e){
      if (window.event)
        return window.event.keyCode;
      else if (e)
        return e.which;
      else
        return null;
    }

    function restrictChars(e, validList){
      var key, keyChar;
      key = getKey(e);
      if (key == null) return true;
      keyChar = String.fromCharCode(key).toLowerCase();
      if (validList.toLowerCase().indexOf(keyChar) != -1)
        return true;
      if(key == 0 || key == 8 || key == 9 || key == 13 || key == 27)
        return true;
      return false;
    }

    function alphabetOnly(e){
      return restrictChars( e, "ABCDEFGHIJKLMNOPQRSTUVWXYZ");
    }
  </script>

  <?php
    require_once('auth.php');
    init_login();
    validate();
  ?>

<div class="container">

<h1>Data Mahasiswa</h1>
<nav class="navbar navbar-inverse" role="navigation">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="./">Riffrizz</a>
</div>

<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<ul class="nav navbar-nav">
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-sort-by-alphabet"></span> &nbsp; Sort Ascending <b class="caret"></b></a>
<ul class="dropdown-menu">
<li><a href="?orderby=nim&sorting=asc"><span class="glyphicon glyphicon-folder-open"></span> &nbsp; NIM</a></li>
<li><a href="?orderby=nama&sorting=asc"><span class="glyphicon glyphicon-folder-open"></span> &nbsp; Nama</a></li>
<li><a href="?orderby=alamat&sorting=asc"><span class="glyphicon glyphicon-folder-open"></span> &nbsp; Alamat</a></li>
</ul>
</li>
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-sort-by-alphabet-alt"></span> &nbsp; Sort Descending <b class="caret"></b></a>
<ul class="dropdown-menu">
<li><a href="?orderby=nim&sorting=desc"><span class="glyphicon glyphicon-folder-open"></span> &nbsp; NIM</a></li>
<li><a href="?orderby=nama&sorting=desc"><span class="glyphicon glyphicon-folder-open"></span> &nbsp; Nama</a></li>
<li><a href="?orderby=alamat&sorting=desc"><span class="glyphicon glyphicon-folder-open"></span> &nbsp; Alamat</a></li>
</ul>
</li>
</ul>
<ul class="nav navbar-nav navbar-right">
<?php
          if(!isset($_SESSION['loggedin']) || !isset($_SESSION['time'])){
            echo '<li><a href="#"><span class="glyphicon glyphicon-user"></span> &nbsp; Login</a></li>';
          }elseif(isset($_SESSION['loggedin']) || isset($_SESSION['time'])){
            echo '<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> &nbsp; ' . $_SESSION['loggedin'] . ' <b class="caret"></b></a>
<ul class="dropdown-menu">
<li><a href="?logout=true"><span class="glyphicon glyphicon-off"></span> &nbsp; Logout</a></li>
</ul>
</li>';
          }
        ?>
</ul>
</div><!-- /.navbar-collapse -->
</nav>

<?php
    ini_set('display_errors',1);

    // Meng-include file koneksi dan data handler
    require_once './koneksi.php';
    require_once './data_handler.php';

    // Memanggil fungsi data handler
    data_handler('?m=data');
  ?>

</body>
</html>