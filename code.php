<?php
include 'components/connect.php';

if (isset($_POST['update_schedule'])) {
    $item_id = $_POST['item_id'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    
    $weight = $_POST['weight'];

    // Update item_types table
    $update_item_types = $conn->prepare("UPDATE item_types SET name=?, description=?, weight=? WHERE id=?");
    $update_item_types->execute([$type, $description, $weight, $item_id]);

    $_SESSION['message'] = "Updated successfully";
    header('Location: schedulling.php');
    exit(0);
}
?>
