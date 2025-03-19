<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BRAMS - Efficient Barangay Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-database.js"></script>
    <link href="personnel.css" rel="stylesheet">
</head>
<style> 

</style>
<body class="bg-gray-100">
<?php include 'Includes/header.php'; ?>
<?php include 'Includes/navbar.php'; ?>

<div class="wrapper">
        <div class="container-width container-padding mx-auto mt-8 min-h-screen bg-white shadow-md rounded-lg" style="margin-top: 50px;">
            <div class="flex flex-col sm:flex-row justify-between items-center mb-4">
                <h2 class="large-text text-gray-700">List Of Personnels</h2>
                <div class="flex space-x-4 mt-4 sm:mt-0">
                    
                    <button id="add-resident"
                        class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg">Add Resident</button>
                </div>
            </div>

            <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200 shadow-sm rounded-lg">
                <thead class="bg-green-100">
                    <tr>
                        <th class="py-3 px-4 text-left text-sm font-medium text-gray-500">First Name</th>
                        <th class="py-3 px-4 text-left text-sm font-medium text-gray-500">Middle Name</th>
                        <th class="py-3 px-4 text-left text-sm font-medium text-gray-500">Last Name</th>
                        <th class="py-3 px-4 text-left text-sm font-medium text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody id="residents-list">
                    <!-- Residents list will be dynamically populated here -->
                </tbody>
            </table>
        </div>
    </div>

    <?php include 'Includes/footer.php'; ?>
                
</body>

</html>