<?php

// Make a database connection
try {
    $db = new PDO('mysql:host=localhost;dbname=projet', 'root', '');
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}


// Prepare a SQL query to fetch events from the schedule table, including the name of the item_type
$query = $db->prepare("SELECT s.id, i.name as item_type_name, s.collection_date, s.collection_time, s.location FROM schedule s INNER JOIN item_types i ON s.item_type_id = i.id");

// Execute the query and fetch the results
$query->execute();
$results = $query->fetchAll(PDO::FETCH_ASSOC);

// Define an empty array to hold the events data
$events = array();

// Loop through the results and create an event object for each row
foreach ($results as $row) {
    $event = array();
    $event['id'] = $row['id'];
    $event['title'] = $row['item_type_name'];
    $event['start'] = date('Y-m-d H:i:s', strtotime($row['collection_date'] . ' ' . $row['collection_time']));
    $event['location'] = $row['location'];
    $events[] = $event;
}

// Convert the events array to JSON format
$json = json_encode($events);

// Output the JSON data
header('Content-Type: application/json');
echo $json;
?>
