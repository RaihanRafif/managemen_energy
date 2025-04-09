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
                            <th>Event</th>
                            <th>Cause</th>
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
        async function loadEventData() {
            try {
                const response = await fetch('./assets/event_data.json');
                const eventData = await response.json();
                window.eventReferenceData = eventData;
            } catch (error) {
                console.error('Error loading event data:', error);
            }
        }

        function displayEventRows(eventList, eventReferenceData) {
            const tableBody = document.getElementById('event-table-body');
            tableBody.innerHTML = ''; // Bersihkan isi sebelumnya

            eventList.forEach(event => {
                const eventDetail = eventReferenceData.find(e => e.Code.includes(event.code));
                if (!eventDetail) {
                    console.warn(`Code ${event.code} not found in event data.`);
                    return;
                }

                const [date, time] = event.timestamp.split(' ');

                const row = document.createElement('tr');
                row.innerHTML = `
                <td>${date}</td>
                <td>${time}</td>
                <td>${event.code}</td>
                <td>${eventDetail.Message.replace(/\n/g, '<br>')}</td>
                <td>${eventDetail.Cause.replace(/\n/g, '<br>')}</td>
                <td>${eventDetail.CorrectiveMeasures.replace(/\n/g, '<br>')}</td>
            `;
                tableBody.appendChild(row);
            });
        }

        function fetchData() {
            $.ajax({
                url: "./screens/event/db.php",
                method: "GET",
                dataType: "json",
                success: function(response) {
                    if (response.event && window.eventReferenceData) {
                        displayEventRows(response.event, window.eventReferenceData);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching data:", error);
                },
            });
        }

        $(document).ready(async function() {
            await loadEventData(); // Muat data JSON referensi
            fetchData(); // Tampilkan data pertama
            setInterval(fetchData, 5000); // Refresh data setiap 5 detik
        });
    </script>


</body>

</html>