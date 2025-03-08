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
                            <th>Code</th>
                            <th>Hours</th>
                            <th>Event</th>
                            <th>Cause</th>
                            <th>Solution</th>
                        </tr>
                    </thead>
                    <tbody id="event-table-body">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Contoh data dari database
        const databaseEvents = [{
                date: '2025-03-08',
                hours: '10:30',
                code: '801'
            },
            {
                date: '2025-03-08',
                hours: '11:00',
                code: '901'
            },
            {
                date: '2025-03-08',
                hours: '12:00',
                code: '3601'
            }
        ];

        // Memuat data event dari file JSON
        async function loadEventData() {
            try {
                const response = await fetch('./assets/event_data.json');
                const eventData = await response.json();
                displayEvents(databaseEvents, eventData);
            } catch (error) {
                console.error('Error loading event data:', error);
            }
        }

        // Menampilkan data dalam tabel berdasarkan kode
        // Menampilkan data dalam tabel berdasarkan kode
        function displayEvents(dbEvents, eventData) {
            const tableBody = document.getElementById('event-table-body');
            tableBody.innerHTML = ''; // Mengosongkan isi tabel sebelumnya

            dbEvents.forEach(dbEvent => {
                const eventDetail = eventData.find(event => event.Code.includes(dbEvent.code));
                if (eventDetail) {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                <td>${dbEvent.date}</td>
                <td>${dbEvent.code}</td>
                <td>${dbEvent.hours}</td>
                <td>${eventDetail.Message.replace(/\n/g, '<br>')}</td>
                <td>${eventDetail.Cause.replace(/\n/g, '<br>')}</td>
                <td>${eventDetail.CorrectiveMeasures.replace(/\n/g, '<br>')}</td>
            `;
                    tableBody.appendChild(row);
                } else {
                    console.warn(`Code ${dbEvent.code} not found in event data.`);
                }
            });
        }


        // Memuat data ketika halaman selesai dimuat
        window.onload = loadEventData;
    </script>
</body>

</html>