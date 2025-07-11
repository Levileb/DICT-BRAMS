<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BRAMS - ADMIN</title>
    <link rel="icon" type="image/png" href="Includes/background/background_logo.jpg">
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


    <main class="custom-container mx-auto flex items-center justify-center h-screen px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-center space-y-6 md:space-y-0 md:space-x-12" >
            <!-- Left Section: Text Content -->
            <div class="w-full md:w-1/2 text-center md:text-left space-y-4" >
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
    max-height: 46.4vh; /* Keeps height proportional to viewport */
    width: 100vw; /* Ensures width adapts to screen size */
    max-width: 90%; /* Prevents overflow on larger screens */
    padding-left: 0rem;
}

    body::-webkit-scrollbar {
        display: none;
    }

    body {
        background-image: url('Includes/background/background_logo.jpg');
        background-size:cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: scroll;
        
        
    }
    .background-image {
    position: fixed;
    left: 20;
    top: 50%;
    transform: translateY(-50%);
    width: 30%; /* Adjust as needed */
    max-width: 500px;
}

.footer{

    position: relative;
    width: 100%;
    color: white;
    text-align: center;
}
    </style>


<div class="footer">
<?php include 'Includes/footer.php'; ?>
<!-- Include the footer file -->
</div>
   

</body>

</html>