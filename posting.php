<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
	$response = array();
	//mendapatkan data
	$npm = $_POST['npm'];
	$nama = $_POST['nama'];
	$kelas = $_POST['kelas'];
	$sesi = $_POST['sesi'];

	required_once('dbConnect.php');
	//Cek npm sudah terdaftar apa belom
	$sql = "SELECT * FROM mahasiswa WHERE npm = '$npm'";
	$check = mysqli_fetch_array(mysql_query($con,$sql));
	if (isset($check)){
		$response["value"]=0;
		$response["message"]= "oops! NPM sudah terdaftar!";
		echo json_encode($response);
	} else {
		$sql = "INSERT INTO mahasiswa (npm,nama,kelas,sesi) VALUE ('$npm','$nama', '$kelas','$sesi')";
		if (msqli_query($con,$sql)){
			$response["value"] = 1;
			$response["message"] = "SUKSES MENDAFTAR";
			echo json_encode($response);
		} else {
			$response["value"] = 0;
			$response["message"] = "oops! coba lagi!";
			echo json_encode($response);
		}
	}
	//tutup database
	mysqli_close($con);
} else {
	$response["value"] = 0;
	$response["message"] = "oops! coba lagi!";
	echo json_encode($response);
}