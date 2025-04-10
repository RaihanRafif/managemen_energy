<?php

include('../../database/config.php');

function getEventData($conn)
{
    $today = date('Y-m-d'); // Format: 2025-04-10
    $sql = "SELECT * FROM event WHERE DATE(timestamp) = '$today' ORDER BY timestamp DESC";
    $result = $conn->query($sql);
    $events = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
    }

    return $events;
}


$data = array();
$data['event'] = getEventData($conn);

$conn->close();

header('Content-Type: application/json');
echo json_encode($data);
