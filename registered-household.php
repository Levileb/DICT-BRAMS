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
body::-webkit-scrollbar {
    display: none;
}

.tab-content {
    width: 90%;
    max-width: 1200px;
    margin: 0 auto;
    height: auto;
    background-color: white;
    border-radius: 0.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin-top: 100px;
    padding-top: 0px;
}

.wrapper {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    margin-top: -5rem;
}

</style>

<body class="bg-gray-100">
    <?php include 'Includes/header.php'; ?>
    <?php include 'Includes/admin-navbar.php'; ?>

    <div class="wrapper">
        <div id="household-log" class="tab-content" style="padding-top: -5px;">
            <div class="inner-container p-6 w-full" style="margin-top: 10px;">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold text-gray-700" style="padding: 1rem;">REGISTERED HOUSEHOLD LOG</h2>
                    <button id="export-button" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Export to Excel</button>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300 text-sm text-gray-700">
                        <thead class="bg-gray-100 text-gray-800">
                            <tr>
                                <th class="px-4 py-2 border border-gray-300 text-left">Registered By</th>
                                <th class="px-4 py-2 border border-gray-300 text-left">Household Number</th>
                                <th class="px-4 py-2 border border-gray-300 text-left">Household Head</th>
                                <th class="px-4 py-2 border border-gray-300 text-left">Action</th>
                                <th class="px-4 py-2 border border-gray-300 text-left">Timestamp</th>
                            </tr>
                        </thead>
                        <tbody id="household-table">
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
    const logsTable = document.getElementById('logs-table');
    const regLog = document.getElementById('res-reg-table');
    const householdLog = document.getElementById('household-table');

    database.ref('Logs').orderByChild('timestamp').on('value', (snapshot) => {
        let logs = []; // Store logs in an array for sorting
        householdLog.innerHTML = ''; // Clear table before appending data

        snapshot.forEach((childSnapshot) => {
            const log = childSnapshot.val();

            if (log.action === "Household Registration") {
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
                        <td class="px-4 py-2 border border-gray-300">${log.household_number || 'N/A'}</td>
                        <td class="px-4 py-2 border border-gray-300">${log.name || 'N/A'}</td>
                        <td class="px-4 py-2 border border-gray-300">${log.action || 'N/A'}</td>
                        <td class="px-4 py-2 border border-gray-300">${log.timestamp || 'N/A'}</td>
                    </tr>
                `;
            householdLog.innerHTML += row;
        });
    });

    document.getElementById('export-button').addEventListener('click', () => {
        const table = document.getElementById('household-table');
        const ws = XLSX.utils.table_to_sheet(table);

        // Add header row
        const header = ["Registered By", "Household Number", "Household Head", "Action", "Timestamp"];
        XLSX.utils.sheet_add_aoa(ws, [header], { origin: "A1" });

        const range = XLSX.utils.decode_range(ws['!ref']);

        // Assuming timestamps are in the 5th column (index 4), modify as needed
        for (let R = range.s.r + 1; R <= range.e.r; ++R) { // Skip header row
            const cellAddress = XLSX.utils.encode_cell({ r: R, c: 4 }); 
            const cell = ws[cellAddress];

            if (cell && typeof cell.v === 'string') { 
                let timestamp = new Date(cell.v);
                if (!isNaN(timestamp.getTime())) { 
                    ws[cellAddress] = { 
                        t: 'n', // Numeric type for proper Excel date formatting
                        v: (timestamp - new Date(1899, 11, 30)) / 86400000, 
                        z: 'yyyy-mm-dd hh:mm:ss' 
                    };
                }
            }
        }

        // Adjust column widths for better visibility
        ws['!cols'] = Array(range.e.c + 1).fill({ wch: 20 });

        // Create and export workbook
        const wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Sheet1");
        XLSX.writeFile(wb, 'household_logs.xlsx');
    });

    </script>

</body>

</html>