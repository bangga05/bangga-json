<!DOCTYPE html>
<html>
<head>
	<title>Bangga Json</title>
</head>

<?php 
include "koneksi.php";

$nrp = isset($_POST['nrp']) ? $_POST['nrp'] : '';
$nama = isset($_POST['nama']) ? $_POST['nama'] : '';
$jurusan = isset($_POST['jurusan']) ? $_POST['jurusan'] : '';
$jenis_kelamin = isset($_POST['jenis_kelamin']) ? $_POST['jenis_kelamin'] : '';

if (isset($_POST["submit"])) {
	$query = "insert into mahasiswa (nrp,nama,jurusan,jenis_kelamin) values ('$nrp','$nama','$jurusan','$jenis_kelamin')";
	mysql_query($query);
	echo "Data Disimpan";
}

$tab_name = "mahasiswa";
$queri = "select * from $tab_name";
$hasil = mysql_query($queri);
$field_count = mysql_num_fields($hasil);
$sitejson = array();

while ($data=mysql_fetch_array($hasil)) {
	$sitejson[]=array(
			'nrp' => $data['nrp'], 
			'nama' => $data['nama'],
			'jurusan' => $data['jurusan'],
			'jenis_kelamin' => $data['jenis_kelamin'] 
		);
};

$file = fopen('mahasiswa.json','w');
fwrite($file,json_encode($sitejson));
fclose($file);


?>

<body>
	<form action="?" method="POST" "multipart/form-data"
		<div>
			<h1>Inputkan Data Mahasiswa</h1>
			<table border="0" cellspacing="3px" cellpadding="3px" style="text-align: right;">
				<tr>
					<td>NRP : </td>
					<td>
						<input type="number" name="nrp">
					</td>
				</tr>
				<tr>
					<td>NAMA : </td>
					<td>
						<input type="text" name="nama">
					</td>
				</tr>
				<tr>
					<td>JURUSAN : </td>
					<td><input type="text" name="jurusan"></td>
				</tr>
				<tr>
					<td>JENIS KELAMIN : </td>
					<td>
						<input type="radio" name="jenis_kelamin" value="Pria">Laki-laki
						<input type="radio" name="jenis_kelamin" value="Perempuan">Perempuan
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type="submit" name="submit" value="SIMPAN">
						<input type="reset" name="reset" value="RESET">
					</td>
				</tr>
			</table>
		</div>
	</form>
	<form action="parsing.php" method="post" enctype="multipart/form-data">
		<tr>
			<td><input type="submit" name="submit" value="LOAD"></td>
			<td><input type="file" name="file"></td>
		</tr>
	</form>
</body>
</html>