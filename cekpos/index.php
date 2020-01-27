
<html>
    <head>
        <title>cek ongkir</title>
        
        <!-- Load File bootstrap.min.css yang ada di folder css -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        
        
    </head>
 <!--    <body> -->
        <!-- Membuat Menu Header / Navbar -->
        <!-- <nav class="navbar navbar-inverse" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <center><a class="navbar-brand"  style="color: orange;"><b>CEK ONGKIR</b></a></center>
                </div>
                
            </div>
        </nav>
         -->
        <!-- Isi konten -->

        <body>

 <?php
    $curl = curl_init();    
    curl_setopt_array($curl, array(
      CURLOPT_URL => "http://api.rajaongkir.com/starter/city",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
         "key:17747f157063d9fecc6aebd53cdc5d8e"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

 
   
 
    //Get Data Kabupaten
    ?>
 
    <div class="container">     
        <center><h2><a style="color: orange;"><b>CEK ONGKIR POS</b></a></h2> </center>
        <form id="maskForm" class="form-horizontal" action="hasil.php" method="post" >
            <div class="form-group">
                <label class="control-label col-sm-2" for="nama">Kota Asal Pengirim:</label>
                <div class="col-sm-10">
                    <?php
                    echo "<select  class='form-control' name='asal' id='asal' /required>";
                     echo "<option></option>";
                    $data = json_decode($response, true);
                    for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
                        echo "<option value='".$data['rajaongkir']['results'][$i]['city_id']."'>".$data['rajaongkir']['results'][$i]['city_name']."</option>";
                    } 
                    echo "</select>";
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="alamat">Kota Tujuan Pengirim:</label>
                <div class="col-sm-10">
                    <?php  
                    echo "<select  class='form-control' name='Tujuan' id='asal' /required>";
                    echo "<option></option>";
                    $data = json_decode($response, true);
                    for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
                        echo "<option value='".$data['rajaongkir']['results'][$i]['city_id']."'>".$data['rajaongkir']['results'][$i]['city_name']."</option>";
                    } 
                    echo "</select>";
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="alamat">Berat Kiriman:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" maxlength="5" id="Berat" name="Berat" onkeypress="return hanyaAngka(event)" placeholder="Dalam Gram" /required>
                 
                </div>
            </div>        
            <button type="submit" name="cek" class="btn btn-danger">cek</button>
        </form>     
    </div>
 
<!-- </body> -->
    <script>
        function hanyaAngka(evt) {
          var charCode = (evt.which) ? evt.which : event.keyCode
           if (charCode > 31 && (charCode < 48 || charCode > 57))
 
            return false;
          return true;
        }
    </script>
       

     
        <!-- Load File jquery.min.js yang ada di folder js -->
        <script type="text/javascript" src="js/jquery.min.js"></script>
        
        <!-- Load File jquery.form.js yang ada di folder js -->
        <script type="text/javascript" src="js/jquery.form.js"></script>
        
        <!-- Load File main.js yang ada di folder js -->
        <script type="text/javascript" src="js/main.js"></script>
    </body>
</html>