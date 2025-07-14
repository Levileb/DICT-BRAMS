<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="Includes/background/bg.png">
    <title>Household Profile</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="Includes/resident_list.css" rel="stylesheet">
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
</head>

<body class="bg-gray-100">
    <?php include 'Includes/header.php'; ?>
    
    <script src="household-profile.js"  defer></script>

    <div class="wrapper">
        <div class="container-width container-padding mx-auto mt-8 min-h-screen bg-white shadow-md rounded-lg" style="margin-top: 20px;">
            <div class="flex flex-col sm:flex-row justify-between items-center mb-4">
                <h2 class="large-text text-gray-700">List of Household</h2>
                <div class="flex space-x-4 mt-4 sm:mt-0">
                    <input type="text" id="search" placeholder="Search..." class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 search-bar-width">
                    <button id="export-button" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg">Export to Excel</button>
                </div>
            </div>

            <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200 shadow-sm rounded-lg">
                <thead class="bg-green-100">
                    <tr>
                        <th class="py-3 px-4 text-left text-sm font-medium text-gray-500">Household Number</th>
                        <th class="py-3 px-4 text-left text-sm font-medium text-gray-500">Last Name</th>
                        <th class="py-3 px-4 text-left text-sm font-medium text-gray-500">First Name</th>
                    </tr>
                </thead>
                <tbody id="residents-list">
                    <!-- Residents list will be dynamically populated here -->
                </tbody>
            </table>
        </div>
    </div>

    <div id="resident-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-2/3" style="margin-top: 10rem;">
        <h2 class="text-lg font-bold text-gray-700 mb-4">Resident Details</h2>
        <div class="scrollable-content" style="max-height: 100px; overflow-y: auto;">
            <p><strong>Registration Date:</strong> <span id="modal-registration-date"></span></p>
            <p><strong>Household Number:</strong> <span id="modal-household-number"></span></p>
            <p><strong>Name:</strong> <span id="modal-first-name"></span> <span id="modal-middle-name"></span> <span id="modal-last-name"></span></p>
            <p><strong>NHTS Status:</strong> <span id="modal-nhts-status"></span></p>
        </div>

        <!-- Table for Selected Members -->
        <h3 class="text-md font-bold text-gray-700 mt-6 mb-2">Selected Members</h3>
        <div class="scrollable-content" style="max-height: 200px; overflow-y: auto;">
            <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200 shadow-sm rounded-lg">
                <thead class="bg-green-100">
                    <tr>
                        <th class="py-2 px-4 text-left text-sm font-medium text-gray-500">Member ID</th>
                        <th class="py-2 px-4 text-left text-sm font-medium text-gray-500">Name</th>
                        <th class="py-2 px-4 text-left text-sm font-medium text-gray-500">Action</th>
                    </tr>
                </thead>
                <tbody id="modal-members-list">
                    <!-- Members will be dynamically populated here -->
                </tbody>
            </table>
        </div>
        <div id="modal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg w-2/3 h-2/3" style="margin-top: 100px">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold">Select a Member</h2>
                    <button id="closed-modal" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
                        X
                    </button>
                </div>
                <div class="overflow-y-auto h-3/4">
                    <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200 shadow-sm rounded-lg h-full">
                        <thead class="bg-green-100">
                            <tr>
                                <th class="py-2 px-4 text-left text-sm font-medium text-gray-500"> </th>
                                <th class="py-2 px-4 text-left text-sm font-medium text-gray-500">Resident ID</th>
                                <th class="py-2 px-4 text-left text-sm font-medium text-gray-500">Fullname</th>
                            </tr>
                        </thead>
                        <tbody id="modal-residents-list" class="h-full">
                            <!-- Residents will be dynamically populated here -->
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 flex justify-end">
                    <button id="add-member" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg mx-auto">+</button>
                </div>
            </div>
        </div>
        <div class="mt-4 flex justify-end">
            <button id="add-modal" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg mx-auto">+</button>
        </div>
        <div class="mt-4 flex justify-end">
            <button id="close-modal" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg ml-2">Close</button>
        </div>
    </div>
</div>
    <?php include 'Includes/footer.php'; ?>

    <style>
/* General Styles */
body {
    font-family: 'Arial', sans-serif;
}

body::-webkit-scrollbar {
  display: auto; /* Hides scrollbar in WebKit browsers */
}
.container-width {
    width: 90%;
    max-width: 1200px;
}

.container-padding {
    padding: 20px;
}

.large-text {
    font-size: 1.5rem;
    font-weight: bold;
}

/* Search Bar */
.search-bar-width {
    width: 100%;
    max-width: 250px;
}

/* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    overflow: hidden;
}

thead {
    background-color: #d1fae5;
}

th, td {
    padding: 12px 16px;
    text-align: left;
    border-bottom: 1px solid #e5e7eb;
}

tbody tr:hover {
    background-color: #f0fdfa;
}


/* Responsive Design */
@media (max-width: 768px) {
    .container-padding {
        padding: 10px;
    }
    
    .flex {
        flex-direction: column;
        align-items: center;
    }
    
    .search-bar-width {
        width: 100%;
    }
    
    th, td {
        padding: 10px;
    }
}

    .wrapper {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        margin-bottom: 50px;
    }

    </style>
</html