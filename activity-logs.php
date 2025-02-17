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
    <style>
        #activity-logs .inner-container {
            margin-top: 1rem;
            flex: 1;
            width: 100%;
            height: 100%;
        }

        #activity-logs table {
            min-width: 10%;
        }

        .tab-content {
            display: flex;
            background-color: white;
            margin: 8rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 100px;
        }

        body::-webkit-scrollbar {
            display: none;
        }

        .inner-container::-webkit-scrollbar {
            display: none;
        }

        .scrollable-content {
            max-height: 400px;
            overflow-y: auto;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: -1rem auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-height: 80%;
            overflow-y: auto;
            margin-top: 15%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-gray-100">
    <?php include 'Includes/header.php'; ?>
    <?php include_once 'Includes/admin-navbar.php'; ?>
    <div id="activity-logs" class="tab-content">
        <div class="inner-container p-6 w-full" style="margin-top: 10px;">
            <h2 class="text-2xl font-bold text-gray-700" style="padding-top: -1rem;">ACTIVITY LOG</h2>
            <div class="bg-white rounded-lg shadow-md p-6 overflow-x-auto" style="margin-top: 2vh;">
                <table class="w-full border-collapse border border-gray-300 text-sm text-gray-700">
                    <thead class="bg-gray-100 text-gray-800">
                        <tr>
                            <th class="px-4 py-2 border border-gray-300 text-left">User Email</th>
                            <th class="px-4 py-2 border border-gray-300 text-left">Role</th>
                            <th class="px-4 py-2 border border-gray-300 text-left">Action</th>
                            <th class="px-4 py-2 border border-gray-300 text-left">Timestamp</th>
                        </tr>
                    </thead>
                    <tbody id="logs-table">
                        <!-- Logs will be dynamically inserted here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal for detailed logs -->
    <div id="logModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Detailed Logs</h2>
            <div class="scrollable-content">
                <table class="w-full border-collapse border border-gray-300 text-sm text-gray-700">
                    <thead class="bg-gray-100 text-gray-800">
                        <tr>
                            <th class="px-4 py-2 border border-gray-300 text-left">User Email</th>
                            <th class="px-4 py-2 border border-gray-300 text-left">Role</th>
                            <th class="px-4 py-2 border border-gray-300 text-left">Action</th>
                            <th class="px-4 py-2 border border-gray-300 text-left">Timestamp</th>
                        </tr>
                    </thead>
                    <tbody id="modal-logs-table">
                        <!-- Detailed logs will be dynamically inserted here -->
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
        const modalLogsTable = document.getElementById('modal-logs-table');
        const logModal = document.getElementById('logModal');
        const closeModal = document.getElementsByClassName('close')[0];

        database.ref('Logs').orderByChild('timestamp').on('value', (snapshot) => {
            let logs = []; // Store logs in an array for sorting
            logsTable.innerHTML = ''; // Clear table before appending data

            snapshot.forEach((childSnapshot) => {
                const log = childSnapshot.val();
                logs.push(log); // Add logs to the array
            });

            // Sort logs by timestamp in descending order (latest first)
            logs.sort((a, b) => new Date(b.timestamp) - new Date(a.timestamp));

            // Append sorted logs to the table
            logs.forEach((log) => {
                const row = `
                    <tr class="hover:bg-gray-100" onclick="showLogDetails('${log.user}', '${log.role}', '${log.action}', '${log.timestamp}')">
                        <td class="px-4 py-2 border border-gray-300">${log.user || 'N/A'}</td>
                        <td class="px-4 py-2 border border-gray-300">${log.role || 'N/A'}</td>
                        <td class="px-4 py-2 border border-gray-300">${log.action || 'N/A'}</td>
                        <td class="px-4 py-2 border border-gray-300">${log.timestamp || 'N/A'}</td>
                    </tr>
                `;
                logsTable.innerHTML += row;
            });
        });

        function showLogDetails(user, role, action, timestamp) {
            modalLogsTable.innerHTML = `
                <tr>
                    <td class="px-4 py-2 border border-gray-300">${user}</td>
                    <td class="px-4 py-2 border border-gray-300">${role}</td>
                    <td class="px-4 py-2 border border-gray-300">${action}</td>
                    <td class="px-4 py-2 border border-gray-300">${timestamp}</td>
                </tr>
            `;
            logModal.style.display = "block";
        }

        closeModal.onclick = function() {
            logModal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == logModal) {
                logModal.style.display = "none";
            }
        }
    </script>

</body>

</html>