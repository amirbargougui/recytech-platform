<?php
session_start();
include 'components/connect.php';

if (isset($_POST['update_scheduling'])) {
    $schedule_id = $_POST['schedule_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];

    // Update schedule table
    $update_schedule = $conn->prepare("UPDATE schedule SET collection_date=?, collection_time=?, location=? WHERE id=?");
    $update_schedule->execute([$date, $time, $location, $schedule_id]);

    // Set success message and redirect to management page
    $_SESSION['message'] = "Updated successfully";
    header('Location: Management_schedule.php');
    exit(0);
}
?>


