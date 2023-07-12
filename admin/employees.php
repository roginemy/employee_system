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
           <div class="d-flex justify-content-between mb-3">
           
           <form method="post">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <select name="show" class="form-select">
                        <option value="10">10</option>
                        <option value="50">50</option>
                        <option value="75">75</option>
                        <option value="100">100</option>
                    </select>
                    <button type="submit" name="showBtn" class="btn btn-danger border border-light">Show</button>
                </div>

           </form>

            <form method="post">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <input type="search" name="search" class="form-control" placeholder="Search">
                        <button type="submit" name="searchBtn" class="btn btn-danger border border-light"><i class="fa fa-search"></i>
                    </button>
                </div>
            </form>


           </div>
           <table class="table table-bordered text-light text-center">
                <thead>
                    <th class="p-2">#</th>
                    <th class="p-2">Name</th>
                    <th class="p-2">Department</th>
                    <th class="p-2">Date Hired</th>
                    <th class="p-2">Action</th>
                </thead>
                <tbody>
                    <?php
                        $select = "SELECT * FROM employees LIMIT 10";
                        if (isset($_POST['showBtn'])) {
                            $show = $_POST['show'];

                            $select = "SELECT * FROM employees LIMIT $show ";
                        }

                        if (isset($_POST['searchBtn'])) {
                            $search = $_POST['search'];

                            $select = "SELECT * FROM employees WHERE name LIKE '%$search%' OR department LIKE '%$search%' ";
                        }


                        $result = mysqli_query($conn, $select);
                        if (mysqli_num_rows($result) > 0) {
                            while ($data = mysqli_fetch_assoc($result)) {
                               ?>
                                <tr>
                                    <td class="p-3"><?= $data['id'] ?></td>
                                    <td class="p-3"><?= $data['name'] ?></td>
                                    <td class="p-3"><?= $data['department'] ?></td>
                                    <td class="p-3"><?= $data['date_hired'] ?></td>
                                    <td class="p-2"><a href="view_employee.php?ID=<?php echo $data['id'] ?>" class="btn btn-danger border border-light">View</a></td>
                                </tr>
                               <?php

                               
                            }
                        }else{
                          ?>
                          <tr>
                            <td class=" border-0 col-3">No record found</td>
                          </tr>
                          <?php
                        }
                    ?>
                    
                </tbody>
            </table>
        </div>
      </div>

    </div>

    </div>


  </div>
 </div>
<?php 

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