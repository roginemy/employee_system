<?php
  require_once("../includes/config.php");
  require_once '../phpqrcode/qrlib.php';

  if (!isset($_SESSION['admin'])) {
    header("location: ../login.php");
  }


if(isset($_REQUEST['sbt-btn']))
{
$qrimage = time().".png";
$fname = $_REQUEST['fname'];
$lname = $_REQUEST['lname'];
$middle = $_REQUEST['middle'];
$qrtext = $lname.", ".$fname." ".$middle." ";
$department = $_REQUEST['department'];
$date = $_POST['date'];
$month_salary = $_POST['monthly'];

$qrData = $qrtext;



$check = mysqli_query($conn, "SELECT * FROM employees WHERE name='$qrtext' AND department='$department' ");

if (mysqli_num_rows($check) > 0) {
    ?>
        <script>
            alert("Employee credentials exist");
            window.location.href = "add_employee.php";
        </script>
        <?php
}else{
  $query = mysqli_query($conn,"insert into employees set name='$qrtext',department='$department',date_hired='$date',QR_CODE='$qrimage',monthly_salary='$month_salary'");
    if($query)
    {

        $path = '../QR-CODES/';
        $qrcode = $path.date(time()).".png";
        $imgName = date(time()).".png";
        

        ?>
        <script>
            alert("Data save successfully");
            window.location.href = "add_employee.php?img=<?php echo $qrcode ?>";
        </script>
        <?php
        QRcode :: png($qrData, $qrcode, 'H', 5, 5);
        
    }
}


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	<link rel="stylesheet" href="../assets/css/mdb.min.css" />
	<link rel="stylesheet" type="text/css" href="../assets/fontawesome6/css/all.css">
  <script src="../assets/js/sweet.js"></script>
</head>
<body>
  
 <div class="container-fluid">
 <div class="row">
    
    <div class="col-lg-2 bg-danger sticky-top" style="height:100vh;">
    <nav class="nav flex-column  position-relative">
      <h5 class="text-light fw-bold mt-3 nav-link fs-4 mb-3"><i class="fa fa-users"></i> MCC EMPLOYEES MANAGEMENT</h5>
        <a class="nav-link text-light" aria-current="page" href="index.php"><i class="fa fa-home"></i> Home</a>
        <hr class="hr-sm text-light">
        <a class="nav-link text-danger bg-light pt-2" href="employees.php"><i class="fa fa-users"></i> Employees</a>
        <hr class="hr-sm text-light">
        <a class="nav-link active text-light" href="attendance.php"><i class="fa-regular fa-pen-to-square"></i> Attendance</a>
        <hr class="hr-sm text-light">
        <a class="nav-link text-light pt-0 pb-0" href="accounts.php"><i class="fa fa-user"></i> Accounts</a>
        <hr class="hr-sm text-light">
        <a class="nav-link text-light p-2 bg-secondary" href="?logout"><i class="fa fa-sign-out"></i> Logout</a>

        <!-- <a class="nav-link text-light pt-0 pb-0 bg-warning" href="accounts.php"><i class="fa fa-user"></i> Logout</a>
        <hr class="hr-sm text-light"> -->
       
      </nav>
    </div>



    <div class="col-lg-10 p-5 text-light">
     
      <div class="card bg-danger p-3">
        <div class="card-header border-light border-1 ps-0 d-flex align-items-center">
            <h4 class="card-title me-3">Add Employee</h4>
            
        </div>
        <div class="card-body">
        <div class="row d-flex align-items-center pt-5">

            <div class="col-md-7 d-flex justify-content-center">
                <?php 
                if (!isset($_GET['img'])) {
                    ?>
                    <img src="../assets/img/barcode-scan_6221049.png" class="w-50 h-50">
                    <?php
                }else{
                    ?>
                    <img src="<?= $_GET['img'] ?>" class="w-50 h-50">
                    <?php
                }
                ?>

            </div>
            
            <div class="table-responsive col-lg-5 ">  
            <div class="box">
            <form method="post" > 
            <div class="form-group">
            <input type="text" name="fname" id="fname" placeholder="First Name" class="form-control mb-3" />
            <input type="text" name="lname" placeholder="Last Name" class="form-control mb-3">
            <input type="text" name="middle" placeholder="Middle Name" class="form-control mb-3">
            <input type="text" name="department" id="qrtext" placeholder="Department: " class="form-control mb-3" />
            <input type="number" name="monthly" placeholder="Monthly Salary" class="form-control">
            <label for="">Date Hired</label>
            <input type="date" name="date" class="form-control mb-3" />
            </div>
            <div class="form-group">
            <input type="submit" name="sbt-btn" value="Submit" class="btn btn-danger border border-light" />
            </div>
            </form>
            </div>
            </div>  
            </div>
          
        </div>
      </div>

    </div>

    </div>


  </div>
 </div>


<?php 	require_once("../includes/add_employee.php"); ?>
  <script src="./assets/bootstrap/js/bootstrap.bundle.js"></script>
  <script src="./assets/js/jq.min.js"></script>
  <script type="text/javascript" src="./assets/js/mdb.min.js"></script>
  <script src="./assets/js/sweet.js"></script>
</body>
</html>