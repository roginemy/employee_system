<?php
  require_once("./includes/config.php");
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
        <div class="col-lg-5 d-flex align-items-center">
          <div>
          <h1 >Sign In</h1>
          <p>Please use your QR Code to sign in if you are an employee.</p>
          <p class="text-warning">Note: Please hold steady your code to scan faster</p>
          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#login">Login as admin</button> 
          </div>
        </div>
        <div class="col-lg-7">
        <video id="preview" width="100%" height="100%"></video>
       
       <form action="" method="post">
               <input type="hidden" name="qrCode" id="text" placeholder="Scan QR code" class="form-control">
       </form>
        </div>

        

      </div>
      

    </div>

    <?php  require_once("./includes/login_proc.php"); ?>

    <div class="modal fade" id="login">
      <div class="modal-dialog">
        <div class="modal-content">
        <form method="post" class="p-3">
      <div class="card-header mb-3">
        <h3 class="card-title pb-2">Sign In as Admin</h3>
      </div>
     <!-- Email input -->
     <div class="form-outline mb-4">
       <i class="fas fa-envelope trailing"></i>
       <input type="text" id="loginName" class="form-control form-icon-trailing" name="username" />
       <label class="form-label" for="loginName">username</label>
     </div>

     <!-- Password input -->
     <div class="form-outline mb-4">
        <i class="fas fa-lock trailing"></i>
       <input type="password" id="loginPassword" class="form-control form-icon-trailing" name="password" />
       <label class="form-label" for="loginPassword">Password</label>
     </div>

     <!-- 2 column grid layout -->
     <div class="row mb-4">
       <div class="col-md-6 d-flex justify-content-center">
         <!-- Checkbox -->
         <div class="form-check mb-3 mb-md-0">
           <input class="form-check-input" type="checkbox" value="" id="loginCheck"  checked />
           <label class="form-check-label" for="loginCheck"> Remember me </label>
         </div>
       </div>

       <div class="col-md-6 d-flex justify-content-center">
         <!-- Simple link -->
         <a href="#!">Forgot password?</a>
               </div>
           </div>

           <!-- Submit button -->
           <button type="submit" class="btn btn-primary btn-block mb-4" name="login">Sign in</button>

           <!-- Register buttons -->
   </form>
        </div>
      </div>
    </div>


  <script src="./assets/bootstrap/js/bootstrap.bundle.js"></script>
  <script src="./assets/js/jq.min.js"></script>
  <script type="text/javascript" src="./assets/js/mdb.min.js"></script>
  <script src="./assets/js/sweet.js"></script>
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