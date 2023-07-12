<?php
  require_once("../includes/config.php");
  if (!isset($_SESSION['admin'])) {
    header("location: ../login.php");
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
    
    <div class="col-lg-2 bg-danger sticky-top d-lg-block d-none" style="height:100vh;">
    <nav class="nav flex-column  position-relative">
      <h5 class="text-light fw-bold mt-3 nav-link fs-4 mb-3"><i class="fa fa-users"></i> MCC EMPLOYEES MANAGEMENT</h5>

        <a class="nav-link active text-danger bg-light pt-2" aria-current="page" href="index.php"><i class="fa fa-home"></i> Home</a>
        <hr class="hr-sm text-light">
        <a class="nav-link text-light pt-0 pb-0" href="employees.php"><i class="fa fa-users"></i> Employees</a>
        <hr class="hr-sm text-light">
        <a class="nav-link text-light pt-0 pb-0" href="attendance.php"><i class="fa-regular fa-pen-to-square"></i> Attendance</a>
        <hr class="hr-sm text-light">
        <a class="nav-link text-light pt-0 pb-0" href="accounts.php"><i class="fa fa-user"></i> Accounts</a>
        <hr class="hr-sm text-light">
        <a class="nav-link text-light p-2 bg-secondary" href="?logout"><i class="fa fa-sign-out"></i> Logout</a>
      </nav>
    </div>

    <div class="col-lg-10 p-5">

    <div class="row">


      <?php
          $select_emp = "SELECT COUNT(*) AS COUNT_EMP FROM employees";
          $result_emp = mysqli_query($conn, $select_emp);
          $cnt_emp = mysqli_fetch_assoc($result_emp);
      ?>
      <div class="col-lg-4">
        <a href="employees.php">
        <div class="card p-3 bg-danger text-light">
        <div class="card-body">
        <i class="fa fa-users fs-1 float-end"></i>
        <h5>Employees</h5>
         <span><?= $cnt_emp['COUNT_EMP'] ?> Record(s)</span>
        </div>
        </div>
        </a>
      </div>

      <?php
          $select_acc = "SELECT COUNT(*) AS COUNT_ACC FROM users";
          $result_acc = mysqli_query($conn, $select_acc);
          $cnt_acc = mysqli_fetch_assoc($result_acc);
      ?>
      <div class="col-lg-4">
        <a href="accounts.php">
        <div class="card p-3 bg-danger text-light">
        <div class="card-body">
        <i class="fa fa-user fs-1 float-end"></i>
        <h5>Accounts</h5>
        <span><?= $cnt_acc['COUNT_ACC'] ?> Record(s)</span>
        </div>
        </div>
        </a>
      </div>


      <?php
          $select_att = "SELECT COUNT(*) AS COUNT_ATT FROM attendance";
          $result_att = mysqli_query($conn, $select_att);
          $cnt_att = mysqli_fetch_assoc($result_att);
      ?>
      <div class="col-lg-4">
        <a href="attendance.php">
        <div class="card p-3 bg-danger text-light">
        <div class="card-body">
        <i class="fa fa-user fs-1 float-end"></i>
        <h5>Recorded Attendance</h5>
        <span><?= $cnt_att['COUNT_ATT'] ?> Record(s)</span>
        </div>
        </div>
        </a>
      </div>


    </div>

    </div>


  </div>
 </div>


<?php require_once("../includes/logout.php") ?>
  <script src="../assets/bootstrap/js/bootstrap.bundle.js"></script>
  <script src="../assets/js/jq.min.js"></script>
  <script src="../assets/js/mdb.min.js"></script>
  <script src="../assets/js/sweet.js"></script>
  <script>
    
  </script>
</body>
</html>