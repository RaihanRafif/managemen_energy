<?php

include('../../database/config.php');

// Fungsi untuk mengambil data terbaru dari tabel
function getLatestData($conn, $table)
{
    $sql = "SELECT * FROM $table ORDER BY id DESC LIMIT 1"; // Ambil data terbaru
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
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

// Fungsi untuk mengambil semua data PV dari 1 Februari 2025
function getPvDataFromFeb2025($conn)
{
    $sql = "SELECT timestamp, Pdc FROM pv WHERE timestamp >= '2025-02-01'"; // Ambil data dari 1 Februari 2025
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
$data['pv'] = getLatestData($conn, 'pv');
$data['pv_allday'] = getPvDataToday($conn);
$data['pv_allmonth'] = getPvDataThisMonth($conn);
$data['pv_from_feb_2025'] = getPvDataFromFeb2025($conn);
$data['batt'] = getLatestData($conn, 'batt');
$data['grid'] = getLatestData($conn, 'grid');
$data['load_pm'] = getLatestData($conn, 'load_pm');
$data['sunny_boy'] = getLatestData($conn, 'sunny_boy');
$data['weather'] = getLatestData($conn, 'weather');

// Tutup koneksi
$conn->close();

// Mengembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
