<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./screens/curve/curve.css">

    <script src="./assets/js/plotly-2.35.2.min.js"></script>
</head>

<body>
    <div class="container-menu">
        <div class="top-side">
            <nav data-target="daily" onclick="switchPage('daily')" class="active">Daily</nav>
            <nav data-target="monthly" onclick="switchPage('monthly')">Monthly</nav>
        </div>
        <div class="bottom-side">
            <div id="daily" class="page active">
                <div class="left-side">
                    <div id="tester" style="width:75vw;height:90%;"></div>
                </div>
                <div class="right-side">
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
                </div>
            </div>
            <div id="monthly" class="page">
                <div class="left-side">
                    <div id="tester" style="width:75vw;height:90%;"></div>
                </div>
                <div class="right-side">
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
                </div>
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

        function switchPage(pageId) {
            const pages = document.querySelectorAll('.page');
            const navs = document.querySelectorAll('.top-side nav');

            pages.forEach(page => {
                page.classList.remove('active');
                if (page.id === pageId) {
                    page.classList.add('active');
                }
            });

            navs.forEach(nav => {
                nav.classList.remove('active');
                if (nav.dataset.target === pageId) {
                    nav.classList.add('active');
                }
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            switchPage('daily');
        });
    </script>
</body>

</html>