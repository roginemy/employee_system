<?php
if (isset($_POST['save'])) {
    $ID = $_POST['ID'];
    $name = $_POST['name'];
    $dept = $_POST['department'];
    $hired = $_POST['hired'];
    $monthly = $_POST['monthly'];
    $qrData = $name;
    $qrimage = time().".png";
    $path = '../QR-CODES/';
    $qrcode = $path.date(time()).".png";
    $imgName = date(time()).".png";
   


    $query = mysqli_query($conn,"update employees set name='$name',department='$dept',date_hired='$hired',QR_CODE='$qrimage',monthly_salary='$monthly' WHERE id='$ID' ");

   if ($query) {
    ?>
    <script type="text/javascript">
                    let timerInterval
                    Swal.fire({
                        icon: 'success',
                    title: 'Employee updated successfully',
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
                        window.location.href = "view_employee.php?ID=<?php echo $ID ?>";
                    }
                    })
        </script>
    <?php

    QRcode :: png($qrData, $qrcode, 'H', 5, 5);
   }

}