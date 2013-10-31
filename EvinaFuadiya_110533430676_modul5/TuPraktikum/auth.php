<!-- Algoritma program terdapat pada index.php -->
<?php
defined('_VALID') or die('not allowed');

function init_login() {
	//Simulasi data account user dan password
	$user = 'admin';
	$pass = 'admin';
	
	if(isset($_POST['user']) && isset($_POST['pass'])) {
		$n = trim($_POST['user']);
		$p = trim($_POST['pass']);
	
		if(($n === $user) && ($p === $pass)) {
			//Jika sama, get cookie
			$_SESSION['user'] = $n;
			
			//redirect
	?>
			<script type="text/javascript">
				document.location.href="./";
			</script>
	<?php
		} else {
			echo 'user/Password Tidak Sesuai';
			return false;
		}
	}
}

function validate() {
	if(!isset($_SESSION['user'])) {
?>
	<div class="inner">
		<form action="" method="post">
			<table border=0 cellpadding=5>
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
			</table>
		</form>
	</div>
<?php
	exit;
	}
	
	if(isset($_GET['m']) && $_GET['m'] == 'logout') {
		//Hapus session
		if(isset($_SESSION['user'])) {
			unset($_SESSION['user']);
		}
		//Redirect
?>
		<script type="text/javascript">
			document.location.href="./";
		</script>
<?php
	}
}
?>