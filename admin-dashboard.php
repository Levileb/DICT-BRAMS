<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BRAMS - ADMIN</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <!-- Include SheetJS for Excel export -->
    <script src="firebase-resident.js"></script> <!-- Your Firebase config file -->
    <script src="archive_resident.js"></script>
</head>

<body class="bg-gray-100">
    <?php include 'Includes/header.php'; ?>
    <?php include 'Includes/admin-navbar.php'; ?>


    <main class="custom-container mx-auto flex items-center justify-center h-screen px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-center space-y-6 md:space-y-0 md:space-x-12">
            <!-- Left Section: Text Content -->
            <div class="w-full md:w-1/2 text-center md:text-left space-y-4">
                <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 leading-snug">
                    Your Partner in Efficient Barangay Management
                </h1>
                <p class="mt-4 text-gray-700 text-lg">
                    The Barangay Records Automation Management System (B.R.A.M.S) is a comprehensive software solution
                    designed to streamline and automate the management of barangay records.
                </p>
            </div>
        </div>
    </main>

    <style>
    .custom-container {
        max-height: 700px;
        max-width: 900px;
        /* Adjust width as needed */
        padding: 1rem;
        /* Adjust padding */
    }

    @media (min-width: 768px) {
        .custom-container {
            max-width: 1200px;
            /* Wider on medium screens */
        }
    }

    @media (min-width: 1024px) {
        .custom-container {
            max-width: 1400px;
            /* Maximum width on large screens */
        }
    }

    body::-webkit-scrollbar {
        display: none;
    }
    </style>



    <?php include 'Includes/footer.php'; ?>
    <!-- Include the footer file -->

</body>

</html>