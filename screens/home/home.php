<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./screens/home/home.css">

    <script src="./assets/js/plotly-2.35.2.min.js"></script>
</head>

<body>
    <div class="container-menu">
        <div class="left">
            <div class="top">
                <div class="grid-container">
                    <div class="cell cell-data cell-1-1-2-1">
                        <div class="img-container">
                            <img src="./assets/solar panels.png" style="width: 100px;height: 100px;" alt="Solar Panels">
                        </div>
                        <div class="data-container">
                            <h3>PV</h3>
                            <p class="data-title">Power AC (W)</p>
                            <div class="data-value" id="pv-pac">
                                <p>10.0000</p>
                            </div>
                            <p class="data-title mt-5">Frequency (Hz)</p>
                            <div class="data-value" id="pv-freq">
                                <p>10.0000</p>
                            </div>
                        </div>
                    </div>
                    <div class="cell cell-1-2-1-3"></div>
                    <div class="cell cell-1-5"></div>
                    <div class="cell cell-4-3"></div>
                    <div class="cell cell-2-2-3-2-4-2"></div>
                    <div class="cell cell-data cell-1-4-2-4">
                        <div class="img-container">
                            <img src="./assets/car battery.png" alt="Solar Panels">
                        </div>
                        <div class="data-container">
                            <h3>BESS</h3>
                            <p class="data-title">Power (W)</p>
                            <div class="data-value" id="bess-power">
                                <p>10.0000</p>
                            </div>
                            <p class="data-title mt-5">SoC</p>
                            <div class="data-value" id="bess-soc">
                                <p>10.0000</p>
                            </div>
                        </div>
                    </div>
                    <div class="cell cell-data cell-1-6-2-6">
                        <div class="img-container">
                            <img src="./assets/transmission tower.png" alt="Solar Panels">
                        </div>
                        <div class="data-container">
                            <h3>Grid</h3>
                            <p class="data-title">P. Active</p>
                            <div class="data-value" id="grid-active">
                                <p>10.0000</p>
                            </div>
                            <p class="data-title">P. Reactive</p>
                            <div class="data-value" id="grid-reactive">
                                <p>10.0000</p>
                            </div>
                        </div>

                    </div>
                    <div class="cell cell-data cell-4-1-5-1-6-1">
                        <div class="img-container">
                            <img src="./assets/windsock.png" alt="Solar Panels">
                        </div>
                        <div class="data-container">
                            <h3>Weather Station</h3>
                            <p class="data-title">Irradiance (W/m&sup2;)</p>
                            <div class="data-value" id="weather-irradiance">
                                <p>10.0000</p>
                            </div>
                            <p class="data-title mt-5">Temperature &deg;C</p>
                            <div class="data-value" id="weather-temperature">
                                <p>10.0000</p>
                            </div>
                            <p class="data-title mt-5">Wind Speed (m/s)</p>
                            <div class="data-value" id="weather-windspeed">
                                <p>10.0000</p>
                            </div>
                            <p class="data-title mt-5">Humidity %</p>
                            <div class="data-value" id="weather-humidity">
                                <p>10.0000</p>
                            </div>
                        </div>
                    </div>
                    <div class="cell cell-data cell-4-4-5-4">
                        <div class="img-container">
                            <img src="./assets/home.png" alt="Solar Panels">
                        </div>
                        <div class="data-container">
                            <h3>Load</h3>
                            <p class="data-title">Power (W)</p>
                            <div class="data-value" id="load_pm-power">
                                <p>10.0000</p>
                            </div>
                            <p class="data-title mt-5">Frequency (Hz)</p>
                            <div class="data-value" id="load_pm-freq">
                                <p>10.0000</p>
                            </div>
                        </div>
                    </div>
                    <div class="cell cell-data cell-4-6-5-6">
                        <div class="img-container">
                            <img src="./assets/motion sensor.png" alt="Solar Panels">
                        </div>
                        <div class="data-container">
                            <h3>Alarm</h3>
                            <p class="data-title">Fault</p>
                            <div class="data-value">
                                <p>10.0000</p>
                            </div>
                            <p class="data-title mt-5">Fault type</p>
                            <div class="data-value">
                                <p>10.0000</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom">
                <div id="current-date" class="current_date"></div>
                <div id="tester" style="width:100%;height:100%;"></div>
            </div>
        </div>

        <div class="right">
            <div class="title">
                <h2>Analysis</h2>
            </div>
            <h3>Today Production (kWh)</h3>
            <div class="input" id="today_production">
                <p>10.0000</p>
            </div>
            <h3>Today Saving </h3>
            <div class="input" id="today_saving">
                <p>10.0000</p>
            </div>
            <h3>Monthly Production (kWh)</h3>
            <div class="input" id="monthly_production">
                <p>10.0000</p>
            </div>
            <h3>Monthly Saving </h3>
            <div class="input" id="monthly_saving">
                <p>10.0000</p>
            </div>
            <h3>CO2 Reduced (kg)</h3>
            <div class="input" id="carbondioxyde_reduced">
                <p>10.0000</p>
            </div>
            <h3>Total Energy (kWh)</h3>
            <div class="input" id="total_energy">
                <p>10.0000</p>
            </div>
        </div>
    </div>

    <script>
        const gwp_co2 = 1
        const fe_electric = 0.794
        const electricity_bill = 1444.7

        let currentPage = 'daily'; // Track the current page
        let data = {
            'daily': [],
        }; // Global variable to store data
        let visibilityState = {}; // Store visibility state of traces


        function today_production(data) {
            return data / (60 * 1000)
        }

        function today_saving(data) {
            return today_production(data) * electricity_bill
        }

        function monthly_production(data_monthly) {
            return data_monthly / (60 * 1000)
        }

        function monthly_saving(data_monthly) {
            return monthly_production(data_monthly) * electricity_bill
        }

        function total_energy(data_start_feb) {
            return data_start_feb / (60 * 1000)
        }

        function carbondioxyde_reduced(data) {
            return total_energy(data) * fe_electric
        }

        function parseTimestamp(timestamp) {
            return new Date(timestamp.replace(" ", "T"));
        }

        const layoutHourly = {
            title: '',
            xaxis: {
                title: 'Time'
            },
            yaxis: {
                title: {
                    text: 'Energy Production (kWh)',
                    standoff: 20,
                    font: {
                        size: 14,
                        color: 'black'
                    }
                },
                titlefont: {
                    size: 16
                },
                titleangle: 0
            }
        };

        function renderChart() {
            let chartData;

            chartData = prepareChartData(data.daily, "hourly");
            Plotly.react("tester", chartData, layoutHourly);
        }

        function prepareChartData(data, interval) {
            const x = [];
            const y1 = [];
            const y2 = [];
            const y3 = [];
            const y4 = [];
            const y_total = [];

            data.forEach((item) => {
                y1.push(item.P_str1);
                y2.push(item.P_str2);
                y3.push(item.P_str3);
                y4.push(item.P_str4);
                y_total.push(item.P_str1 + item.P_str2 + item.P_str3 + item.P_str4);
                x.push(item.hour);
            });

            return [{
                    x,
                    y: y1,
                    type: "scatter",
                    mode: "lines",
                    name: "P_str1",
                    line: {
                        color: "blue",
                        shape: "spline" // Membuat garis menjadi lebih halus
                    },
                    visible: visibilityState["P_str1"] !== undefined ? visibilityState["P_str1"] : true,
                },
                {
                    x,
                    y: y2,
                    type: "scatter",
                    mode: "lines",
                    name: "P_str2",
                    line: {
                        color: "green",
                        shape: "spline"
                    },
                    visible: visibilityState["P_str2"] !== undefined ? visibilityState["P_str2"] : true,
                },
                {
                    x,
                    y: y3,
                    type: "scatter",
                    mode: "lines",
                    name: "P_str3",
                    line: {
                        color: "red",
                        shape: "spline"
                    },
                    visible: visibilityState["P_str3"] !== undefined ? visibilityState["P_str3"] : true,
                },
                {
                    x,
                    y: y4,
                    type: "scatter",
                    mode: "lines",
                    name: "P_str4",
                    line: {
                        color: "orange",
                        shape: "spline"
                    },
                    visible: visibilityState["P_str4"] !== undefined ? visibilityState["P_str4"] : true,
                },
                {
                    x,
                    y: y_total,
                    type: "scatter",
                    mode: "lines",
                    name: "P_Total",
                    line: {
                        color: "black",
                        shape: "spline"
                    },
                    visible: visibilityState["Total"] !== undefined ? visibilityState["Total"] : true,
                },
            ];
        }



        function fetchData() {
            $.ajax({
                url: "./screens/home/db.php", // File PHP untuk mengambil data
                method: "GET",
                success: function(response) {
                    // Update data PV
                    if (response.pv) {
                        $("#pv-pac").text(response.pv.Pac || "N/A");
                        $("#pv-freq").text(response.pv.Freq || "N/A");
                    } else {
                        $("#pv-pac").text("N/A");
                        $("#pv-freq").text("N/A");
                    }

                    // Update response Batt
                    if (response.batt) {
                        $("#bess-power").text(response.batt.Pdc || "N/A");
                        $("#bess-soc").text(response.batt.SOC || "N/A"); // Ganti 'value' dengan kolom yang sesuai
                    } else {
                        $("#bess-power").text("N/A");
                        $("#bess-soc").text("N/A");
                    }

                    // Update response Batt
                    if (response.grid) {
                        $("#grid-active").text(response.grid.Pactive || "N/A");
                        $("#grid-reactive").text(response.grid.Preactive || "N/A"); // Ganti 'value' dengan kolom yang sesuai
                    } else {
                        $("#grid-active").text("N/A");
                        $("#grid-reactive").text("N/A");
                    }

                    // Update response Batt
                    if (response.load_pm) {
                        $("#load_pm-power").text(response.load_pm.Pac || "N/A");
                        $("#load_pm-freq").text(parseFloat(response.load_pm.Freq).toFixed(2) || "N/A"); // Ganti 'value' dengan kolom yang sesuai
                    } else {
                        $("#load_pm-power").text("N/A");
                        $("#load_pm-freq").text("N/A");
                    }

                    // Update response sunny_boy
                    if (response.sunny_boy) {
                        $("#sunny_boy-id").text(response.sunny_boy.id || "N/A");
                        $("#sunny_boy-value").text(response.sunny_boy.SolarRad || "N/A"); // Ganti 'value' dengan kolom yang sesuai
                        $("#sunny_boy-time").text(response.sunny_boy.timestamp || "N/A"); // Ganti 'timestamp' dengan kolom yang sesuai
                    } else {
                        $("#sunny_boy-id").text("N/A");
                        $("#sunny_boy-value").text("N/A");
                        $("#sunny_boy-time").text("N/A");
                    }

                    // Update response weather
                    if (response.weather) {
                        $("#weather-irradiance").text(response.weather.Irradiance || "N/A");
                        $("#weather-temperature").text(response.weather.Temperature || "N/A");
                        $("#weather-windspeed").text(response.weather.WindSpeed || "N/A"); // Ganti 'value' dengan kolom yang sesuai
                        $("#weather-humidity").text(response.weather.Humidity || "N/A"); // Ganti 'timestamp' dengan kolom yang sesuai
                    } else {
                        $("#weather-irradiance").text("N/A");
                        $("#weather-temperature").text("N/A");
                        $("#weather-windspeed").text("N/A");
                        $("#weather-humidity").text("N/A");
                    }

                    const power_today = response.power_today

                    const allday_data = response.pv_allday

                    const monthly_data = response.pv_allmonth
                    const data_from_feb = response.pv_from_feb_2025

                    const pdcValues = allday_data.map(entry => parseFloat(entry.Pdc));

                    const pdcMonthlyValues = monthly_data.map(entry => parseFloat(entry.Pdc));
                    const pdcStartFebValues = data_from_feb.map(entry => parseFloat(entry.Pdc));

                    $("#today_production").text(today_production(pdcValues.reduce((accumulator, currentValue) => accumulator + currentValue, 0)).toFixed(2) || "N/A");

                    $("#today_saving").text(
                        today_saving(pdcValues.reduce((accumulator, currentValue) => accumulator + currentValue, 0))
                        .toLocaleString('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }) || "N/A"
                    );
                    $("#monthly_production").text(monthly_production(pdcMonthlyValues.reduce((accumulator, currentValue) => accumulator + currentValue, 0)).toFixed(2) || "N/A");

                    $("#monthly_saving").text(monthly_saving(pdcMonthlyValues.reduce((accumulator, currentValue) => accumulator + currentValue, 0))
                        .toLocaleString('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }) || "N/A");

                    $("#total_energy").text(total_energy(pdcStartFebValues.reduce((accumulator, currentValue) => accumulator + currentValue, 0)).toFixed(2) || "N/A");

                    $("#carbondioxyde_reduced").text(carbondioxyde_reduced(pdcStartFebValues.reduce((accumulator, currentValue) => accumulator + currentValue, 0)).toFixed(2) || "N/A");

                    // Find the last date available
                    let dailyData = {};
                    if (power_today.length > 0) {
                        let lastDate = new Date(
                            Math.max(
                                ...power_today.map((item) => parseTimestamp(item.timestamp).getTime())
                            )
                        );
                        let lastDateString = lastDate.toISOString().split("T")[0];

                        power_today
                            .filter((item) => item.timestamp.startsWith(lastDateString))
                            .forEach((item) => {

                                let hour = parseTimestamp(item.timestamp).getHours();
                                if (!dailyData[hour]) {
                                    dailyData[hour] = {
                                        hour: hour,
                                        P_str1: 0,
                                        P_str2: 0,
                                        P_str3: 0,
                                        P_str4: 0,
                                    };
                                }
                                dailyData[hour].P_str1 += parseFloat(item.P_str1);
                                dailyData[hour].P_str2 += parseFloat(item.P_str2);
                                dailyData[hour].P_str3 += parseFloat(item.P_str3);
                                dailyData[hour].P_str4 += parseFloat(item.P_str4);
                            });

                    }

                    // Store the current visibility state
                    data.daily = Object.values(dailyData)

                    const chartDiv = document.getElementById("tester");
                    if (chartDiv && chartDiv.data) {
                        chartDiv.data.forEach((trace, index) => {
                            visibilityState[trace.name] = trace.visible;
                        });
                    }

                    renderChart();

                },
                error: function(xhr, status, error) {
                    console.error("Error fetching data:", error);
                },
            });
        }

        // Fetch data setiap 5 detik
        setInterval(fetchData, 5000); // 5000 ms = 5 detik

        function displayCurrentDate() {
            const currentDateElement = document.getElementById('current-date');
            const now = new Date();
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                weekday: 'long'
            };
            currentDateElement.textContent = now.toLocaleDateString('en-US', options);
        }

        // Call the function to display the date when the page loads
        document.addEventListener('DOMContentLoaded', displayCurrentDate);

        // Fetch data pertama kali saat halaman dimuat
        $(document).ready(function() {
            fetchData();
        });
    </script>
</body>


</html>