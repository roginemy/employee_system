<?php
    require_once("./includes/config.php");
    if (isset($_SESSION['employee'])) {
        header("location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="./assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./assets/css/style.css">
	<link rel="stylesheet" href="./assets/css/mdb.min.css" />
	<link rel="stylesheet" type="text/css" href="./assets/fontawesome6/css/all.css">
    <script src="./assets/js/sweet.js"></script>
	
</head>
<body>

    <div style="height: 100vh;" class="d-flex justify-content-center container-fluid align-items-center">

<div class="row">
  <div class="col-lg-3 d-flex align-items-center">
    <div>
    <h1 >Attendance</h1>
    <p>Please use your QR Code to record attendance</p>
    </div>
  </div>
  <div class="col-lg-9">
  <video id="preview" width="100%" height="100%"></video>
 
 <form action="" method="post">
         <input type="hidden" name="code" id="text" placeholder="Scan QR code" class="form-control">
 </form>
  </div>
</div>

</div>


    <?php require_once("./includes/add_attendance.php"); ?>
    <script src="./assets/js/instascan.min.js"></script>
    <script src="./assets/js/jq.min.js"></script>
    <script>
        let scanner = new Instascan.Scanner({ video: document.getElementById("preview")});
        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            }else{
                alert("Camera not activated")
            }
        }).catch(function(e){
            console.error(e);
        })

        scanner.addListener("scan", function(c){
            document.getElementById("text").value=c;
            document.forms[0].submit();
        })
    </script>
</body>
</html>