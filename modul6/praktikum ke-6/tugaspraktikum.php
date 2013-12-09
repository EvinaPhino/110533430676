<!DOCTYPE>
<html>
	<head>
		<title>Tugas Praktikum</title>
	</head>

	<body>
		<h2>Pengurutan Data</h2>
		<table border="1" cellspacing="1" cellpadding="5">
			<tr>
				<td>#</td>
			<?php
				$sort = isset($_GET['sort']) ? $_GET['sort'] : 'ASC';
				if($sort=='ASC'){
					$temp='DESC';
					$sort=$temp;
					
				}else{
					$temp='ASC';
					$sort=$temp;
				}
				echo '<td width="100"><a href="'.@$self.'?kolom=nim&&sort='.$sort.'">NIM</a></td>';
				echo '<td width="150"><a href="'.@$self.'?kolom=nama&&sort='.$sort.'">Nama</a></td>';
				echo '<td><a href="'.@$self.'?kolom=alamat&&sort='.$sort.'">Alamat</a></td>';
			?>
			</tr>
			<?php
			require_once "./koneksi.php";
			$kolom = isset($_GET['kolom']) ? $_GET['kolom'] : '';
			if($kolom=='' || $sort==''){
				$sql='SELECT * FROM mahasiswa';
			}else{
				$sql='SELECT * FROM mahasiswa ORDER BY '.$kolom.' '.$sort;
			}
			$res = mysql_query($sql);
			$i=1;
			if($res){
				while($row=mysql_fetch_row($res)){?>
					<tr>
						<td><?php echo $i;?></td>
						<td width="100"><?php echo $row[0];?></td>
						<td width="150"><?php echo $row[1];?></td>
						<td><?php echo $row[2];?></td>
					</tr>
					<?php
					$i++;
				}	
			}
		?>
		</table>
	</body>
</html>
