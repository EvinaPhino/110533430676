<?php
function data_handler($root){
        if(isset($_GET['act']) && $_GET['act'] == 'add'){
                data_editor($root);
                return;
        }

        $res = mysql_query("SELECT count(*) AS total FROM mahasiswa" );
        if(mysql_num_rows($res)){
                if(isset($_GET['act']) && $_GET['act'] != ''){
                        switch ($_GET['act']){
                                case 'edit':
                                        if(isset($_GET['id']) && ctype_digit($_GET['id'])){
                                                data_editor($root, $_GET['id']);
                                        }else{
                                                show_admin_data($root);
                                        }
                                        break;
                                case 'view':
                                        if(isset($_GET['id']) && ctype_digit($_GET['id'])){
                                                data_detail($root, $_GET['id'], 1);
                                        }else{
                                                show_admin_data($root);
                                        }
                                        break;
                                case 'del':
                                        if(isset($_GET['id']) && ctype_digit($_GET['id'])){
                                                $id = $_GET['id'];
                                                $ok = "DELETE FROM mahasiswa WHERE nim='$id'";
                                                $res = mysql_query($ok);
                                                if($res){
                                                        
                                                        ?>

<?php
                                                }else{
                                                        echo 'Gagal menghapus data';
                                                }
                                        }else{
                                                show_admin_data($root);
                                        }
                                        ?>

<script type="text/javascript">
document.location.href="<?php echo $root;?>";
</script>

<?php
                                        break;
                                        default:
                                        show_admin_data($root);
                                        break;
                        }
                }else{
                        show_admin_data($root);
                }
                @mysql_close(res);
        }else{
                echo 'Data Tidak ditemukan';
        }
}

function show_admin_data($root){ ?>
<div class="panel panel-default">
<div class="panel-heading">Data Mahasiswa</div>
<?php
                $sql = 'SELECT nim, nama, alamat FROM mahasiswa';
                $res = mysql_query($sql);

                if($res){
                        $num = mysql_num_rows($res);
                        if($num){
                                $sorting = 'asc';
                                $newsorting = 'asc';
                                if(isset($_GET['orderby'])){
                                        $orderby=$_GET['orderby'];
                                        $sorting=$_GET['sorting'];

                                        $sql="SELECT * FROM mahasiswa order by $orderby $sorting ";
                                        if($sorting=='asc'){
                                                $newsorting='desc';
                                        }else{
                                                $newsorting='asc';
                                        }
                                }
                                ?>
<div class="panel-body"><a href="<?php echo $root; ?>&amp;act=add">
<button type="button" class="btn btn-default">
<span class="glyphicon glyphicon-plus"></span> Tambah Data
</button>
</a></div>

<table class="table">
<thead>
<tr>
<th>No</th>
<th><a href='index.php?orderby=nim&sorting=<?=$newsorting;?>'>Nim</a></th>
<th><a href='index.php?orderby=nama&sorting=<?=$newsorting;?>'>Nama</a></th>
<th><a href='index.php?orderby=alamat&sorting=<?=$newsorting;?>'>Alamat</a></th>
<th>Menu</th>
</tr>
</thead>
<?php
                                $result = mysql_query($sql) or die (mysql_error());
                                $no = 1;
                                while($rows=mysql_fetch_object($result)){
                                ?>

<tr>
<td><?php echo $no ?></td>
<td><a href="<?php echo $root;?>&amp;act=view&amp;id=<?php echo $rows -> nim;?>" title="Lihat Data"><?php echo $rows -> nim;?></a></td>
<td><?php echo $rows -> nama;?></td>
<td><?php echo $rows -> alamat;?></td>
<td>
<div class="btn-group btn-group-xs">
<a class="btn btn-default" href ="<?php echo $root;?>&amp;act=edit&amp;id=<?php echo $rows -> nim;?>"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
<a class="btn btn-default" href ="<?php echo $root;?>&amp;act=del&amp;id=<?php echo $rows -> nim;?>" onclick="return konfirmasi('<?php echo $rows -> nim;?> dengan Nama <?php echo $rows -> nama;?>')"><span class="glyphicon glyphicon-trash"></span> Hapus</a>
</div>
</td>
</tr>

<?php
                                $no++;
                                }
                                ?>
</table>
<?php
                        }else{
                                echo '<div class="panel-body"><p>Belum ada data, isi <a href="' . $root.'&amp;act=add">di sini</a></p></div>';
                        }
                        ?>
</div>
<?php
                        mysql_close();
                }
}

function data_detail($root, $id){
        $sql = "SELECT nim, nama, alamat FROM mahasiswa WHERE nim ='$id'";
        $res = mysql_query($sql);
        ?>
<div class="panel panel-default">
<?php
        if($res){
                if(mysql_num_rows($res)){ ?>
<?php
                                $row = mysql_fetch_row($res); ?>
<div class="panel-heading">Data Mahasiswa <?php echo $row[0];?></div>
<ul class="list-group">
<li class="list-group-item">NIM : <?php echo $row[0];?></li>
<li class="list-group-item">Nama : <?php echo $row[1];?></li>
<li class="list-group-item">Alamat : <?php echo $row[2];?></li>
</ul>
<?php
                }else{
                        echo '<div class="panel-body">Data tidak ditemukan</div>';
                }
                ?>
</div>
<button type="button" class="btn btn-default" onclick="document.location.href='<?php echo $root;?>'">
<span class="glyphicon glyphicon-circle-arrow-left"></span> Kembali
</button>
<?php
                mysql_close();
        }
}

function data_editor($root, $id = 0){
        $view = true;
        if(isset($_POST['nim']) && $_POST['nim']){
                if(!$id){
                        $nim = $_POST['nim'];
                        $nama = $_POST['nama'];
                        $alamat = $_POST['alamat'];
                        $res = mysql_query("INSERT INTO mahasiswa VALUES ('".$nim."', '" .$nama."', '" .$alamat."')");
                        if($res){ ?>
<script type="text/javascript">
document.location.href="<?php echo $root;?>";
</script>
<?php
                }else{
                        echo 'Gagal menambah data';
                }
                }else{
                        $nim = $_POST['nim'];
                        $nama = $_POST['nama'];
                        $alamat = $_POST['alamat'];
                        $res = mysql_query("UPDATE mahasiswa SET nim='$nim', nama='$nama', alamat='$alamat' WHERE nim='$id'");
                        if($res){ ?>
<script type="text/javascript">
document.location.href="<?php echo $root;?>";
</script>
<?php
                }else{
                        echo 'Gagal Modifikasi';
                }
                }
        }
        if($view){
                if($id){
                        $sql = "SELECT nim, nama, alamat FROM mahasiswa WHERE nim ='$id'";
                        $res = mysql_query($sql);
                        if($res){
                                if(mysql_num_rows($res)){
                                        $row = mysql_fetch_row($res);
                                        $nim = $row[0];
                                        $nama = $row[1];
                                        $alamat = $row[2];
                                }else{
                                        show_admin_data();
                                        return;
                                }
                        }
                }else{
                        $nim = @$_POST['nim'];
                        $nama = @$_POST['nama'];
                        $alamat = @$_POST['alamat'];
                }
                ?>
<div class="panel panel-default">
<div class="panel-heading">Tambah Data Mahasiswa</div>
<div class="panel-body">
<form class="bs-example bs-example-form" action="" method="post">
<div class="input-group">
<span class="input-group-addon">*NIM</span>
<input type="text" name="nim" value="<?php echo $nim;?>" class="form-control" placeholder="Nomor Induk Mahasiswa">
</div>
<br />
<div class="input-group">
<span class="input-group-addon">Nama</span>
<input type="text" name="nama" value="<?php echo $nama;?>" class="form-control" placeholder="Nama Lengkap Mahasiswa">
</div>
<br />
<div class="input-group">
<span class="input-group-addon">Alamat</span>
<input type="text" name="alamat" value="<?php echo $alamat;?>" class="form-control" placeholder="Alamat Mahasiswa">
</div>
<br />
<div class="btn-group">
<button type="submit" class="btn btn-default">
<span class="glyphicon glyphicon-floppy-save"></span> Submit Data
</button>
<button type="button" class="btn btn-default" onclick="document.location.href='<?php echo $root;?>'">
<span class="glyphicon glyphicon-circle-arrow-left"></span> Kembali
</button>
</div>
</form>
<br />
<p> Ket: * Harus diisi</p>
</div>
</div>
<?php
        }
        return false;
        }

?>