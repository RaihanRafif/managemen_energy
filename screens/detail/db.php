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

function getLatestDataString($conn)
{
    $sql = "SELECT 
    I_str1,I_str2,I_str3,I_str4,
    V_str1,V_str2,V_str3,V_str4,
    P_str1,P_str2,P_str3,P_str4,
    P_loss_str1,P_loss_str2,P_loss_str3,P_loss_str4,
    V_loss_str1,V_loss_str2,V_loss_str3,V_loss_str4,
    V_out_AC1,V_out_AC2,
    I_out_AC1,I_out_AC2,
    P_out_AC1,P_out_AC2,
    Frek_out_AC1,Frek_out_AC2,
    Status_inv1,Status_inv2
    FROM sunny_boy ORDER BY id DESC LIMIT 1"; // Ambil data terbaru
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}


// Ambil data terbaru dari setiap tabel
$data = array();
$data['weather'] = getLatestData($conn, 'weather');
$data['batt'] = getLatestData($conn, 'batt');
$data['grid'] = getLatestData($conn, 'grid');
$data['load_pm'] = getLatestData($conn, 'load_pm');
$data['string_data'] = getLatestDataString($conn);


// Tutup koneksi
$conn->close();

// Mengembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($data);
