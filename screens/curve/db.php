<?php

include('../../database/config.php');

// Function to fetch the latest data from the sunny_boy table
function getLatestDataString($conn)
{
    $sql = "SELECT timestamp, P_str1, P_str2, P_str3, P_str4, Pdc_total
            FROM sunny_boy 
            WHERE MONTH(timestamp) = MONTH(CURRENT_DATE()) 
            AND YEAR(timestamp) = YEAR(CURRENT_DATE())";

    $result = $conn->query($sql);
    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}

function getLatestDataAnalysis($conn)
{
    $sql = "SELECT timestamp, Pac
            FROM pv 
            WHERE MONTH(timestamp) = MONTH(CURRENT_DATE()) 
            AND YEAR(timestamp) = YEAR(CURRENT_DATE())";

    $result = $conn->query($sql);
    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}

// Function to fetch data based on a specific date or month
function getPvData($conn, $date)
{
    $data = [];

    // Check if the input is a full date (YYYY-MM-DD) or a month (YYYY-MM)
    if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
        // If input is a specific date, fetch data for that date
        $sql = "SELECT timestamp, P_str1, P_str2, P_str3, P_str4, Pdc_total FROM sunny_boy WHERE DATE(timestamp) = ?";
    } elseif (preg_match('/^\d{4}-\d{2}$/', $date)) {
        // If input is a month, fetch data for that month
        $sql = "SELECT timestamp, P_str1, P_str2, P_str3, P_str4, Pdc_total FROM sunny_boy WHERE DATE_FORMAT(timestamp, '%Y-%m') = ?";
    } else {
        return getPvData($conn, date('Y-m'));
    }

    // Prepare and execute statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $date);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $stmt->close();



    return $data;
}

function getPvDataAnalysis($conn, $date)
{
    $data = [];

    // Check if the input is a full date (YYYY-MM-DD) or a month (YYYY-MM)
    if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
        // If input is a specific date, fetch data for that date
        $sql = "SELECT timestamp, Pac FROM pv WHERE DATE(timestamp) = ?";
    } elseif (preg_match('/^\d{4}-\d{2}$/', $date)) {
        // If input is a month, fetch data for that month
        $sql = "SELECT timestamp, Pac FROM pv WHERE DATE_FORMAT(timestamp, '%Y-%m') = ?";
    } else {
        return getPvData($conn, date('Y-m'));
    }

    // Prepare and execute statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $date);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $stmt->close();



    return $data;
}

// Get date from the request (if provided), otherwise use the current date
$date = isset($_GET['date']) && !empty($_GET['date']) ? $_GET['date'] : null;

// If no specific date is passed, fetch latest data from sunny_boy
if ($date === null) {
    $data['string_data'] = getLatestDataString($conn);
    $data['analysis_data'] = getLatestDataAnalysis($conn);
} else {
    // Fetch data based on the provided date or month
    $data['string_data'] = getPvData($conn, $date);
    $data['analysis_data'] = getPvDataAnalysis($conn, $date);
}

// Close the connection
$conn->close();

// Return data in JSON format
header('Content-Type: application/json');
echo json_encode($data);
