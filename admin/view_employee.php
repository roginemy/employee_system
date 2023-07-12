<?php
  require_once("../includes/config.php");
  require_once '../phpqrcode/qrlib.php';
  if (!isset($_SESSION['admin'])) {
    header("location: ../login.php");
  }

  @$ID = $_GET['ID'];

  $select_emp = mysqli_query($conn, "SELECT * FROM employees WHERE ID='$ID'");
  $emp_data = mysqli_fetch_assoc($select_emp);

  $select_attendance = mysqli_query($conn,"SELECT COUNT(*) AS att_record FROM attendance WHERE employee_id='".$emp_data['id']."' ");
  $att_data = mysqli_fetch_assoc($select_attendance);

  $month_sal = number_format($emp_data['monthly_salary']);

  $daily = number_format($emp_data['monthly_salary'] / 30);

  // $total = number_format($att_data['att_record']*$daily);

  $hrs_work = 8;

  $hrs_pay = number_format($daily / $hrs_work);

  $total = $att_data['att_record'] * $hrs_pay;



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
        <a class="nav-link text-light" aria-current="page" href="index.php"><i class="fa fa-home"></i> Home</a>
        <hr class="hr-sm text-light">
        <a class="nav-link active text-danger bg-light pt-2" href="employees.php"><i class="fa fa-users"></i> Employees</a>
        <hr class="hr-sm text-light">
        <a class="nav-link text-light pt-0 pb-0" href="attendance.php"><i class="fa-regular fa-pen-to-square"></i> Attendance</a>
        <hr class="hr-sm text-light">
        <a class="nav-link text-light pt-0 pb-0" href="accounts.php"><i class="fa fa-user"></i> Accounts</a>
        <hr class="hr-sm text-light">
        <a class="nav-link text-light p-2 bg-secondary" href="?logout"><i class="fa fa-sign-out"></i> Logout</a>
      
       
      </nav>
    </div>



    <div class="col-lg-10 p-5 text-light">
     
      <div class="card bg-danger p-3">
        <div class="card-header border-light border-1 ps-0 d-flex align-items-center">
            <h4 class="card-title me-3">Employees</h4>
            <a href="add_employee.php" class="btn btn-danger border border-light px-3"><i class="fa fa-plus fs-6"></i></a>
        </div>
        <div class="card-body">
        <section class="section profile">
  <div class="row">
    <div class="col-xl-4">

      <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

        <div  style="width: 300px; height: 300px; background-image: url(../QR-CODES/<?php echo $emp_data['QR_CODE'] ?>); background-size: cover; background-repeat: no-repeat; background-position: center;">
                               
                               </div>   
          <h2 class="fs-5 text-capitalize text-dark"><?php echo $emp_data['name'] ?></h2>
          <div class="social-links mt-2">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
      </div>

    </div>

    <div class="col-xl-8">

      <div class="card">
        <div class="card-body pt-3">
          <!-- Bordered Tabs -->
          <ul class="nav nav-tabs nav-tabs-bordered">

            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Salary</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Attendance</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#update-employee">Update Info</button>
            </li>

          </ul>
          <div class="tab-content pt-2">

            <div class="tab-pane fade show active profile-overview" id="profile-overview">

              <h5 class="card-title pt-2 text-dark">Profile Details</h5>

              <div class="row">
                <div class="col-lg-3 col-md-4 label mb-lg-2 text-capitalize text-dark">Full Name</div>
                <div class="col-lg-9 col-md-8 text-capitalize text-dark"><?= $emp_data['name'] ?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label text-capitalize text-dark">Date Hired</div>
                <div class="col-lg-9 col-md-8 text-capitalize text-dark"><?= date("M d,Y", strtotime($emp_data['date_hired'])) ?></div>
              </div>


            </div>

            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

<!-- Profile Edit Form -->

<div class="card text-center shadow-0">
<div class="card-header mb-0 text-dark border-0">Monthly / Daily / Hours / Total</div>
<hr class="hr">
  <div class="card-body">
      <h5 class="card-title text-dark">₱ <?= $month_sal ?> / <?= $daily ?> / <?= $hrs_pay ?> / <?= $total ?></h5>
  </div>
  
  </div>
<hr class="hr">

  <h5 class="card-title  text-dark">Salary History</h5>
<div class="table-responsive">
<table class="table table-striped table-hover table-bordered table-sm  text-center">
  <thead>
  <tr>
      <th scope="col">Total Salary</th>
      <th scope="col">Date</th>
  </tr>

  </thead>
  <tbody>

  <?php 
  $select_salary = mysqli_query($conn, "SELECT * FROM salary WHERE employee_id='".$emp_data['id']."' ORDER BY id DESC ");
      if (mysqli_num_rows($select_salary) > 0) {
          while ($salary = mysqli_fetch_assoc($select_salary)) {
             ?>
              <tr>
                  <th scope="row"><?= $salary['total_salary'] ?></th>
                  <td><?= $salary['date'] ?></td>
              </tr>
             <?php
          }
      }else{
          ?>
          <tr>
              <td class="border-0">No records found</td>
          </tr>
          <?php
      }
 ?>
  
  </tbody>

</table>
</div>


</div>

            <div class="tab-pane fade" id="profile-settings">
                
            <!-- Profile Edit Form -->
 
            <div class="card shadow-0">
            <h5 class="card-title  text-dark">Overall Attendance</h5>
            <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered table-sm  text-center">
                <thead>
                <tr>
                    <th scope="col">Time In</th>
                    <th scope="col">Time Out</th>
                    <th scope="col">Date</th>
                </tr>
              
                </thead>
                <tbody>

                <?php 
                $select_attAll = mysqli_query($conn, "SELECT * FROM attendance WHERE employee_id='".$emp_data['id']."' ORDER BY id DESC ");
                    if (mysqli_num_rows($select_attAll) > 0) {
                        while ($all_attendance = mysqli_fetch_assoc($select_attAll)) {
                           ?>
                            <tr>
                                <th scope="row"><?= $all_attendance['time_in'] ?></th>
                                <td><?= $all_attendance['time_out'] ?></td>
                                <td><?= $all_attendance['date'] ?></td>
                            </tr>
                           <?php
                        }
                    }else{
                        ?>
                        <tr>
                            <td class="border-0">No records found</td>
                        </tr>
                        <?php
                    }
               ?>
                
                </tbody>

            </table>
            </div>
        
                        
            </div>
            </div>
            <div class="tab-pane fade profile-overview" id="update-employee">

           <form method="post">
              <h5 class="card-title pt-2 text-dark">Update Info</h5>

                <div class="form-outline mb-3 mt-3">
                  <input type="text" id="form12" class="form-control" name="name" value="<?= $emp_data['name'] ?>" />
                  <label class="form-label" for="form12">Name</label>
                </div>

                <div class="form-outline mb-3">
                  <input type="text" id="form12" class="form-control" name="department" value="<?= $emp_data['department'] ?>" />
                  <label class="form-label" for="form12">Department</label>
                </div>

                <div class="form-outline mb-3">
                  <input type="date" id="form12" class="form-control" name="hired" value="<?= $emp_data['date_hired'] ?>" />
                  <label class="form-label" for="form12">Date Hired</label>
                </div>

                <div class="form-outline mb-3">
                  <input type="number" id="form12" class="form-control" name="monthly" value="<?= $emp_data['monthly_salary'] ?>" />
                  <label class="form-label" for="form12">Monthly Salary</label>
                </div>
                    <input type="hidden" name="ID" value="<?= $ID ?>">
                <div class=" mb-3">
                  <button type="submit" name="save" class="form-control btn btn-danger">Save Changes</button>
                </div>

                <p class="text-dark">QR Code will automatically update, depends on the name of the employee</p>
            </form>


            </div>

          </div><!-- End Bordered Tabs -->

        </div>
      </div>

    </div>
  </div>
</section>
        </div>
      </div>

    </div>

    </div>


  </div>
 </div>
<?php 
  require_once("../includes/update_info.php");
require_once("../includes/logout.php");
 ?>

 <script src="../assets/bootstrap/js/bootstrap.bundle.js"></script>
  <script src="../assets/js/jq.min.js"></script>
  <script type="text/javascript" src="../assets/js/mdb.min.js"></script>
  <script src="../assets/js/sweet.js"></script>

  <script>


    let spans = document.querySelectorAll("#sidenav span");
    function toggleSidenav(){
      Array.from(spans).forEach( span => {

          if (span.classList.contains("d-none")) {
            span.classList.remove("d-none");
            span.classList.add("effects")
          }else{
            span.classList.add("d-none")
          }

        });

    }

  </script>
</body>
</html>