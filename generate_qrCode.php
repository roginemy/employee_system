<?php 
	require_once './includes/config.php';
	require_once 'phpqrcode/qrlib.php';
	require_once("./includes/generate_qr.php");
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="./assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./assets/css/style.css">
	<link rel="stylesheet" href="./assets/css/mdb.min.css" />
	<link rel="stylesheet" type="text/css" href="./assets/fontawesome6/css/all.css">
	<script src="./assets/js/qrScript.js"></script>
</head>
<body>
	<div class="container " >    
		<div class="row d-flex align-items-center" style="height: 100vh;">

		<div class="col-md-7 d-flex justify-content-center">
			<?php 
			if (!isset($_GET['img'])) {
				?>
				<img src="./assets/img/barcode-scan_6221049.png" class="w-50 h-50">
				<?php
			}else{
				?>
				<img src="<?php echo $_GET['img'] ?>" class="w-50 h-50">
				<?php
			}
			?>
	
		</div>
	      
   <div class="table-responsive col-md-5 ">  
    <h3 align="center">Add Employee</h3><br/>
    <div class="box">
     <form method="post" > 
      <div class="form-group">
         <input type="text" name="fname" id="fname" placeholder="First Name" class="form-control mb-3" />
         <input type="text" name="lname" placeholder="Last Name" class="form-control mb-3">
         <input type="text" name="middle" placeholder="Middle Name" class="form-control mb-3">
          <input type="text" name="department" id="qrtext" placeholder="Department: " class="form-control mb-3" />
      </div>
      <div class="form-group">
       <input type="submit" name="sbt-btn" value="Submit" class="btn btn-success" />
      </div>
     </form>
    </div>
   </div>  
		</div>
  </div>

	<script src="./assets/bootstrap/js/bootstrap.bundle.js"></script>
	<script src="./assets/js/jq.min.js"></script>
	<script type="text/javascript" src="./assets/js/mdb.min.js"></script>
  	<script src="./assets/js/sweet.js"></script>

</body>
</html>