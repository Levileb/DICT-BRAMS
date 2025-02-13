<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Counter</title>
    <link rel="icon" type="image/png" href="Includes/background/bg.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <!-- Include SheetJS for Excel export -->
    <script src="firebase-resident.js"></script> <!-- Your Firebase config file -->
    <script src="archive_resident.js"></script>
</head>
<style>
body::-webkit-scrollbar {
    display: none;
}

.print-container {
    background-color: white;
    padding: 2rem;
    border-radius: 0.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    max-width: 1200px;
    margin: 2rem auto;
    overflow-x: auto;
    margin-top: 3rem;
}

th {
    background-color: rgb(227, 227, 239);
    color: black;
    border: gainsboro;

}

tbody {
    background-color: rgb(255, 255, 255);
    border: 1px black;

}

.success {
    color: green;
}

.failed {
    color: red;
}
</style>

<body class="bg-gray-100">
    <?php include 'Includes/header.php'; ?>
    <?php include 'Includes/admin-navbar.php'; ?>
    <div class="print-container">
        <div class="inner-container p-6 w-full bg-white rounded-lg shadow-md overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b-2 border-gray-300">Date</th>
                        <th class="py-2 px-4 border-b-2 border-gray-300">Time</th>
                        <th class="py-2 px-4 border-b-2 border-gray-300">OR Number</th>
                        <th class="py-2 px-4 border-b-2 border-gray-300">Registered by</th>
                        <th class="py-2 px-4 border-b-2 border-gray-300">Document Type</th>
                        <th class="py-2 px-4 border-b-2 border-gray-300">Print Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Table rows will go here -->
                </tbody>

            </table>

        </div>
    </div>
    </div>
    <?php include 'Includes/footer.php'; ?>
    <script>
    database.ref('PrintLogs').on('value', function(snapshot) {
        var tbody = document.querySelector('tbody');
        tbody.innerHTML = ''; // Clear existing rows

        if (snapshot.exists()) {
            snapshot.forEach(function(childSnapshot) {
                var childData = childSnapshot.val();
                console.log(childData); // Debugging: Check structure

                if (!childData) return; // Skip if no data

                var row = document.createElement('tr');

                var dateCell = document.createElement('td');
                dateCell.className = 'py-2 px-4 border-b border-gray-300';
                dateCell.textContent = childData.date || "N/A";
                row.appendChild(dateCell);

                var timeCell = document.createElement('td');
                timeCell.className = 'py-2 px-4 border-b border-gray-300';
                timeCell.textContent = childData.time || "N/A";
                row.appendChild(timeCell);

                var orNumberCell = document.createElement('td');
                orNumberCell.className = 'py-2 px-4 border-b border-gray-300';
                orNumberCell.textContent = childData.orNumber || "N/A";
                row.appendChild(orNumberCell);

                var emailCell = document.createElement('td');
                emailCell.className = 'py-2 px-4 border-b border-gray-300';
                emailCell.textContent = childData.userEmail || "N/A";
                row.appendChild(emailCell);

                var documentTypeCell = document.createElement('td');
                documentTypeCell.className = 'py-2 px-4 border-b border-gray-300';
                documentTypeCell.textContent = childData.documentType || "N/A";
                row.appendChild(documentTypeCell);


                var printStatusCell = document.createElement('td');
                printStatusCell.className = 'py-2 px-4 border-b border-gray-300';
                printStatusCell.textContent = childData.printStatus || "N/A";

                if (printStatusCell === "Successful") {
                    printStatusCell.childData = 'text-green-500';
                }
                row.appendChild(printStatusCell);
                tbody.appendChild(row);
            });
        } else {
            var row = document.createElement('tr');
            var noRecordsCell = document.createElement('td');
            noRecordsCell.className = 'py-2 px-4 border-b border-gray-300 text-center';
            noRecordsCell.colSpan = 6;
            noRecordsCell.textContent = 'No records found';
            row.appendChild(noRecordsCell);
            tbody.appendChild(row);
        }
    });
    </script>

</body>

</html>