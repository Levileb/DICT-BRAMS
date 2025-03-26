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
                    
                    <button id="add-resident" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg">Add Personnel</button>
                    <div id="add-resident-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden" style="z-index: 1000;">
                        <div class="bg-white rounded-lg shadow-lg w-[40rem] p-6" style=" margin-top:10%; width: 500px; height: 550px;">
                    
                            <div class="flex flex-col items-center mb-4">
                                <h3 class="text-xl font-bold text-gray-700 mb-4 text-center uppercase">Resident List</h3>
                                <input type="text" id="search-resident" placeholder="Search residents..." class="border border-gray-300 rounded-lg px-4 py-2 w-full sm:w-auto text-center">
                            </div>
                            <div class="overflow-y-auto max-h-80">
                                <table class="w-full border-collapse border border-gray-300">
                                    <thead>
                                        <tr class="bg-gray-200">
                                            <th class="border border-gray-300 px-4 py-2 text-center">Select</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left">Full Name</th>
                                        </tr>
                                    </thead>
                                    <tbody id="resident-list-table">
                                        <!-- Residents will be dynamically populated here -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="flex justify-end space-x-4 mt-4">
                                <button type="button" id="cancel-modal" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">Cancel</button>
                                <button type="button" id="save-residents" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">Save</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200 shadow-sm rounded-lg">
                <thead class="bg-green-100">
                    <tr>
                        <th class="py-3 px-4 text-left text-sm font-medium text-gray-500">First Name</th>
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
    <script src="utility.js"></script>
</body>
</html>

