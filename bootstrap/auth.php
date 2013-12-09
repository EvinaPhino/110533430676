<?php
        defined('_VALID')or die('not allowed');

        function init_login(){
                // Simulasi data account username dan password
                global $username;
                global $password;
                $username = 'admin';
                $password = 'admin';

                if(isset($_POST['username']) && isset($_POST['password'])){
                        $n = trim($_POST['username']);
                        $p = trim($_POST['password']);

                        if(($n === $username) && ($p === $password)){
                                // Jika sama, set session
                                $_SESSION['loggedin'] = $n;
                                $_SESSION['time'] = time();

                                // Redireksi halaman
                                ?>

<script type="text/javascript">
document.location.href="./";
</script>

<?php
                        }else{
                                return false;
                        }
                }
        }

        function validate(){
                global $username;
                global $password;

                if(!isset($_SESSION['loggedin']) || !isset($_SESSION['time'])){
                        ?>
<?php
                                        ini_set('display_errors',1);

                                ?>

<link href="css/signin.css" rel="stylesheet">
<div class="container">

<form class="form-signin" id="login" action="<?php $_SERVER['PHP_SELF'];?>" method="post">
<?php
                                                if(isset($_POST['username']) && isset($_POST['password'])){
                                                        if(is_string($_POST['username']) && is_string($_POST['password'])){ // Validasi form bernilai string
                                                                if($_POST['username'] == $username && $_POST['password'] != $password){
                                                                        print '<div class="panel panel-danger"><div class="panel-heading">Password salah</div></div>';
                                                                }elseif($_POST['username'] != $username && $_POST['password'] == $password){
                                                                        print '<div class="panel panel-danger"><div class="panel-heading">Username salah</div></div>';
                                                                }elseif($_POST['username'] != $username && $_POST['password'] != $password){
                                                                        print '<div class="panel panel-danger"><div class="panel-heading">Username & Password salah</div></div>';
                                                                }
                                                        }
                                                }
                                        ?>
<div class="panel panel-info"><div class="panel-heading">Username: melody &bullet; Password: aitakata</div></div>
<input type="text" class="form-control" placeholder="Username" name="username" id="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : '';?>" onkeypress="return alphabetOnly(event)" required autofocus>
<input type="password" class="form-control" placeholder="Password" name="password" id="password" onkeypress="return alphabetOnly(event)" required>
<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>

</div> <!-- /container -->

<?php
                        exit;
                }

                if(isset($_GET['logout']) && $_GET['logout'] == 'true'){
                        // Hapus session
                        if(isset($_SESSION['loggedin'])){
                                unset($_SESSION['loggedin']);
                        }
                        if(isset($_SESSION['time'])){
                                unset($_SESSION['time']);
                        }

                        // Redireksi halaman
                        ?>

<script type="text/javascript">
document.location.href="./";
</script>

<?php
                }
        }
?>