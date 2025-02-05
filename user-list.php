<!DOCTYPE html>
<html lang="en">
<head>
<head>    
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BRAMS - ADMIN</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
    <!-- <script src="user-create.js"></script>  -->
    <link rel="stylesheet" href="user-register.css">       
    </head>
</head>
<body>
<?php include 'Includes/header.php'; ?>
<?php include 'Includes/admin-navbar.php'; ?>


 <table>
    
</table>
<table class="min-w-full leading-normal">
    <thead>
        <tr>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Email
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Name
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Action
            </th>
        </tr>
    </thead>
</table>
<script>
    // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "AIzaSyBiT-xjXZpVOUjxCtbMG-LpfdHaUdHDOSg",
        authDomain: "brams-3dfd3.firebaseapp.com",
        databaseURL: "https://brams-3dfd3-default-rtdb.firebaseio.com/",
        projectId: "brams-3dfd3",
        storageBucket: "brams-3dfd3.firebasestorage.app",
        messagingSenderId: "301528550722",
        appId: "1:301528550722:web:9724e3029567a64c904cdb",
        };
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);

        // Reference to your entire Firebase database
        var database = firebase.database().ref('Users');

        // Fetch data from Firebase
        database.on('value', function(snapshot) {
        var users = snapshot.val();
        var tableBody = document.createElement('tbody');

        for (var id in users) {
            var user = users[id];
            if (user.role === 'user') {
                var row = document.createElement('tr');

                var emailCell = document.createElement('td');
                emailCell.className = "px-5 py-5 border-b border-gray-200 bg-white text-sm";
                emailCell.textContent = user.email;
                row.appendChild(emailCell);

                var nameCell = document.createElement('td');
                nameCell.className = "px-5 py-5 border-b border-gray-200 bg-white text-sm";
                nameCell.textContent = user.first_name + " " + user.last_name;
                row.appendChild(nameCell);

                var actionCell = document.createElement('td');
                actionCell.className = "px-5 py-5 border-b border-gray-200 bg-white text-sm";
                var deleteButton = document.createElement('button');
                deleteButton.textContent = "Delete";
                deleteButton.className = "text-red-600 hover:text-red-900";
                deleteButton.onclick = function() {
                    database.child(id).remove();
                };
                deleteButton.onclick = function() {
                    console.log("Delete button clicked for user: " + user.email);
                    if (confirm("Are you sure you want to delete this user?")) {
                        database.child(id).remove();
                    }
                };
                actionCell.appendChild(deleteButton);
                row.appendChild(actionCell);

                tableBody.appendChild(row);
            }
        }

        document.querySelector('table.min-w-full').appendChild(tableBody);
    });
</script>

<?php include 'Includes/footer.php'; ?>
</body>
</html>