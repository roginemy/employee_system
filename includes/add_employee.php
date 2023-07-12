<?php
if(isset($_REQUEST['sbt-btn']))
{
$qrimage = time().".png";
$fname = $_REQUEST['fname'];
$lname = $_REQUEST['lname'];
$middle = $_REQUEST['middle'];
$qrtext = $lname.", ".$fname." ".$middle." ";
$department = $_REQUEST['department'];
$date = $_POST['date'];

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
    $query = mysqli_query($conn,"insert into employees set name='$qrtext',department='$department',date_hired='$date',QR_CODE='$qrimage'");
    if($query)
    {

        $path = '../QR-CODES/';
        $qrcode = $path.date(time()).".png";
        

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