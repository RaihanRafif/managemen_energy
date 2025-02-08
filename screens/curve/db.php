<?php

include('../../database/config.php');

function getLatestDataString($conn)
{
    $sql = "SELECT 
    timestamp,P_str1,P_str2,P_str3,P_str4
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

// Fungsi untuk mengambil semua data PV hari ini
function getPvDataToday($conn)
{
    $sql = "SELECT timestamp, Pdc FROM pv WHERE DATE(timestamp) = CURDATE()"; // Ambil data hari ini
    $result = $conn->query($sql);
    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}

// Fungsi untuk mengambil semua data PV bulan ini
function getPvDataThisMonth($conn)
{
    $sql = "SELECT timestamp, Pdc FROM pv WHERE MONTH(timestamp) = MONTH(CURRENT_DATE()) AND YEAR(timestamp) = YEAR(CURRENT_DATE())"; // Ambil data bulan ini
    $result = $conn->query($sql);
    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}


// Ambil data terbaru dari setiap tabel
$data = array();
$data['string_data'] = getLatestDataString($conn);
$data['pv_allday'] = getPvDataToday($conn);
$data['pv_allmonth'] = getPvDataThisMonth($conn);

// Tutup koneksi
$conn->close();

// Mengembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($data);
