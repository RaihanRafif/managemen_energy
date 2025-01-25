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
                            <img src="./assets/solar panels.png" alt="Solar Panels">
                        </div>
                        <div class="data-container">
                            <h3>PV</h3>
                            <p class="data-title">Power AC (W)</p>
                            <div class="data-value">
                                <p>10.0000</p>
                            </div>
                            <p class="data-title mt-5">Frequency (Hz)</p>
                            <div class="data-value">
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
                            <div class="data-value">
                                <p>10.0000</p>
                            </div>
                            <p class="data-title mt-5">SoC</p>
                            <div class="data-value">
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
                            <div class="data-value">
                                <p>10.0000</p>
                            </div>
                            <p class="data-title">P. Reactive</p>
                            <div class="data-value">
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
                            <p class="data-title">Irradiance (W/m2)</p>
                            <div class="data-value">
                                <p>10.0000</p>
                            </div>
                            <p class="data-title mt-5">Temperature C</p>
                            <div class="data-value">
                                <p>10.0000</p>
                            </div>
                            <p class="data-title mt-5">Wind Speed (m/s)</p>
                            <div class="data-value">
                                <p>10.0000</p>
                            </div>
                            <p class="data-title mt-5">Humidity %</p>
                            <div class="data-value">
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
                            <div class="data-value">
                                <p>10.0000</p>
                            </div>
                            <p class="data-title mt-5">Frequency (Hz)</p>
                            <div class="data-value">
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
                <div id="tester" style="width:75vw;height:90%;"></div>
            </div>
        </div>

        <div class="right">
            <div class="title">
                <h2>Analysis</h2>
            </div>
            <h3>Today Production (kWh)</h3>
            <div class="input">
                <p>10.0000</p>
            </div>
            <h3>Today Saving (Rp.)</h3>
            <div class="input">
                <p>10.0000</p>
            </div>
            <h3>Monthly Production (kWh)</h3>
            <div class="input">
                <p>10.0000</p>
            </div>
            <h3>Monthly Saving (Rp.)</h3>
            <div class="input">
                <p>10.0000</p>
            </div>
            <h3>CO2 Reduced (kg)</h3>
            <div class="input">
                <p>10.0000</p>
            </div>
            <h3>Total Energy (kWh)</h3>
            <div class="input">
                <p>10.0000</p>
            </div>
        </div>
    </div>

    <script>
        const TESTER = document.getElementById('tester');

        // Dummy data with multiple traces
        const data = [{
                x: [1, 2, 3, 4, 5],
                y: [1, 2, 4, 8, 16],
                mode: 'lines+markers',
                name: 'Dataset A', // Name appears in the legend
                line: {
                    color: 'blue'
                }
            },
            {
                x: [1, 2, 3, 4, 5],
                y: [16, 8, 4, 2, 1],
                mode: 'lines+markers',
                name: 'Dataset B', // Name appears in the legend
                line: {
                    color: 'red'
                }
            }
        ];

        // Layout configuration
        const layout = {
            title: 'Dummy Data Chart',
            xaxis: {
                title: 'X Axis Label'
            },
            yaxis: {
                title: {
                    text: 'Y Axis Label',
                    standoff: 20, // Space between the label and the axis
                    font: {
                        size: 14, // Adjust font size
                        color: 'black' // Adjust font color
                    }
                },
                titlefont: {
                    size: 16
                },
                titleangle: 0 // Make the label horizontal
            },
        };


        // Create the plot
        Plotly.newPlot(TESTER, data, layout);
    </script>


</body>


</html>