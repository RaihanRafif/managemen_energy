<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lab_me";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

while (true) {
    // Generate random values for each field inside the loop
    $solarRad = rand(0, 1000); // Example range for solar radiation
    $outsideTemp = rand(-10, 40) + mt_rand() / mt_getrandmax(); // Random temperature with decimal
    $outsideHumidity = rand(0, 100); // Humidity percentage
    $windSpeed = rand(0, 20) + mt_rand() / mt_getrandmax(); // Wind speed with decimal
    $I_str1 = rand(0, 100) + mt_rand() / mt_getrandmax(); // Current with decimal
    $I_str2 = rand(0, 100) + mt_rand() / mt_getrandmax();
    $I_str3 = rand(0, 100) + mt_rand() / mt_getrandmax();
    $I_str4 = rand(0, 100) + mt_rand() / mt_getrandmax();
    $V_str1 = rand(0, 500) + mt_rand() / mt_getrandmax(); // Voltage with decimal
    $V_str2 = rand(0, 500) + mt_rand() / mt_getrandmax();
    $V_str3 = rand(0, 500) + mt_rand() / mt_getrandmax();
    $V_str4 = rand(0, 500) + mt_rand() / mt_getrandmax();
    $P_str1 = rand(0, 5000) + mt_rand() / mt_getrandmax(); // Power with decimal
    $P_str2 = rand(0, 5000) + mt_rand() / mt_getrandmax();
    $P_str3 = rand(0, 5000) + mt_rand() / mt_getrandmax();
    $P_str4 = rand(0, 5000) + mt_rand() / mt_getrandmax();
    $I_out_AC1 = rand(0, 100) + mt_rand() / mt_getrandmax();
    $I_out_AC2 = rand(0, 100) + mt_rand() / mt_getrandmax();
    $V_out_AC1 = rand(0, 240) + mt_rand() / mt_getrandmax();
    $V_out_AC2 = rand(0, 240) + mt_rand() / mt_getrandmax();
    $P_out_AC1 = rand(0, 5000) + mt_rand() / mt_getrandmax();
    $P_out_AC2 = rand(0, 5000) + mt_rand() / mt_getrandmax();
    $Frek_out_AC1 = rand(0, 60) + mt_rand() / mt_getrandmax();
    $Frek_out_AC2 = rand(0, 60) + mt_rand() / mt_getrandmax();

    // Generate random P_loss and V_loss
    $P_loss_str1 = rand(0, 100) + mt_rand() / mt_getrandmax();
    $P_loss_str2 = rand(0, 100) + mt_rand() / mt_getrandmax();
    $P_loss_str3 = rand(0, 100) + mt_rand() / mt_getrandmax();
    $P_loss_str4 = rand(0, 100) + mt_rand() / mt_getrandmax();
    $V_loss_str1 = rand(0, 100) + mt_rand() / mt_getrandmax();
    $V_loss_str2 = rand(0, 100) + mt_rand() / mt_getrandmax();
    $V_loss_str3 = rand(0, 100) + mt_rand() / mt_getrandmax();
    $V_loss_str4 = rand(0, 100) + mt_rand() / mt_getrandmax();

    // Randomly select between 35, 303, 307, 455
    $statusOptions = [35, 303, 307, 455];
    $Status_inv1 = $statusOptions[array_rand($statusOptions)];
    $Status_inv2 = $statusOptions[array_rand($statusOptions)];

    // Insert into sunny_boy table
    $sql_sunny_boy = "INSERT INTO sunny_boy (
        timestamp, Jam, SolarRad, outsideTemp, outsideHumidity, windSpeed, 
        I_str1, I_str2, I_str3, I_str4, V_str1, V_str2, V_str3, V_str4, 
        P_str1, P_str2, P_str3, P_str4, I_out_AC1, I_out_AC2, V_out_AC1, 
        V_out_AC2, P_out_AC1, P_out_AC2, Frek_out_AC1, Frek_out_AC2, 
        P_loss_str1, P_loss_str2, P_loss_str3, P_loss_str4,
        V_loss_str1, V_loss_str2, V_loss_str3, V_loss_str4,
        Status_inv1, Status_inv2
    ) VALUES (
        NOW(), '00:00:06', $solarRad, $outsideTemp, $outsideHumidity, $windSpeed, 
        $I_str1, $I_str2, $I_str3, $I_str4, $V_str1, $V_str2, $V_str3, $V_str4, 
        $P_str1, $P_str2, $P_str3, $P_str4, $I_out_AC1, $I_out_AC2, $V_out_AC1, 
        $V_out_AC2, $P_out_AC1, $P_out_AC2, $Frek_out_AC1, $Frek_out_AC2, 
        $P_loss_str1, $P_loss_str2, $P_loss_str3, $P_loss_str4,
        $V_loss_str1, $V_loss_str2, $V_loss_str3, $V_loss_str4,
        $Status_inv1, $Status_inv2
    )";
    $conn->query($sql_sunny_boy);

    // Insert into other tables
    $sql_batt = "INSERT INTO batt (timestamp, Vdc, Pdc, Idc, SOC, Temp, Vac, Iac, Freq, Pactive, Preactive)
                 VALUES (NOW(), 52.06, 27, -0.095, 90, 65.5, 225.57, 1.861, 50.06, -25, -418)";
    $conn->query($sql_batt);

    $sql_grid = "INSERT INTO grid (timestamp, Vac, Iac, Freq, Pactive, Preactive)
                 VALUES (NOW(), 225.57, 1.861, 50.06, -25, -418)";
    $conn->query($sql_grid);

    $sql_load_pm = "INSERT INTO load_pm (timestamp, Vac, Iac, Pac, Pfactor, Freq)
                    VALUES (NOW(), 226.55, 0, 0, 0, 50.0574)";
    $conn->query($sql_load_pm);

    $sql_pv = "INSERT INTO pv (timestamp, Pdc, Vdc, Idc, Vac, Iac, Freq, Pac)
               VALUES (NOW(), 2487, 282.67, 8.806, 229.72, 10.55, 50.05, 1211.5)";
    $conn->query($sql_pv);

    $sql_weather = "INSERT INTO weather (timestamp, Humidity, Irradiance, Temperature, WindSpeed)
                    VALUES (NOW(), 77, 220, 27.1, 0.4)";
    $conn->query($sql_weather);

    // Wait for 5 seconds before inserting the next set of data
    sleep(5);
}

$conn->close();
?>
