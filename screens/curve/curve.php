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
                    <div id="tester-daily" style="width:75vw;height:90%;"></div>
                </div>
            </div>
            <div id="monthly" class="page">
                <div class="left-side">
                    <div id="tester-monthly" style="width:75vw;height:90%;"></div>
                </div>
            </div>
            <div class="right-side">
                <div class="title">
                    <h2>Analysis</h2>
                </div>
                <h3>Today Production (kWh)</h3>
                <div class="input" id="today_production">
                    <p></p>
                </div>
                <h3>Today Saving (Rp.)</h3>
                <div class="input" id="today_saving">
                    <p></p>
                </div>
                <h3>Monthly Production (kWh)</h3>
                <div class="input" id="monthly_production">
                    <p></p>
                </div>
                <h3>Monthly Saving (Rp.)</h3>
                <div class="input" id="monthly_saving">
                    <p></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const fe_electric = 0.794;
        const electricity_bill = 1444.7;

        let currentPage = 'daily'; // Track the current page
        let stringData = []; // Global variable to store data
        let visibilityState = {}; // Store visibility state of traces

        function today_production(data) {
            return data / (60 * 1000);
        }

        function today_saving(data) {
            return today_production(data) * electricity_bill;
        }

        function monthly_production(data_monthly) {
            return data_monthly / (60 * 1000);
        }

        function monthly_saving(data_monthly) {
            return monthly_production(data_monthly) * electricity_bill;
        }

        function switchPage(pageId) {
            currentPage = pageId; // Update the current page
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

            renderChart(pageId);
            updateAnalysis(pageId);
        }

        const layout = {
            title: '',
            xaxis: {
                title: 'Timestamp'
            },
            yaxis: {
                title: {
                    text: 'Energy',
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

        function renderChart(pageId) {
            let chartData;
            if (pageId === 'daily') {
                const aggregatedData = aggregateData(stringData, 'hourly');
                chartData = prepareChartData(aggregatedData, 'hourly');
                Plotly.react('tester-daily', chartData, layout);
            } else if (pageId === 'monthly') {
                const aggregatedData = aggregateData(stringData, 'daily');
                chartData = prepareChartData(aggregatedData, 'daily');
                Plotly.react('tester-monthly', chartData, layout);
            }
        }

        function updateAnalysis(pageId) {
            // Implement analysis update logic if needed
        }

        function aggregateData(data, interval) {
            const aggregated = {};
            data.forEach(item => {
                const date = new Date(item.timestamp);
                let key;
                if (interval === 'hourly') {
                    key = `${date.getFullYear()}-${date.getMonth() + 1}-${date.getDate()} ${date.getHours()}:00`;
                } else if (interval === 'daily') {
                    key = `${date.getFullYear()}-${date.getMonth() + 1}-${date.getDate()}`;
                }

                if (!aggregated[key]) {
                    aggregated[key] = {
                        P_str1: 0,
                        P_str2: 0,
                        P_str3: 0,
                        P_str4: 0,
                        count: 0
                    };
                }

                aggregated[key].P_str1 += parseFloat(item.P_str1);
                aggregated[key].P_str2 += parseFloat(item.P_str2);
                aggregated[key].P_str3 += parseFloat(item.P_str3);
                aggregated[key].P_str4 += parseFloat(item.P_str4);
                aggregated[key].count += 1;
            });

            // Calculate average
            for (let key in aggregated) {
                aggregated[key].P_str1 /= aggregated[key].count;
                aggregated[key].P_str2 /= aggregated[key].count;
                aggregated[key].P_str3 /= aggregated[key].count;
                aggregated[key].P_str4 /= aggregated[key].count;
            }

            return aggregated;
        }

        function prepareChartData(aggregatedData, interval) {
            const x = [];
            const y1 = [];
            const y2 = [];
            const y3 = [];
            const y4 = [];

            for (let key in aggregatedData) {
                if (interval === 'daily') {
                    // Only use the date part for 'monthly'
                    const [year, month, day] = key.split(' ')[0].split('-');
                    x.push(`${year}-${month}-${day}`);
                } else {
                    x.push(key);
                }
                y1.push(aggregatedData[key].P_str1);
                y2.push(aggregatedData[key].P_str2);
                y3.push(aggregatedData[key].P_str3);
                y4.push(aggregatedData[key].P_str4);
            }

            return [{
                    x,
                    y: y1,
                    mode: 'lines+markers',
                    name: 'P_str1',
                    line: {
                        color: 'blue'
                    },
                    visible: visibilityState['P_str1'] !== undefined ? visibilityState['P_str1'] : true
                },
                {
                    x,
                    y: y2,
                    mode: 'lines+markers',
                    name: 'P_str2',
                    line: {
                        color: 'green'
                    },
                    visible: visibilityState['P_str2'] !== undefined ? visibilityState['P_str2'] : true
                },
                {
                    x,
                    y: y3,
                    mode: 'lines+markers',
                    name: 'P_str3',
                    line: {
                        color: 'red'
                    },
                    visible: visibilityState['P_str3'] !== undefined ? visibilityState['P_str3'] : true
                },
                {
                    x,
                    y: y4,
                    mode: 'lines+markers',
                    name: 'P_str4',
                    line: {
                        color: 'orange'
                    },
                    visible: visibilityState['P_str4'] !== undefined ? visibilityState['P_str4'] : true
                }
            ];
        }

        function fetchData() {
            $.ajax({
                url: "./screens/curve/db.php",
                method: "GET",
                success: function(response) {
                    stringData = response.string_data;

                    const allday_data = response.pv_allday;
                    const monthly_data = response.pv_allmonth;

                    const pdcValues = allday_data.map(entry => parseFloat(entry.Pdc));
                    const pdcMonthlyValues = monthly_data.map(entry => parseFloat(entry.Pdc));

                    $("#today_production").text(today_production(pdcValues.reduce((accumulator, currentValue) => accumulator + currentValue, 0)).toFixed(2) || "N/A");
                    $("#today_saving").text(today_saving(pdcValues.reduce((accumulator, currentValue) => accumulator + currentValue, 0)).toFixed(2) || "N/A");
                    $("#monthly_production").text(monthly_production(pdcMonthlyValues.reduce((accumulator, currentValue) => accumulator + currentValue, 0)).toFixed(2) || "N/A");
                    $("#monthly_saving").text(monthly_saving(pdcMonthlyValues.reduce((accumulator, currentValue) => accumulator + currentValue, 0)).toFixed(2) || "N/A");

                    // Store the current visibility state
                    const chartDivId = currentPage === 'daily' ? 'tester-daily' : 'tester-monthly';
                    const chartDiv = document.getElementById(chartDivId);
                    if (chartDiv && chartDiv.data) {
                        chartDiv.data.forEach((trace, index) => {
                            visibilityState[trace.name] = trace.visible;
                        });
                    }

                    renderChart(currentPage); // Update the chart based on the current page
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching data:", error);
                },
            });
        }

        // Fetch data every 5 seconds
        setInterval(fetchData, 5000);

        // Fetch data on page load
        $(document).ready(function() {
            fetchData();
            switchPage(currentPage); // Initial render
        });
    </script>
</body>

</html>
