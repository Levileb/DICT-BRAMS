<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Logs</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
</head>

<style>
body::-webkit-scrollbar {
    display: none;
}
</style>

<body class="bg-gray-100">
    <?php include 'Includes/header.php'; ?>
    <?php include 'Includes/admin-navbar.php'; ?>

    <div id="household-log"
        class="tab-content container mx-auto flex items-center justify-center h-screen px-8 py-6 max-w-2xl my-8 bg-white rounded-lg shadow-md">
        <div class="inner-container p-6 w-full">
            <h5><strong>Registered Household Log</strong></h5>
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
    database.ref('Logs').orderByChild('timestamp').on('value', (snapshot) => {
        let logs = []; // Store logs in an array for sorting
        regLog.innerHTML = ''; // Clear table before appending data

        snapshot.forEach((childSnapshot) => {
            const log = childSnapshot.val();

            // Only include logs with role "user"
            if (log.action === "Register Resident") {
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
                        <td class="px-4 py-2 border border-gray-300">${log.name|| 'N/A'}</td>
                        <td class="px-4 py-2 border border-gray-300">${log.action || 'N/A'}</td>
                        <td class="px-4 py-2 border border-gray-300">${log.timestamp || 'N/A'}</td>
                    </tr>
                `;
            regLog.innerHTML += row;
        });
    });

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
    </script>

</body>

</html>