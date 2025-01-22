<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BRAMS - Efficient Barangay Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="Includes/print_template.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <?php include 'Includes/header.php'; ?>
    <?php include 'Includes/navbar.php'; ?>

    <div class="container mx-auto mt-8 min-h-screen flex flex-col items-center">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-6xl">
            <div class="flex justify-between items-center mb-6">
                <a href="resident_list.php" class="bg-green-600 text-white font-bold py-2 px-4 rounded hover:bg-green-700 transition duration-200">Back</a>
            </div>
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">MENU OF DOCUMENTS</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <!-- Certificate of Residency -->
                <div class="p-6 bg-gray-50 rounded-lg shadow-md hover:shadow-lg transition duration-200">
                    <img src="elements/residency.png" alt="Certificate of Residency Icon" class="mb-4 w-25 h-25">
                    <form action="Includes/printable/Printable.php" method="get">
                        <input type="hidden" name="type" value="residency">
                        <input type="hidden" name="resident_id" value="<?php echo $_GET['id']; ?>">
                        <input type="text" name="purpose" placeholder="Enter purpose" class="form-input bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 rounded w-full mb-4 focus:outline-none focus:ring-2 focus:ring-green-400">
                        
                        <div class="flex items-center space-x-4">
                            <input type="text" name="or_number" placeholder="Enter OR number" class="form-input bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 rounded w-full focus:outline-none focus:ring-2 focus:ring-green-400">
                            <button type="submit" class="bg-green-500 text-white font-semibold py-2 px-4 rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 transition duration-200">Print</button>
                        </div>
                    </form>
                </div>

                <!-- Barangay Clearance -->
                <div class="p-6 bg-gray-50 rounded-lg shadow-md hover:shadow-lg transition duration-200">
                    <img src="elements/brgyclearance.png" alt="Barangay Clearance Icon" class="mb-4 w-25 h-25">
                    <form action="Includes/printable/Printable.php" method="get">
                        <input type="hidden" name="type" value="clearance">
                        <input type="hidden" name="resident_id" value="<?php echo $_GET['id']; ?>">
                        <input type="text" name="purpose" placeholder="Enter purpose" class="form-input bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 rounded w-full mb-4 focus:outline-none focus:ring-2 focus:ring-green-400">
                        
                        <div class="flex items-center space-x-4">
                            <input type="text" name="or_number" placeholder="Enter OR number" class="form-input bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 rounded w-full focus:outline-none focus:ring-2 focus:ring-green-400">
                            <button type="submit" class="bg-green-500 text-white font-semibold py-2 px-4 rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 transition duration-200">Print</button>
                        </div>
                    </form>
                </div>

                <!-- Certification -->
                <div class="p-6 bg-gray-50 rounded-lg shadow-md hover:shadow-lg transition duration-200">
                    <img src="elements/cert.png" alt="Certification Icon" class="mb-4 w-25 h-25">
                    <form action="Includes/printable/Printable.php" method="get">
                        <input type="hidden" name="type" value="certification">
                        <input type="hidden" name="resident_id" value="<?php echo $_GET['id']; ?>">
                        <input type="text" name="purpose" placeholder="Enter purpose" class="form-input bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 rounded w-full mb-4 focus:outline-none focus:ring-2 focus:ring-green-400">
                        
                        <div class="flex items-center space-x-4">
                            <input type="text" name="or_number" placeholder="Enter OR number" class="form-input bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 rounded w-full focus:outline-none focus:ring-2 focus:ring-green-400">
                            <button type="submit" class="bg-green-500 text-white font-semibold py-2 px-4 rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 transition duration-200">Print</button>
                        </div>
                    </form>
                </div>

                <!-- Certificate of Indigency -->
                <div class="p-6 bg-gray-50 rounded-lg shadow-md hover:shadow-lg transition duration-200">
                    <img src="elements/indigency.png" alt="Certificate of Indigency Icon" class="mb-4 w-25 h-25">
                    <form action="Includes/printable/Printable.php" method="get">
                        <input type="hidden" name="type" value="indigency">
                        <input type="hidden" name="resident_id" value="<?php echo $_GET['id']; ?>">
                        <input type="text" name="purpose" placeholder="Enter purpose" class="form-input bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 rounded w-full mb-4 focus:outline-none focus:ring-2 focus:ring-green-400">
                        
                        <div class="flex items-center space-x-4">
                            <input type="text" name="or_number" placeholder="Enter OR number" class="form-input bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 rounded w-full focus:outline-none focus:ring-2 focus:ring-green-400">
                            <button type="submit" class="bg-green-500 text-white font-semibold py-2 px-4 rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 transition duration-200">Print</button>
                        </div>
                    </form>
                </div>

                <!-- Certificate of Business Closure -->
                <div class="p-6 bg-gray-50 rounded-lg shadow-md hover:shadow-lg transition duration-200">
                    <img src="elements/business closure.png" alt="Certificate of Business Closure Icon" class="mb-4 w-25 h-25">
                    <form action="Includes/printable/Printable.php" method="get">
                        <input type="hidden" name="type" value="business_closure">
                        <input type="hidden" name="resident_id" value="<?php echo $_GET['id']; ?>">
                        <input type="text" name="purpose" placeholder="Enter purpose" class="form-input bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 rounded w-full mb-4 focus:outline-none focus:ring-2 focus:ring-green-400">
                        
                        <div class="flex items-center space-x-4">
                            <input type="text" name="or_number" placeholder="Enter OR number" class="form-input bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 rounded w-full focus:outline-none focus:ring-2 focus:ring-green-400">
                            <button type="submit" class="bg-green-500 text-white font-semibold py-2 px-4 rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 transition duration-200">Print</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Popup Container
    <div id="popup" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96 text-center">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Additional Information</h3>
            <label for="dropdown" class="block text-gray-700 mb-2">Select a Name:</label>
            <select id="dropdown" class="w-full border border-gray-300 py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-green-400">
                <option value="">-- Select Purpose --</option>
                <option value="employment">Employment</option>
                <option value="school">School</option>
                <option value="travel">Travel</option>
                <option value="others">Others</option>
            </select>
            <div class="mt-6 flex justify-center space-x-4">
                <button onclick="closePopup()" class="bg-red-500 text-white font-semibold py-2 px-4 rounded hover:bg-red-600 focus:outline-none">Cancel</button>
                <button onclick="submitPopup()" class="bg-green-500 text-white font-semibold py-2 px-4 rounded hover:bg-green-600 focus:outline-none">Submit</button>
            </div>
        </div>
    </div>

    <script>
        // Function to show popup
        function showPopup() {
            document.getElementById('popup').style.display = 'flex';
        }

        // Function to close popup
        function closePopup() {
            document.getElementById('popup').style.display = 'none';
        }

        // Function to handle submit inside popup
        function submitPopup() {
            // Here you could process the selected dropdown value
            alert('Form submitted with additional information.');
            closePopup();
        }

        // Attach event listeners to all "Print" buttons
        document.querySelectorAll("button[type='submit']").forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent form submission
                showPopup(); // Show the popup
            });
        });
    </script> -->
    <?php include 'Includes/footer.php'; ?>
</body>
</html>
