<!DOCTYPE html>
<html>
<head><title> Kalkulator Sederhana </title></head>
<body bgcolor="#35CCFF">
<?php
error_reporting(E_ERROR|E_WARNING); //peringatan untuk melaporkan kesalahan yang terjadi.
//pendeklarasian
$a = $_POST['angka1'];
$b = $_POST['angka2'];
$cmd = $_POST['act'];

if(!empty($a) and !empty($b)){ //merupakan mekanisme if, bila salah satu dipilih maka akan menjalankan aksi yang dipilih tersebut
	if ($cmd == 'Tambah'){ // jika memilih/menekan tombol tambah maka akan menjalankan script dibawah
		$hasil= $a + $b; // operasi penambahan
		$opt = " + ";
	}
	elseif ($cmd == 'Kurang'){ // jika memilih/menekan tombol kurang maka akan menjalankan script dibawah
		$hasil= $a - $b; // operasi pengurangan
		$opt = " - ";
	}
	elseif ($cmd == 'Kali'){ // jika memilih/menekan tombol kali maka akan menjalankan script dibawah
		$hasil= $a * $b; // operasi perkalian
		$opt = " X ";
	}
	elseif ($cmd == 'Bagi'){ // jika memilih/menekan tombol bagi maka akan menjalankan script dibawah
		$hasil= $a / $b; // operasi pembagian
		$opt = " / ";
	}
	elseif ($cmd == 'Reset'){ // jika memilih/menekan tombol reset maka akan menjalankan script dibawah 
		$a = "";
		$b = "";
		$hasil = "";
		$opt= "";
		$cmd= "";
	}
}
elseif($cmd == 'Reset'){ //ketika ditekan tombol reset maka akan dijalankan script dibawah ini,kemudian akan mengosongkan nilai masukan
	echo "<script> window.alert('Angka telah dibersihkan!!!'); </script>"; //ini merupakan javascript windows alert
	$a = "";
	$b = "";
	$hasil = "";
	$opt= "";
	$cmd= "";
}
elseif(!empty($cmd)){ // ketika salah satu atau semua field kosong maka akan menjalankan script dibawah, kemudian akan mengosongkan nilai masukan
	echo "<script> window.alert('Angka 1 dan 2 tidak boleh kosong !!!'); </script>"; //ini merupakan javascript windows alert
	$a = "";
	$b = "";
	$hasil = "";
	$opt= "";
	$cmd= "";
}
?>
<form method='post'>
<table align='center'>
<table border="1px" >
<tr>
<td colspan=5 align='center'> <font size=7 >Kalkulator Sederhana <?php echo $cmd; ?></font>  
<BR> by : EvinaPhino <BR>
</td>
</tr>
<tr>
<td align='center'>Angka 1</td>
<td align='center'> </td>
<td align='center'>Angka 2</td>
<td align='center'> </td>
<td align='center'>Hasil</td>
</tr>
<tr>
<td><input type="number" name="angka1" value="<?php echo $a; ?>"/></td> <!-- memasukkan nilai var a -->
<td><?php echo $opt; ?></td> <!-- memanggil salah satu tombol yang ditekan nantinya -->
<td><input type="number" name="angka2" value="<?php echo $b; ?>"/></td> <!-- memasukkan nilai var b -->
<td>=</td>
<td><input type="number" name="hasil" disabled value="<?php echo $hasil; ?>"/></td> <!-- memanggil variabel hasil -->
</tr>
<tr>
<td colspan=5 align='center'>Operator</td>
</tr>
<tr>
<td colspan=5 align='center'><input type="submit" name="act" value='Tambah'/> <!-- untuk membuat tombol tambah -->
<input type="submit" name="act" value='Kurang'/> <!-- untuk membuat tombol kurang -->
<input type="submit" name="act" value='Kali'/> <!-- untuk membuat tombol kali -->
<input type="submit" name="act" value='Bagi'/> <!-- untuk membuat tombol bagi -->
<input type="submit" name="act" value='Reset'/></td> <!-- untuk membuat tombol reset -->
</tr>
</table>
</form>
</body>
</html>