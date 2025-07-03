<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Logs</title>
    <link rel="icon" type="image/png" href="Includes/background/bg.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
</head>
<style>
#activity-logs .inner-container {
    margin-top: 2rem;
    flex: 1;
    width: 90%;
    height: 100%;
}

#activity-logs table {
    min-width: 50%;
}

.tab-content {
    display: flex;
    background-color: white;
    margin: 10rem;
    border-radius: 0.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin-top: 2rem;
}

body::-webkit-scrollbar {
    display: none;
}

.inner-container::-webkit-scrollbar {
    display: none;
}

.wrapper {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}
</style>

<body class="bg-gray-100">
    <?php include 'Includes/admin-header.php'; ?>

    <div class="wrapper">
        <div id="activity-logs" class="tab-content" style="margin-top: 10px;">
            <div class="inner-container p-6 w-full" style="margin-top: 1rem;">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold text-gray-700">ACTIVITY LOG</h2>
                    <button onclick="exportToExcel()" class="px-4 py-2 bg-green-500 text-white rounded">Export to Excel</button>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 overflow-x-auto">
                    <table id="logs-table" class="w-full border-collapse border border-gray-300 text-sm text-gray-700">
                        <thead class="bg-gray-100 text-gray-800">
                            <tr>
                                <th class="px-4 py-2 border border-gray-300 text-left">User Email</th>
                                <th class="px-4 py-2 border border-gray-300 text-left">Role</th>
                                <th class="px-4 py-2 border border-gray-300 text-left">Action</th>
                                <th class="px-4 py-2 border border-gray-300 text-left">Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Logs will be dynamically inserted here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php include 'Includes/footer.php'; ?>

    <script>
    const firebaseConfig = {
        apiKey: "AIzaSyBiT-xjXZpVOUjxCtbMG-LpfdHaUdHDOSg",
        authDomain: "brams-3dfd3.firebaseapp.com",
        databaseURL: "https://brams-3dfd3-default-rtdb.firebaseio.com/",
        projectId: "brams-3dfd3",
        storageBucket: "brams-3dfd3.firebasestorage.app",
        messagingSenderId: "301528550722",
        appId: "1:301528550722:web:9724e3029567a64c904cdb",
    };
    firebase.initializeApp(firebaseConfig);

    const database = firebase.database();
    const logsTable = document.getElementById('logs-table').getElementsByTagName('tbody')[0];

    database.ref('Logs').orderByChild('timestamp').on('value', (snapshot) => {
        let logs = []; // Store logs in an array for sorting
        logsTable.innerHTML = ''; // Clear table before appending data

        snapshot.forEach((childSnapshot) => {
            const log = childSnapshot.val();

            // Only include logs with role "user"
            if (log.role === "user" && log.action === "login") {
                logs.push(log); // Add logs to the array
            }
        });

        // Sort logs by timestamp in descending order (latest first)
        logs.sort((a, b) => new Date(b.timestamp) - new Date(a.timestamp));

        // Append sorted logs to the table
        logs.forEach((log) => {
            const row = `
                    <tr class="hover:bg-gray-100">
                        <td class="px-4 py-2 border border-gray-300">${log.user || 'N/A'}</td>
                        <td class="px-4 py-2 border border-gray-300">${log.role || 'N/A'}</td>
                        <td class="px-4 py-2 border border-gray-300">${log.action || 'N/A'}</td>
                        <td class="px-4 py-2 border border-gray-300">${log.timestamp || 'N/A'}</td>
                    </tr>
                `;
            logsTable.innerHTML += row;
        });
    });

    function exportToExcel() {
    const table = document.getElementById('logs-table');
    const ws = XLSX.utils.table_to_sheet(table);

    // Ensure all table data remains intact
    const range = XLSX.utils.decode_range(ws['!ref']);

    for (let R = range.s.r + 1; R <= range.e.r; ++R) { // Skip the header row
        const cellAddress = XLSX.utils.encode_cell({ r: R, c: 3 }); // Timestamp column (index 3)
        const cell = ws[cellAddress];

        if (cell && typeof cell.v === 'string') { 
            let timestamp = new Date(cell.v); // Convert timestamp string to Date object
            if (!isNaN(timestamp.getTime())) { // Ensure it's a valid date
                ws[cellAddress] = { 
                    t: 'n', // Numeric type
                    v: (timestamp - new Date(1899, 11, 30)) / 86400000, // Convert to Excel date format
                    z: 'yyyy-mm-dd hh:mm:ss' // Set date format
                };
            }
        }
    }

    // Adjust column widths to ensure visibility
    ws['!cols'] = Array(range.e.c + 1).fill({ wch: 20 }); // Auto-set width for all columns

    // Create a new workbook and append the sheet
    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, "Activity Logs");

    // Write file
    XLSX.writeFile(wb, 'ActivityLogs.xlsx');
}

    </script>

</body>

</html>
