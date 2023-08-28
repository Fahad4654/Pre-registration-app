<?php
require_once("includes/config.php");
if (!empty($_POST["cid"])) {
	$studentRegno = $_POST["studentregno"];
    $cid = $_POST["cid"];

    $result = mysqli_query($bd, "SELECT * FROM courseenrolls WHERE studentRegno='$studentRegno' AND course='$cid'");
    $count = mysqli_num_rows($result);

    $result1 = mysqli_query($bd, "SELECT noofSeats FROM course WHERE id='$cid'");
    $row = mysqli_fetch_array($result1);
    $noofseat = $row['noofSeats'];

    $result2 = mysqli_query($bd, "SELECT courseUnit FROM course WHERE id='$cid'");
    $row = mysqli_fetch_array($result2);
    $noofenrolled = $row['courseUnit'];

    if ($count > 0) {
        echo "<span style='color:red'> Already Applied for this course.</span>";
        echo "<script>$('#submit').prop('disabled', true);</script>";
    } elseif ($noofenrolled >= $noofseat) {
        echo "<span style='color:red'> Seat not available for this course. All Seats Are full.</span>";
        echo "<script>$('#submit').prop('disabled', true);</script>";
    } else {
        echo "<span style='color:green'> Course is available and seats are open.</span>";
        echo "<script>$('#submit').prop('disabled', false);</script>";
    }
}
?>