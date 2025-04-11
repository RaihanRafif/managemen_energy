<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./screens/event/event.css">
</head>

<body>
    <div class="container-menu">
        <div class="table-container">
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Hours</th>
                            <th>Code</th>
                            <th>Modul</th>
                            <th>Status</th>
                            <th>Recommendation</th>
                        </tr>
                    </thead>
                    <tbody id="event-table-body">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        let previousEventData = null;

        async function loadEventData() {
            try {
                const response = await fetch('./assets/json/string_status.json');
                const eventData = await response.json();
                window.eventReferenceData = eventData;
            } catch (error) {
                console.error('Error loading event data:', error);
            }
        }

        function hasStatusChanged(newData, oldData) {
            if (!oldData) return true;

            if (newData.length !== oldData.length) return true;

            for (let i = 0; i < newData.length; i++) {
                const newItem = newData[i];
                const oldItem = oldData[i];

                for (const key in newItem) {
                    if ((key.startsWith('stat_str') || key.startsWith('stat_inv')) && newItem[key] !== oldItem[key]) {
                        return true;
                    }
                }
            }

            return false;
        }

        function filterActiveEvents(eventList) {
            return eventList.filter(event => {
                return Object.entries(event).some(([key, value]) =>
                    (key.startsWith('stat_str') || key.startsWith('stat_inv')) && value === "1"
                );
            });
        }

        function displayEventRows(eventList, eventReferenceData) {
            const tableBody = document.getElementById('event-table-body');
            tableBody.innerHTML = '';

            eventList.forEach(event => {
                const [date, time] = event.timestamp.split(' ');

                const activeTypes = Object.keys(event)
                    .filter(key => key.startsWith('stat_str') || key.startsWith('stat_inv'))
                    .filter(statKey => event[statKey] === "1")
                    .map(statKey => {
                        const typeKey = statKey.replace('stat_', 'type_');
                        return event[typeKey];
                    })
                    .filter(type => type !== null && type.includes('_'));

                activeTypes.forEach(fullType => {
                    const [modul, code] = fullType.split('_');
                    const statusText = eventReferenceData[0][code]; // Ambil status dari file JSON berdasarkan kode
                    const recommendation = "Nothing"; // Ambil rekomendasi dari file JSON berdasarkan kode

                    const row = document.createElement('tr');
                    row.innerHTML = `
                <td>${date}</td>
                <td>${time}</td>
                <td>${code}</td>
                <td>${modul}</td>
                <td>${statusText || 'Unknown'}</td>
                <td>${recommendation || 'Unknown'}</td>
            `;
                    tableBody.appendChild(row);
                });
            });
        }


        function fetchData() {
            $.ajax({
                url: "./screens/event/db.php",
                method: "GET",
                dataType: "json",
                success: function(response) {
                    console.log("sss", response.event);

                    const newEvent = response.event;
                    const activeEvents = filterActiveEvents(newEvent);

                    if (hasStatusChanged(activeEvents, previousEventData)) {
                        previousEventData = JSON.parse(JSON.stringify(activeEvents));
                        displayEventRows(activeEvents, window.eventReferenceData);
                    } else {
                        console.log("No status change detected. Skipping update.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching data:", error);
                },
            });
        }

        $(document).ready(async function() {
            await loadEventData();
            fetchData();
            setInterval(fetchData, 5000); // Refresh tiap 5 detik
        });
    </script>



</body>

</html>