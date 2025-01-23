<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./screens/home/home.css">

    <script src="./assets/js/plotly-2.35.2.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="left">
            <div class="top">
                <div class="top-top">
                    <div class="section-container">
                        <div class="img-cont">
                            <img src="./assets/solar panels.png" alt="Solar Panels">
                        </div>
                        <div class="data-container">
                            <h3>PV</h3>
                            <p>Power AC (W)</p>
                            <div class="data-value">
                                <p>10.0000</p>
                            </div>
                            <p>Frequency (Hz)</p>
                            <div class="data-value">
                                <p>10.0000</p>
                            </div>
                        </div>
                    </div>
                    <div class="powerline-1-2"></div>
                    <div class="section-container" style="margin-left: auto;margin-right: 10%;">
                        <div class="img-cont">
                            <img src="./assets/car battery.png" alt="Solar Panels">
                        </div>
                        <div class="data-container">
                            <h3>BESS</h3>
                            <p>Power (W)</p>
                            <div class="data-value">
                                <p>10.0000</p>
                            </div>
                            <p>SoC</p>
                            <div class="data-value">
                                <p>10.0000</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="section-container">
                        <div class="img-cont">
                            <img src="./assets/transmission tower.png" alt="Solar Panels">
                        </div>
                        <div class="data-container">
                            <h3>Grid</h3>
                            <p>P. Active (W)</p>
                            <div class="data-value">
                                <p>10.0000</p>
                            </div>
                            <p>P. Reactive (W)</p>
                            <div class="data-value">
                                <p>10.0000</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="top-bottom">
                    <div class="section-container">
                        <div class="img-cont">
                            <img src="./assets/windsock.png" alt="Solar Panels">
                        </div>
                        <div class="data-container">
                            <h3>Weather Station</h3>
                            <p>Irradiance (W/m2)</p>
                            <div class="data-value">
                                <p>10.0000</p>
                            </div>
                            <p>Temperature (C)</p>
                            <div class="data-value">
                                <p>10.0000</p>
                            </div>
                            <p>Wind Speed (m/s)</p>
                            <div class="data-value">
                                <p>10.0000</p>
                            </div>
                            <p>Humidity (%)</p>
                            <div class="data-value">
                                <p>10.0000</p>
                            </div>
                        </div>
                    </div>
                    <div class="section-container" style="margin-left: auto;margin-right: 10%;">
                        <div class="img-cont">
                            <img src="./assets/solar panels.png" alt="Solar Panels">
                        </div>
                        <div class="data-container">
                            <h3>PV</h3>
                            <p>Power AC (W)</p>
                            <div class="data-value">
                                <p>10.0000</p>
                            </div>
                            <p>Frequency (Hz)</p>
                            <div class="data-value">
                                <p>10.0000</p>
                            </div>
                        </div>
                    </div>
                    <div class="section-container">
                        <div class="img-cont">
                            <img src="./assets/solar panels.png" alt="Solar Panels">
                        </div>
                        <div class="data-container">
                            <h3>PV</h3>
                            <p>Power AC (W)</p>
                            <div class="data-value">
                                <p>10.0000</p>
                            </div>
                            <p>Frequency (Hz)</p>
                            <div class="data-value">
                                <p>10.0000</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom">
                <div id="tester" style="width:75vw;height:90%"></div>
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