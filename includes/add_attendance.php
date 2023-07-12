<?php
if (isset($_POST['code'])) {
    $code = $_POST['code'];

    $select = "SELECT * FROM employees WHERE name='$code'";
	$result = $conn->query($select);
	$emp_data = mysqli_fetch_assoc($result);

	$employee_id = $emp_data['id'];

	if ($result->num_rows > 0) {
		date_default_timezone_set("Asia/Manila");
    	$today = date("Y-m-d", time());
		$attexndance_se = "SELECT * FROM attendance WHERE employee_id='$employee_id' ORDER BY id DESC ";
		$query = mysqli_query($conn, $attexndance_se);
		$data = mysqli_fetch_assoc($query);
		
		$time = date("h:i:s", time());

		if ($data['time_in'] == "") {


			$insert = "INSERT INTO attendance(employee_id,time_in,date) VALUES('$employee_id','$time','$today')";
			mysqli_query($conn, $insert);

			?>

			<script type="text/javascript">
						let timerInterval
						Swal.fire({
							icon: 'success',
						title: 'Time in recorded',
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
							window.location.href = "index.php";
						}
						})
			</script>
		<?php

		}elseif($data['time_in'] != "00:00:00" && $data['time_out'] == "00:00:00"){
			$update = "UPDATE attendance SET time_out='$time' WHERE employee_id='$employee_id' ";
			mysqli_query($conn, $update);

			?>

			<script type="text/javascript">
						let timerInterval
						Swal.fire({
							icon: 'success',
						title: 'Time out recorded',
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
							window.location.href = "index.php";
						}
						})
			</script>
		<?php

		}elseif($data['time_in'] != "00:00:00" && $data['time_out'] != "00:00:00" && $data['date'] != $today){
		


				$insert = "INSERT INTO attendance(employee_id,time_in,date) VALUES('$employee_id','$time','$today')";
				mysqli_query($conn, $insert);
	
				?>
	
				<script type="text/javascript">
							let timerInterval
							Swal.fire({
								icon: 'success',
							title: 'Time in recorded',
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
								window.location.href = "index.php";
							}
							})
				</script>
			<?php
	
		if($data['time_in'] != "00:00:00" && $data['time_out'] == "00:00:00"){
				$update = "UPDATE attendance SET time_out='$time' WHERE employee_id='$employee_id' ";
				mysqli_query($conn, $update);
	
				?>
	
				<script type="text/javascript">
							let timerInterval
							Swal.fire({
								icon: 'success',
							title: 'Time out recorded',
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
								window.location.href = "index.php";
							}
							})
				</script>
			<?php
	
			}
		}else{
			?>
				<script type="text/javascript">
							let timerInterval
							Swal.fire({
								icon: 'warning',
							title: 'Attendance for today been fulfilled',
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
								window.location.href = "index.php";
							}
							})
				</script>
			<?php
		}

		

		

	}else{

		?>

			<script type="text/javascript">
						let timerInterval
						Swal.fire({
							icon: 'warning',
						title: 'Only authorized personel is allowed to use this scanner',
						html: 'automatically close in <b></b> milliseconds.',
						timer: 2000,
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
							window.location.href = "index.php";
						}
						})
			</script>
		<?php

	}

}