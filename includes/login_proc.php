<?php

if (isset($_POST['qrCode'])) {
    $userQR = $_POST['qrCode'];

      $select = "SELECT * FROM employees WHERE name='$userQR' ";
      $result = mysqli_query($conn, $select);
	  
        if (mysqli_num_rows($result) > 0) {

         $data = mysqli_fetch_assoc($result);

            $_SESSION['employee'] = $data['id'];
            ?>
            <script type="text/javascript">
						let timerInterval
						Swal.fire({
							icon: 'success',
						title: 'Successfully signed in',
						html: 'automatically close in <b></b> milliseconds.',
						timer: 1000,
						timerProgressBar: true,
						didOpen: () => {
							Swal.showLoading()
							const b = Swal.getHtmlContainer().querySelector('b')
							timerInterval = setInterval(() => {
							b.textContent = Swal.getTimerLeft()
							}, 100)
						},
						willClose: () => {
							clearInterval(timerInterval)
							window.location.href = "./employees/index.php";
						}
						})
			</script>
          <?php
         }
        

  } 


  if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password' ");
	if (mysqli_num_rows($check) > 0) {
		$data = mysqli_fetch_assoc($check);

		$_SESSION['admin'] = $data['user_id'];
		?>
		<script type="text/javascript">
						let timerInterval
						Swal.fire({
							icon: 'success',
						title: 'Welcome Admin',
						html: 'automatically close in <b></b> milliseconds.',
						timer: 1000,
						timerProgressBar: true,
						didOpen: () => {
							Swal.showLoading()
							const b = Swal.getHtmlContainer().querySelector('b')
							timerInterval = setInterval(() => {
							b.textContent = Swal.getTimerLeft()
							}, 100)
						},
						willClose: () => {
							clearInterval(timerInterval)
							window.location.href = "./admin/index.php";
						}
						})
			</script>
		<?php

	}else{
		?>
		<script type="text/javascript">
						let timerInterval
						Swal.fire({
							icon: 'warning',
						title: 'Only admin can access this page',
						html: 'automatically close in <b></b> milliseconds.',
						timer: 1000,
						timerProgressBar: true,
						didOpen: () => {
							Swal.showLoading()
							const b = Swal.getHtmlContainer().querySelector('b')
							timerInterval = setInterval(() => {
							b.textContent = Swal.getTimerLeft()
							}, 100)
						},
						willClose: () => {
							clearInterval(timerInterval)
							window.location.href = "../login.php";
						}
						})
			</script>
		<?php
	}

  }