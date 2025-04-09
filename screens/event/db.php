<?php

include('../../database/config.php');

function getEventData($conn)
{
    $sql = "SELECT * FROM event ORDER BY timestamp DESC";
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
