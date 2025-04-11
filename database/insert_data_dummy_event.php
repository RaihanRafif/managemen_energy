<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lab_me";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Baca file JSON
$jsonData = file_get_contents('../assets/json/event_data.json');
$dataArray = json_decode($jsonData, true);

if (!$dataArray) {
    die("Gagal membaca data JSON");
}

const errorCodes = [
    "801",
    "901",
    "3401/3402",
    "3501/35",
    "3601",
    "3801/3802",
    "3901/3902",
    "7508",
    "7701,7702,7703",
    "8001"
];


// Loop data dan masukkan ke database
while (true) {  
    $code = intval(trim($code)); // Pastikan integer

    // Generate stat data (0 atau 1)
    $stat_str1 = rand(0, 1);
    $stat_str2 = rand(0, 1);
    $stat_str3 = rand(0, 1);
    $stat_str4 = rand(0, 1);
    $stat_inv1 = rand(0, 1);
    $stat_inv2 = rand(0, 1);

    // Ambil type dari JSON, default ke string kosong jika tidak ada
    $type_str1 = errorCodes[rand(0, count(errorCodes) - 1)];
    $type_str2 = errorCodes[rand(0, count(errorCodes) - 1)];
    $type_str3 = errorCodes[rand(0, count(errorCodes) - 1)];
    $type_str4 = errorCodes[rand(0, count(errorCodes) - 1)];
    $type_inv1 = errorCodes[rand(0, count(errorCodes) - 1)];
    $type_inv1 = errorCodes[rand(0, count(errorCodes) - 1)];

    $sql = "INSERT INTO event (
                stat_str1, type_str1,
                stat_str2, type_str2,
                stat_str3, type_str3,
                stat_str4, type_str4,
                stat_inv1, type_inv1,
                stat_inv2, type_inv2,
                timestamp
            ) VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW()
            )";


    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param(
        "ississississ",
        $stat_str1,
        $type_str1,
        $stat_str2,
        $type_str2,
        $stat_str3,
        $type_str3,
        $stat_str4,
        $type_str4,
        $stat_inv1,
        $type_inv1,
        $stat_inv2,
        $type_inv2
    );


    $stmt->execute();
    $stmt->close(); // Jangan lupa close statement


    sleep(1000);
}

echo "Data berhasil dimasukkan.";
$conn->close();
