<?php
	$asal = $_POST['asal'];
	$tujuan = $_POST['Tujuan'];
	$berat = $_POST['Berat'];
    $kurir ="pos";
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "origin=".$asal."&destination=".$tujuan."&weight=".$berat."&courier=".$kurir."",
	  CURLOPT_HTTPHEADER => array(
	    "content-type: application/x-www-form-urlencoded",
	   "key:17747f157063d9fecc6aebd53cdc5d8e"
	  ),
	));
 
	$response = curl_exec($curl);
	$err = curl_error($curl);
 
	curl_close($curl);
 
	if ($err) {	  echo "cURL Error #:" . $err;
	} else {
	  //echo $response;
	   $data = json_decode($response, true);
	}
	
?>

<!DOCTYPE html>

<html>
<head>
	<title>ongkir</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
</head>
<body>
   <div class="container"> 
	 <center><h2><a style="color: orange;"><b>Hasil cek ongkir POS (<?php echo $data['rajaongkir']['origin_details']['city_name'];?> ke <?php echo $data['rajaongkir']['destination_details']['city_name'];?>)</b></a></h2> </center>  
	<div class="table-responsive">
	 <div title="<?php echo strtoupper($data['rajaongkir']['results'][$i]['name']);?>" style="padding:10px">
 <table class="table table-bordered table-striped table-hover">
 <tr style="background-color: orange;">
 <th>PROVINSI</th>
 <th>KOTA/KABUPATEN ASAL PENGIRIM</th>
 <th>KODE POS</th>

 </tr>

 <tr>

 <td align="center">&nbsp;<?php echo $data['rajaongkir']['origin_details']['province'];?></td>
<td align="center"><?php echo $data['rajaongkir']['origin_details']['type'];?> <?php echo $data['rajaongkir']['origin_details']['city_name'];?></td>

 <td align="center">&nbsp;<?php echo $data['rajaongkir']['origin_details']['postal_code'];?></td>
 
 </tr>
 <?php
 
 ?>
 </table>
 </div>
 </div>

 <div class="table-responsive">

<div title="<?php echo strtoupper($data['rajaongkir']['results'][$i]['name']);?>" style="padding:10px">
 <table class="table table-bordered table-striped table-hover">
 <tr style="background-color: orange;">
 <th>PROVINSI</th>
 <th>KOTA/KABUPATEN TUJUAN PENGIRIM</th>
 <th>KODE POS</th>

 </tr>

 <tr>
 <td align="center">&nbsp;<?php echo $data['rajaongkir']['destination_details']['province'];?></td>
<td align="center"> <?php echo $data['rajaongkir']['destination_details']['type'];?> <?php echo $data['rajaongkir']['destination_details']['city_name'];?></td>

 <td align="center">&nbsp;<?php echo $data['rajaongkir']['destination_details']['postal_code'];?></td>
 
 </tr>
 <?php
 
 ?>
 </table>
 </div>
 </div>

 <div class="table-responsive">
<?php
 for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
 ?>
 <div title="<?php echo strtoupper($data['rajaongkir']['results'][$i]['name']);?>" style="padding:10px">
 <table class="table table-bordered table-striped table-hover">
 <tr style="background-color: orange;">
 <th>No</th>
 <th>Jenis Layanan</th>
 <th>Estimasi</th>
 <th>Tarif</th>
 </tr>
 <?php
 for ($j=0; $j < count($data['rajaongkir']['results'][$i]['costs']); $j++) {
 # code...
 ?>
 <tr>
 <td><?php echo $j+1;?></td>
 <td>
 <div style="font:bold 16px Arial"><?php echo $data['rajaongkir']['results'][$i]['costs'][$j]['service'];?></div>
 <div style="font:normal 11px Arial"><?php echo $data['rajaongkir']['results'][$i]['costs'][$j]['description'];?></div>
 </td>
 <td align="center">&nbsp;<?php echo $data['rajaongkir']['results'][$i]['costs'][$j]['cost'][0]['etd'];?></td>
 <td align="right"><?php echo number_format($data['rajaongkir']['results'][$i]['costs'][$j]['cost'][0]['value']);?></td>
 </tr>
 <?php
 }
 ?>
 </table>
 <?php
 }
 
 ?>
		</div>	
		 
	</div>
	<a href="index.php"> <button type="submit" class="btn btn-danger">Kembali</button></a>

</body>
</html>
              