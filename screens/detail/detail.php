<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./screens/detail/detail.css">
</head>

<body>
    <div class="container-menu">
        <div class="weather-condition">
            <div class="weather-list">
                <div class="img-container">
                    <img src="./assets/little yellow sun.png" alt="">
                </div>
                <div class="data-container">
                    <p>Irradiance (W/m2)</p>
                    <div class="data-value" id="irradiance">10.000</div>
                </div>
            </div>
            <div class="weather-list">
                <div class="img-container">
                    <img src="./assets/cloud.png" alt="">
                </div>
                <div class="data-container">
                    <p>Windspeed (m/s)</p>
                    <div class="data-value" id="windspeed">10.000</div>
                </div>
            </div>
            <div class="weather-list">
                <div class="img-container">
                    <img src="./assets/thermometer.png" alt="">
                </div>
                <div class="data-container">
                    <p>Ambient Temperature (C)</p>
                    <div class="data-value" id="temperature">10.000</div>
                </div>
            </div>
            <div class="weather-list">
                <div class="img-container">
                    <img src="./assets/drop.png" alt="">
                </div>
                <div class="data-container">
                    <p>Humidity (%)</p>
                    <div class="data-value" id="humidity">10.000</div>
                </div>
            </div>
        </div>

        <div class="table-container">
            <div class="grid-container">
                <div class="A">
                    <div class="power-panels-container">
                        <!-- Panel 1 -->
                        <div class="data-power-panels panel">
                            <div class="pp-data">
                                <div class="data-container panel-name">String 1</div>
                                <div class="data-container">
                                    <p>Voltage (V)</p>
                                    <div class="data-value" id="str1-v">10.000</div>
                                </div>
                                <div class="data-container image-container">
                                    <img src="./assets/solar panels.png" alt="">
                                </div>
                                <div class="data-container">
                                    <p>Current (A)</p>
                                    <div class="data-value" id="str1-c">220</div>
                                </div>
                                <div class="data-container">
                                    <p>Power (W)</p>
                                    <div class="data-value" id="str1-p">10</div>
                                </div>
                                <div class="data-container">
                                    <p>Voltage Loss (V)</p>
                                    <div class="data-value" id="str1-vl">2200</div>
                                </div>
                                <div class="data-container">
                                    <p>Power Loss (W)</p>
                                    <div class="data-value" id="str1-pl">50</div>
                                </div>
                            </div>
                        </div>

                        <!-- Garis Penghubung -->
                        <svg class="connection-line dc-voltage" width="200" height="100">
                            <!-- Garis Horizontal -->
                            <line x1="0" y1="50%" x2="100%" y2="50%" stroke="black" stroke-width="2" />

                            <!-- Segitiga menghadap kanan di tengah garis -->
                            <polygon points="95,40 115,50 95,60" fill="black" />
                        </svg>



                        <div class="data-power-panels panel">
                            <div class="pp-data">
                                <div class="data-container panel-name">String 2</div>
                                <div class="data-container">
                                    <p>Voltage (V)</p>
                                    <div class="data-value" id="str2-v">10.000</div>
                                </div>
                                <div class="data-container image-container">
                                    <img src="./assets/solar panels.png" alt="">
                                </div>
                                <div class="data-container">
                                    <p>Current (A)</p>
                                    <div class="data-value" id="str2-c">220</div>
                                </div>
                                <div class="data-container">
                                    <p>Power (W)</p>
                                    <div class="data-value" id="str2-p">10</div>
                                </div>
                                <div class="data-container">
                                    <p>Voltage Loss (V)</p>
                                    <div class="data-value" id="str2-vl">2200</div>
                                </div>
                                <div class="data-container">
                                    <p>Power Loss (W)</p>
                                    <div class="data-value" id="str2-pl">50</div>
                                </div>
                            </div>
                        </div>
                        <!-- Garis Penghubung -->
                        <svg class="connection-line dc-voltage">
                            <line x1="0" y1="50%" x2="100%" y2="50%" />
                        </svg>
                        <!-- Inverter -->
                        <div class="data-power-panels inverter">
                            <div class="pp-data">
                                <div class="data-container panel-name">Sunny Boy 1</div>
                                <div class="data-container">
                                    <p>Voltage (V)</p>
                                    <div class="data-value" id="sb1-v">10.000</div>
                                </div>
                                <div class="data-container image-container">
                                    <img src="./assets/inverter.png" alt="">
                                </div>
                                <div class="data-container">
                                    <p>Current (A)</p>
                                    <div class="data-value" id="sb1-c">220</div>
                                </div>
                                <div class="data-container">
                                    <p>Power (W)</p>
                                    <div class="data-value" id="sb1-p">10</div>
                                </div>
                                <div class="data-container">
                                    <p>Frequency (Hz)</p>
                                    <div class="data-value" id="sb1-f">2200</div>
                                </div>
                                <div class="data-container">
                                    <p>Status</p>
                                    <div class="data-value" id="sb1-s">Off</div>
                                </div>
                            </div>
                        </div>

                        <!-- Garis Penghubung -->
                        <svg class="connection-line ac-voltage">
                            <line x1="0" y1="50%" x2="100%" y2="50%" />
                        </svg>
                    </div>
                    <div class="power-panels-container">
                        <!-- Panel 1 -->
                        <div class="data-power-panels panel">
                            <div class="pp-data">
                                <div class="data-container panel-name">String 3</div>
                                <div class="data-container">
                                    <p>Voltage (V)</p>
                                    <div class="data-value" id="str3-v">10.000</div>
                                </div>
                                <div class="data-container image-container">
                                    <img src="./assets/solar panels.png" alt="">
                                </div>
                                <div class="data-container">
                                    <p>Current (A)</p>
                                    <div class="data-value" id="str3-c">220</div>
                                </div>
                                <div class="data-container">
                                    <p>Power (W)</p>
                                    <div class="data-value" id="str3-p">10</div>
                                </div>
                                <div class="data-container">
                                    <p>Voltage Loss (V)</p>
                                    <div class="data-value" id="str3-vl">2200</div>
                                </div>
                                <div class="data-container">
                                    <p>Power Loss (W)</p>
                                    <div class="data-value" id="str3-pl">50</div>
                                </div>
                            </div>
                        </div>

                        <!-- Garis Penghubung -->
                        <svg class="connection-line dc-voltage" width="200" height="100">
                            <!-- Garis Horizontal -->
                            <line x1="0" y1="50%" x2="100%" y2="50%" stroke="black" stroke-width="2" />

                            <!-- Segitiga menghadap kanan di tengah garis -->
                            <polygon points="95,40 115,50 95,60" fill="black" />
                        </svg>



                        <div class="data-power-panels panel">
                            <div class="pp-data">
                                <div class="data-container panel-name">String 4</div>
                                <div class="data-container">
                                    <p>Voltage (V)</p>
                                    <div class="data-value" id="str4-v">10.000</div>
                                </div>
                                <div class="data-container image-container">
                                    <img src="./assets/solar panels.png" alt="">
                                </div>
                                <div class="data-container">
                                    <p>Current (A)</p>
                                    <div class="data-value" id="str4-c">220</div>
                                </div>
                                <div class="data-container">
                                    <p>Power (W)</p>
                                    <div class="data-value" id="str4-p">10</div>
                                </div>
                                <div class="data-container">
                                    <p>Voltage Loss (V)</p>
                                    <div class="data-value" id="str4-vl">2200</div>
                                </div>
                                <div class="data-container">
                                    <p>Power Loss (W)</p>
                                    <div class="data-value" id="str4-pl">50</div>
                                </div>
                            </div>
                        </div>
                        <!-- Garis Penghubung -->
                        <svg class="connection-line dc-voltage">
                            <line x1="0" y1="50%" x2="100%" y2="50%" />
                        </svg>
                        <!-- Inverter -->
                        <div class="data-power-panels inverter">
                            <div class="pp-data">
                                <div class="data-container panel-name">Sunny Boy 2</div>
                                <div class="data-container">
                                    <p>Voltage (V)</p>
                                    <div class="data-value" id="sb2-v">10.000</div>
                                </div>
                                <div class="data-container image-container">
                                    <img src="./assets/inverter.png" alt="">
                                </div>
                                <div class="data-container">
                                    <p>Current (A)</p>
                                    <div class="data-value" id="sb2-c">220</div>
                                </div>
                                <div class="data-container">
                                    <p>Power (W)</p>
                                    <div class="data-value" id="sb2-p">10</div>
                                </div>
                                <div class="data-container">
                                    <p>Frequency (Hz)</p>
                                    <div class="data-value" id="sb2-f">2200</div>
                                </div>
                                <div class="data-container">
                                    <p>Status</p>
                                    <div class="data-value" id="sb2-s">Off</div>
                                </div>
                            </div>
                        </div>

                        <!-- Garis Penghubung -->
                        <svg class="connection-line ac-voltage">
                            <line x1="0" y1="50%" x2="100%" y2="50%" />
                        </svg>
                    </div>
                    <div class="power-panels-container ">
                        <div class="legend">
                            <div class="legend-item">
                                <div class="line-legend line-blue"></div>
                                <span>DC Voltage</span>
                            </div>
                            <div class="legend-item">
                                <div class="line-legend line-red"></div>
                                <span>AC Voltage 1 phase</span>
                            </div>
                        </div>
                        <div class="data-power-panels panel" style="margin-left: auto;">
                            <div class="pp-data">
                                <div class="data-container panel-name">Load</div>
                                <div class="data-container">
                                    <p>Voltage (V)</p>
                                    <div class="data-value" id="l-v">10.000</div>
                                </div>
                                <div class="data-container image-container">
                                    <img src="./assets/home.png" alt="">
                                </div>
                                <div class="data-container">
                                    <p>Current (A)</p>
                                    <div class="data-value" id="l-c">220</div>
                                </div>
                                <div class="data-container">
                                    <p>Power (W)</p>
                                    <div class="data-value" id="l-p">10</div>
                                </div>
                                <div class="data-container">
                                    <p>Power Factor</p>
                                    <div class="data-value" id="l-pf">2200</div>
                                </div>
                                <div class="data-container">
                                    <p>Frequency (Hz)</p>
                                    <div class="data-value" id="l-freq">50</div>
                                </div>
                            </div>
                        </div>

                        <!-- Garis Penghubung -->
                        <svg class="connection-line ac-voltage" width="200" height="100">
                            <!-- Garis Horizontal -->
                            <line x1="0" y1="50%" x2="100%" y2="50%" stroke="black" stroke-width="2" />

                            <!-- Segitiga menghadap kanan di tengah garis -->
                            <polygon points="95,40 115,50 95,60" fill="black" />
                        </svg>
                    </div>
                </div>
                <div class="B">
                    <svg class="connection-line ac-voltage" width="200" height="100">
                        <!-- Garis Horizontal -->
                        <line x1="0" y1="50%" x2="100%" y2="50%" stroke="black" stroke-width="2" />

                        <!-- Segitiga menghadap kanan di tengah garis -->
                        <polygon points="95,40 115,50 95,60" fill="black" />
                    </svg>
                    <div class="power-panels-container load-container">
                        <!-- Panel 1 -->
                        <div class="data-power-panels panel">
                            <div class="pp-data">
                                <div class="data-container panel-name">Grid PLN </div>
                                <div class="data-container">
                                    <p>Voltage (V)</p>
                                    <div class="data-value" id="grid-v">10.000</div>
                                </div>
                                <div class="data-container image-container">
                                    <img src="./assets/transmission tower.png" alt="">
                                </div>
                                <div class="data-container">
                                    <p>Current (A)</p>
                                    <div class="data-value" id="grid-c">220</div>
                                </div>
                                <div class="data-container">
                                    <p>P.Active (W)</p>
                                    <div class="data-value" id="grid-pa">10</div>
                                </div>
                                <div class="data-container">
                                    <p>P.Reactive (V)</p>
                                    <div class="data-value" id="grid-pr">2200</div>
                                </div>
                                <div class="data-container">
                                    <p>Frequency (Hz)</p>
                                    <div class="data-value" id="grid-freq">50</div>
                                </div>
                            </div>
                        </div>

                        <svg class="connection-vertical-line ac-voltage" style="width: 10px; height: 10px;">
                            <line x1="10%" y1="0" x2="10%" y2="100%" stroke="black" stroke-width="2" />
                        </svg>


                        <div class="data-power-panels inverter">
                            <div class="pp-data">
                                <div class="data-container panel-name">Sunny Island</div>
                                <div class="data-container">
                                    <p>Voltage (V)</p>
                                    <div class="data-value" id="si-v">10.000</div>
                                </div>
                                <div class="data-container image-container">
                                    <img src="./assets/sunny island.png" alt="">
                                </div>
                                <div class="data-container">
                                    <p>Current (A)</p>
                                    <div class="data-value" id="si-c">220</div>
                                </div>
                                <div class="data-container">
                                    <p>P.Active (W)</p>
                                    <div class="data-value" id="si-pa">10</div>
                                </div>
                                <div class="data-container">
                                    <p>P.Reactive (V)</p>
                                    <div class="data-value" id="si-pr">2200</div>
                                </div>
                                <div class="data-container">
                                    <p>Frequency (Hz)</p>
                                    <div class="data-value" id="si-freq">50</div>
                                </div>
                            </div>
                        </div>

                        <svg class="connection-vertical-line dc-voltage" style="width: 10px; height: 10px;">
                            <line x1="10%" y1="0" x2="10%" y2="100%" stroke="black" stroke-width="2" />
                        </svg>

                        <div class="data-power-panels panel">
                            <div class="pp-data">
                                <div class="data-container panel-name">Battery</div>
                                <div class="data-container">
                                    <p>Voltage (V)</p>
                                    <div class="data-value" id="batt-v">10.000</div>
                                </div>
                                <div class="data-container image-container">
                                    <img src="./assets/car battery.png" alt="">
                                </div>
                                <div class="data-container">
                                    <p>Current (A)</p>
                                    <div class="data-value" id="batt-c">220</div>
                                </div>
                                <div class="data-container">
                                    <p>Power (W)</p>
                                    <div class="data-value" id="batt-p">10</div>
                                </div>
                                <div class="data-container">
                                    <p>SoC (%)</p>
                                    <div class="data-value" id="batt-soc">2200</div>
                                </div>
                                <div class="data-container">
                                    <p>Temperature (C)</p>
                                    <div class="data-value" id="batt-t">50</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function sunnyboy_efficiency(string_a, string_b, p_total) {
            let ab = parseFloat(string_a) + parseFloat(string_b)
            let total = p_total / ab

            return total * 100
        }

        function inverter_status_code(code) {
            
            if (code == 35) {
                return 'Error'
            } else if ( code == 303) {
                return 'Off'
            } else if ( code == 307) {
                return 'OK'
            } else if ( code == 455) {
                return 'Warning'
            } else {
                return 'Error'
            }
        }

        function fetchData() {
            $.ajax({
                url: "./screens/detail/db.php", // File PHP untuk mengambil data
                method: "GET",
                success: function(response) {
                    // Update data PV

                    if (response.weather) {
                        $("#irradiance").text(response.weather.Irradiance || "N/A");
                        $("#windspeed").text(response.weather.WindSpeed || "N/A");
                        $("#temperature").text(response.weather.Temperature || "N/A");
                        $("#humidity").text(response.weather.Humidity || "N/A");
                    } else {
                        $("#irradiance").text("N/A");
                        $("#windspeed").text("N/A");
                        $("#temperature").text("N/A");
                        $("#humidity").text("N/A");
                    }

                    const allday_data = response.pv_allday

                    console.log("LKKK : ", response.string_data.V_str1);


                    $("#str1-v").text(response.string_data.V_str1 || "N/A");
                    $("#str2-v").text(response.string_data.V_str2 || "N/A");
                    $("#str3-v").text(response.string_data.V_str3 || "N/A");
                    $("#str4-v").text(response.string_data.V_str4 || "N/A");
                    $("#str1-c").text(response.string_data.I_str1 || "N/A");
                    $("#str2-c").text(response.string_data.I_str2 || "N/A");
                    $("#str3-c").text(response.string_data.I_str3 || "N/A");
                    $("#str4-c").text(response.string_data.I_str4 || "N/A");
                    $("#str1-p").text(response.string_data.P_str1 || "N/A");
                    $("#str2-p").text(response.string_data.P_str2 || "N/A");
                    $("#str3-p").text(response.string_data.P_str3 || "N/A");
                    $("#str4-p").text(response.string_data.P_str4 || "N/A");
                    $("#str1-pl").text(response.string_data.P_loss_str1 || "N/A");
                    $("#str2-pl").text(response.string_data.P_loss_str2 || "N/A");
                    $("#str3-pl").text(response.string_data.P_loss_str3 || "N/A");
                    $("#str4-pl").text(response.string_data.P_loss_str4 || "N/A");
                    $("#str1-vl").text(response.string_data.V_loss_str1 || "N/A");
                    $("#str2-vl").text(response.string_data.V_loss_str2 || "N/A");
                    $("#str3-vl").text(response.string_data.V_loss_str3 || "N/A");
                    $("#str4-vl").text(response.string_data.V_loss_str4 || "N/A");

                    console.log(response.string_data.Status_inv2);
                    

                    $("#sb1-v").text(response.string_data.V_out_AC1 || "N/A");
                    $("#sb1-c").text(response.string_data.I_out_AC1 || "N/A");
                    $("#sb1-p").text(response.string_data.P_out_AC1 || "N/A");
                    $("#sb1-f").text(response.string_data.Frek_out_AC1 || "N/A");
                    $("#sb1-s").text(inverter_status_code(parseInt(response.string_data.Status_inv1)) || "N/A");
                    $("#sb2-v").text(response.string_data.V_out_AC2 || "N/A");
                    $("#sb2-c").text(response.string_data.I_out_AC2 || "N/A");
                    $("#sb2-p").text(response.string_data.P_out_AC2 || "N/A");
                    $("#sb2-f").text(response.string_data.Frek_out_AC2 || "N/A");
                    $("#sb2-s").text(inverter_status_code(parseInt(response.string_data.Status_inv2)) || "N/A");

                    $("#grid-v").text(response.grid.Vac || "N/A");
                    $("#grid-c").text(response.grid.Iac || "N/A");
                    $("#grid-pa").text(response.grid.Pactive || "N/A");
                    $("#grid-pr").text(response.grid.Preactive || "N/A");
                    $("#grid-freq").text(response.grid.Freq || "N/A");
                    $("#si-v").text(response.grid.Vac || "N/A");
                    $("#si-c").text(response.grid.Iac || "N/A");
                    $("#si-pa").text(response.grid.Pactive || "N/A");
                    $("#si-pr").text(response.grid.Preactive || "N/A");
                    $("#si-freq").text(response.grid.Freq || "N/A");

                    $("#batt-v").text(response.batt.Vdc || "N/A");
                    $("#batt-c").text(response.batt.Idc || "N/A");
                    $("#batt-p").text(response.batt.Pdc || "N/A");
                    $("#batt-soc").text(response.batt.SOC || "N/A");
                    $("#batt-t").text(response.batt.Temp || "N/A");

                    $("#l-v").text(response.load_pm.Vac || "N/A");
                    $("#l-c").text(response.load_pm.Iac || "N/A");
                    $("#l-p").text(response.load_pm.Pac || "N/A");
                    $("#l-pf").text(response.load_pm.Pfactor || "N/A");
                    $("#l-freq").text(response.load_pm.Freq || "N/A");
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching data:", error);
                },
            });
        }

        // Fetch data setiap 5 detik
        setInterval(fetchData, 5000); // 5000 ms = 5 detik

        // Fetch data pertama kali saat halaman dimuat
        $(document).ready(function() {
            fetchData();
        });
    </script>
</body>

</html>