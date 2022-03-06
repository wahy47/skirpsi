<?php  
$nama_wisata = $_GET['nama'];

require ('koneksi.php');

$sql = "SELECT * FROM wisata WHERE nama_wisata = '$nama_wisata'";
$result = mysqli_query($db,$sql);
$data = $result -> fetch_assoc();

$sqla = "SELECT kategori FROM otherkategori WHERE nama = '$nama_wisata'";
$resulta = mysqli_query($db,$sqla);
//$otherkategori = $resulta -> fetch_assoc();
//$otherkategori = $resulta -> fetch_array(MYSQLI_ASSOC);
 
$sqlb = "SELECT gambar FROM other WHERE nama = '$nama_wisata'";
$resultb = mysqli_query($db,$sqlb);

$a=[];

$b=[];

$c=[];

// if (!empty($result)){
// while ($row = mysqli_fetch_array($result)) {
// 	array_push($a, $row);
// }}
if (!empty($resultb)){
	foreach($resultb as $row){
	array_push($b, $row['gambar']);
}}
if (!empty($resulta)){
	foreach($resulta as $row){

	array_push($c, $row['kategori']);
}}
$x = array_merge($a,$b,$c);
$z = array('nama_wisata' => $data['nama_wisata'],'gambar' => $data['gambar'],'harga' => $data['harga'],'deskripsi' => $data['deskripsi'], 'kategori' => $data['kategori'],'map' => $data['link'],'othergambar' => $b,'otherkategori'=>$c );

echo json_encode($z);
?>