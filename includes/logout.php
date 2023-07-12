<?php
if (isset($_GET['logout'])) {
	
session_unset();


?>
		<script type="text/javascript">
						let timerInterval
						Swal.fire({
							icon: 'success',
						title: 'Logged out successfully',
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