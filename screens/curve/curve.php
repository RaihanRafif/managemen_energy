<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./screens/curve/curve.css">
    <script src="./assets/js/plotly-2.35.2.min.js"></script>
</head>

<body>
    <div class="container-menu">
        <div class="top-side">
            <div class="date-picker">
                <!-- <button class="toggle-btn " id="monthly" onclick="togglePicker('pickerYearMonth')">Pick Year & Month</button>
                <button class="toggle-btn active" id="daily" onclick="togglePicker('pickerFullDate')">Pick Year, Month & Date</button> -->
                <div class="picker-container" id="monthly">
                    <select id="year1"></select>
                    <select id="month1">
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>

                    <button class="submit-btn" onclick="getSelectedDate('year1', 'month1', 'output1','',status='monthly')">Submit</button>
                </div>
                <div class="picker-container active" id="daily">
                    <select id="year2"></select>
                    <select id="month2" onchange="updateDays()">
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                    <select id="day"></select>

                    <button class="submit-btn" onclick="getSelectedDate('year2', 'month2', 'output2', 'day',status='daily')">Submit</button>
                </div>
            </div>
            <nav data-target="daily" onclick="switchPage('daily')" class="active">Daily</nav>
            <nav data-target="monthly" onclick="switchPage('monthly')">Monthly</nav>
            <button class="export-btn active" id="daily" onclick="exportToCSV('daily')">Export</button>
            <button class="export-btn" id="monthly" onclick="exportToCSV('monthly')">Export</button>


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
            <div class="right-side active" id="daily">
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
                <h3>CO<sub>2</sub> Reduced</h3>
                <div class="input" id="today_carbon">
                    <p></p>
                </div>
            </div>
            <div class="right-side" id="monthly">
                <div class="title">
                    <h2>Analysis</h2>
                </div>
                <h3>Monthly Production (kWh)</h3>
                <div class="input" id="monthly_production">
                    <p></p>
                </div>
                <h3>Monthly Saving (Rp.)</h3>
                <div class="input" id="monthly_saving">
                    <p></p>
                </div>
                <h3>CO<sub>2</sub> Reduced</h3>
                <div class="input" id="monthly_carbon">
                    <p></p>
                </div>
            </div>

        </div>
    </div>

    <script>
        const fe_electric = 0.794;
        const electricity_bill = 1444.7;

        let currentPage = 'daily'; // Track the current page
        let data = {
            'daily': [],
            'monthly': [],
            'daily_analysis': 0,
            'monthly_analysis': 0,
        }; // Global variable to store data
        let visibilityState = {}; // Store visibility state of traces

        //date-picker
        function populateYears(selectId) {
            const yearSelect = document.getElementById(selectId);
            const currentYear = new Date().getFullYear();
            for (let i = currentYear; i >= currentYear - 100; i--) {
                let option = document.createElement("option");
                option.value = i;
                option.textContent = i;
                yearSelect.appendChild(option);
            }
        }

        populateYears("year1");
        populateYears("year2");

        // Function to update days based on selected month & year (Leap year support)
        function updateDays() {
            const month = document.getElementById("month2").value;
            const year = document.getElementById("year2").value;
            const daySelect = document.getElementById("day");

            const daysInMonth = new Date(year, month, 0).getDate(); // Get last day of selected month
            daySelect.innerHTML = ""; // Clear previous options

            for (let i = 1; i <= daysInMonth; i++) {
                let option = document.createElement("option");
                option.value = i < 10 ? "0" + i : i;
                option.textContent = i;
                daySelect.appendChild(option);
            }
        }

        updateDays(); // Initialize days dropdown


        // Function to get selected date
        function getSelectedDate(yearId, monthId, outputId, dayId = null, status) {
            const year = document.getElementById(yearId).value;
            const month = document.getElementById(monthId).value;
            let dateText = `${year}-${month}`;

            if (dayId) {
                const day = document.getElementById(dayId).value;
                dateText += `-${day}`;
            }

            const pickerContainer = document.querySelectorAll(".picker-container")

            if (status == 'daily') {
                fetchData(dateText, "daily");
            } else {
                fetchData(dateText, "hourly");
            }

            // Fetch and update data based on the selected date/month

        }

        // Hide popups when clicking outside
        document.addEventListener("click", function(event) {
            const pickers = document.querySelectorAll(".picker-container");
            const buttons = document.querySelectorAll(".toggle-btn");

            let isInsidePicker = Array.from(pickers).some(picker => picker.contains(event.target));
            let isButton = Array.from(buttons).some(button => button.contains(event.target));

        });
        //

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

        function total_energy(data_start_feb) {
            return data_start_feb / (60 * 1000)
        }

        function carbondioxyde_reduced(data) {
            return total_energy(data) * fe_electric
        }

        function switchPage(pageId) {
            currentPage = pageId; // Update the current page
            const pages = document.querySelectorAll('.page');
            const right_sides = document.querySelectorAll('.right-side');
            const export_btns = document.querySelectorAll('.export-btn');
            const navs = document.querySelectorAll('.top-side nav');
            const picker_containers = document.querySelectorAll('.picker-container');

            const datePickerButtons = document.querySelectorAll('.toggle-btn');

            datePickerButtons.forEach(btn => {
                btn.classList.remove('active');
                if (btn.id === pageId) {
                    btn.classList.add('active');
                }
            });

            picker_containers.forEach(item => {
                item.classList.remove('active');
                if (item.id === pageId) {
                    item.classList.add('active');
                }
            });


            pages.forEach(page => {
                page.classList.remove('active');
                if (page.id === pageId) {
                    page.classList.add('active');
                }
            });

            right_sides.forEach(right_side => {
                right_side.classList.remove('active');
                if (right_side.id === pageId) {
                    right_side.classList.add('active');
                }
            });

            export_btns.forEach(btn => {
                btn.classList.remove('active');
                if (btn.id === pageId) {
                    btn.classList.add('active');
                }
            });

            navs.forEach(nav => {
                nav.classList.remove('active');
                if (nav.dataset.target === pageId) {
                    nav.classList.add('active');
                }
            });


            renderChart(pageId);
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

        const layoutDaily = {
            title: '',
            xaxis: {
                title: 'Time',
                type: "date"
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

        function renderChart(pageId) {
            let chartData;
            if (pageId === "daily") {
                chartData = prepareChartData(data.daily, "hourly");
                Plotly.react("tester-daily", chartData, layoutHourly);
            } else if (pageId === "monthly") {
                chartData = prepareChartData(data.monthly, "daily");
                Plotly.react("tester-monthly", chartData, layoutDaily);
            }
        }

        function prepareChartData(data, interval) {
            const x = [];
            const y1 = [];
            const y2 = [];
            const y3 = [];
            const y4 = [];

            if (interval == "hourly") {
                data.forEach((item) => {
                    y1.push(item.P_str1);
                    y2.push(item.P_str2);
                    y3.push(item.P_str3);
                    y4.push(item.P_str4);
                    x.push(item.hour);
                });
            } else {
                data.forEach((item) => {
                    y1.push(item.P_str1);
                    y2.push(item.P_str2);
                    y3.push(item.P_str3);
                    y4.push(item.P_str4);
                    x.push(item.date);
                });
            }

            return [{
                    x,
                    y: y1,
                    type: "bar",
                    name: "P_str1",
                    marker: {
                        color: "blue",
                    },
                    visible: visibilityState["P_str1"] !== undefined ? visibilityState["P_str1"] : true,
                },
                {
                    x,
                    y: y2,
                    type: "bar",
                    name: "P_str2",
                    marker: {
                        color: "green",
                    },
                    visible: visibilityState["P_str2"] !== undefined ? visibilityState["P_str2"] : true,
                },
                {
                    x,
                    y: y3,
                    type: "bar",
                    name: "P_str3",
                    marker: {
                        color: "red",
                    },
                    visible: visibilityState["P_str3"] !== undefined ? visibilityState["P_str3"] : true,
                },
                {
                    x,
                    y: y4,
                    type: "bar",
                    name: "P_str4",
                    marker: {
                        color: "orange",
                    },
                    visible: visibilityState["P_str4"] !== undefined ? visibilityState["P_str4"] : true,
                },
            ];
        }


        //data processing
        // Helper function to parse timestamp
        function parseTimestamp(timestamp) {
            return new Date(timestamp.replace(" ", "T"));
        }

        function fetchData(date = null, status = "current") {
            $.ajax({
                url: "./screens/curve/db.php",
                data: {
                    date
                },
                method: "GET",
                success: function(response) {
                    stringData = response.string_data;
                    analysisData = response.analysis_data;

                    console.log("11111 :  ", stringData);
                    console.log("22222 ", analysisData);

                    // Find the last date available
                    let dailyData = {};
                    if (stringData.length > 0) {
                        let lastDate = new Date(
                            Math.max(
                                ...stringData.map((item) => parseTimestamp(item.timestamp).getTime())
                            )
                        );
                        let lastDateString = lastDate.toISOString().split("T")[0];

                        // Group data by hour for the last date

                        stringData
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

                        data.daily_analysis = 0
                        analysisData
                            .filter((item) => item.timestamp.startsWith(lastDateString))
                            .map((item) => {
                                data.daily_analysis += parseFloat(item.Pac)
                            });

                    }

                    // Convert dailyData object to array and sort by hour 15 first
                    if (status == "current" || status == "daily") {
                        data.daily = Object.values(dailyData)

                        console.log("2222 : ", data.daily_analysis);

                        $("#today_production").text(today_production(data.daily_analysis).toFixed(2) || "N/A");
                        $("#today_saving").text(today_saving(data.daily_analysis).toFixed(2) || "N/A");
                        $("#today_carbon").text(carbondioxyde_reduced(data.daily_analysis).toFixed(2) || "N/A");
                        // $("#monthly_production").text(monthly_production(pdcMonthlyValues.reduce((accumulator, currentValue) => accumulator + currentValue, 0)).toFixed(2) || "N/A");
                        // $("#monthly_saving").text(monthly_saving(pdcMonthlyValues.reduce((accumulator, currentValue) => accumulator + currentValue, 0)).toFixed(2) || "N/A");
                        console.log("tesss11", data);
                    }

                    // Group data by day for the month
                    let monthlyData = {};
                    stringData.forEach((item) => {
                        let date = parseTimestamp(item.timestamp).toISOString().split("T")[0];
                        if (!monthlyData[date]) {
                            monthlyData[date] = {
                                date: date,
                                P_str1: 0,
                                P_str2: 0,
                                P_str3: 0,
                                P_str4: 0,
                            };
                        }
                        monthlyData[date].P_str1 += parseFloat(item.P_str1);
                        monthlyData[date].P_str2 += parseFloat(item.P_str2);
                        monthlyData[date].P_str3 += parseFloat(item.P_str3);
                        monthlyData[date].P_str4 += parseFloat(item.P_str4);
                    });

                    data.monthly_analysis = 0
                    analysisData.map((item) => data.monthly_analysis += parseFloat(item.Pac));

                    // Convert monthlyData object to array
                    if (status == "current" || status == "hourly") {
                        data.monthly = Object.values(monthlyData);

                        console.log("3333 : ", data.monthly_analysis);

                        $("#monthly_production").text(monthly_production(data.monthly_analysis).toFixed(2) || "N/A");
                        $("#monthly_saving").text(monthly_saving(data.monthly_analysis).toFixed(2) || "N/A");
                        $("#monthly_carbon").text(carbondioxyde_reduced(data.monthly_analysis).toFixed(2) || "N/A");
                        console.log("tissss2222 : ", data);
                    }

                    // Store the current visibility state
                    const chartDivId =
                        currentPage === "daily" ? "tester-daily" : "tester-monthly";
                    const chartDiv = document.getElementById(chartDivId);
                    if (chartDiv && chartDiv.data) {
                        chartDiv.data.forEach((trace, index) => {
                            visibilityState[trace.name] = trace.visible;
                        });
                    }

                    renderChart(currentPage);
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching data:", error);
                },
            });
        }

        function exportToCSV(status = 'daily') {
            let dataArray;
            let filename;
            let analysisValue;
            let statusName;

            let tempProduction;
            let tempSaving;
            let tempReduction;

            if (status === 'daily') {
                dataArray = data.daily;
                filename = 'daily_data.csv';
                analysisValue = data.daily_analysis;
                statusName = 'Daily';
            } else {
                dataArray = data.monthly;
                filename = 'monthly_data.csv';
                analysisValue = data.monthly_analysis;
                statusName = 'Monthly';
            }

            if (!dataArray || dataArray.length === 0) {
                console.error("No data to export");
                return;
            }

            // Compute static values (only once)
            let production = today_production(analysisValue).toFixed(2);
            let saving = today_saving(analysisValue).toFixed(2);
            let reduces = carbondioxyde_reduced(analysisValue).toFixed(2);

            // Define CSV headers (Adding three new headers)
            const headers = [...Object.keys(dataArray[0]), ``, `${statusName} Production`, `${statusName} Saving`, `CO2 Reduces`].join(",") + "\n";

            // Convert data to CSV format (Appending the same production, saving, reduces to each row)
            const rows = dataArray.map(row => {
                production == tempProduction ? production = '' : tempProduction = production
                saving == tempSaving ? saving = '' : tempSaving = saving
                reduces == tempReduction ? reduces = '' : tempReduction = reduces
                return [
                    ...Object.values(row), // Existing row data
                    "",
                    production, // Add Production value
                    saving, // Add Saving value
                    reduces // Add Reduces value
                ].map(value => `"${value}"`).join(",");
            }).join("\n");

            // Create CSV content
            const csvContent = headers + rows;
            const blob = new Blob([csvContent], {
                type: "text/csv"
            });
            const url = URL.createObjectURL(blob);

            // Create a temporary link to trigger download
            const a = document.createElement("a");
            a.href = url;
            a.download = filename;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }


        // Fetch data on page load
        $(document).ready(function() {
            const today = new Date();
            const currentYear = today.getFullYear();
            const currentMonth = today.getMonth() + 1; // Months are 0-based, so we add 1.

            document.getElementById("year1").value = currentYear;
            document.getElementById("month1").value = currentMonth < 10 ? "0" + currentMonth : currentMonth;

            // Set default year, month, and day for 'pickerFullDate'
            document.getElementById("year2").value = currentYear;
            document.getElementById("month2").value = currentMonth < 10 ? "0" + currentMonth : currentMonth;
            updateDays(); // Update days based on current month

            const currentDate = today.getDate();
            document.getElementById("day").value = currentDate < 10 ? "0" + currentDate : currentDate;

            fetchData();
            switchPage(currentPage); // Initial render
        });
    </script>
</body>

</html>