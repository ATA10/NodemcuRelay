<?php
	include('inc/config.php');
$veri = $_POST['data'];
$veri = explode("|", $veri);
$tarih = date('d.m.Y H:i:s');

	$con=mysqli_connect("localhost","root","","espdemo");
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }

	// INSERT
	
	$status = $veri[0];
	$tarih = $veri[1];
	mysqli_query($con,"INSERT INTO logs (status,Date) 
	VALUES ('$status','$tarih')") or die(mysqli_error($con));
	
	/*/********** SELECT * FROM ****************************/
	
	$ip = "http://192.168.1.8/";
			$sorgu = DB::getRow('SELECT * FROM kullanici WHERE pw = ?', array($status));
		if(isset($status))
		{
			   if($sorgu->pw != $status)  {
					echo file_get_contents($ip . "kapi_kapat");
				}
			   else if($sorgu->pw == $status) {
				
					echo file_get_contents($ip . "kapi_ac");
				}
				else {
					echo file_get_contents($ip . "kapi_durum");
			  
				}
		}
	
	mysqli_close($con);
	
?>