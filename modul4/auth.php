<?php
defined('_VALID') or die ('not allowed');
//Pemanggilan session
session_start();
function init_login(){
    //Simulasi data account user dan password
    $user = 'coba';
    $pass = 'cobi';  

    if (isset($_POST['user']) && isset ($_POST['pass'])){
        $n = trim($_POST['user']);
        $p = trim($_POST['pass']);

        if(($n===$user) && ($p ===$pass)){          

            if(!isset($_SESSION['nlogin']) || !isset($_SESSION['time'])){
                $_SESSION['nlogin'] = $n;
                $_SESSION['time'] = time();
            } 
            ?>
            <script type="text/javascript">
            document.location.href="./";
            </script>
            <?php
            } 
            else {
                echo 'user / Password Tidak Sesuai';
                return false;
            }
        }
    }

function validate(){
    if(!isset($_SESSION['nlogin']) || !isset($_SESSION['time'])){?>
         <!--   <style type="text/css">
<!--
.style1 {color: #FFFFFF}

            </style>-->
            
    <div class="inner">
    <form action="" method="post">
    <table border=0 cellpadding=5>
   <!-- <tr>
            <td colspan="2" bgcolor="#000000"><div align="center" class="style1">LOGIN FORM</div></td>
      </tr> -->
        <tr>
            <td>Username</td>
            <td><input type="text" name="user" /></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="pass" /></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="LOGIN" /></td>
        </tr>
        <!--<tr>
            <td colspan="2" bgcolor="#000000"><div align="center" class="style1">========================</div></td>
      </tr>-->
    </table>
    </form>
    </div>

    <?php
    exit;
    }
    if(isset($_GET['m']) && $_GET['m'] == 'logout'){
    //hapus session
    if(isset($_SESSION['nlogin'])){
        unset($_SESSION['nlogin']);
        }
    if(isset($_SESSION['time'])){
        unset($_SESSION['time']);
        }
    //redireksi halaman
    ?>
    <script type="text/javascript">
    document.location.href="./";
    </script>
    <?php
    }
}
?>