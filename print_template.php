<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BRAMS - Efficient Barangay Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="Includes/print_template.css" rel="stylesheet">
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-database.js"></script>
</head>
<style> 
    body::-webkit-scrollbar {
    display: none;
}
.popup-style {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: green;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 10px;
  box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
}
</style>
<body class="bg-gray-100">
    <?php include 'Includes/header.php'; ?>
    <?php include 'Includes/navbar.php'; ?>

    <div class="container mx-auto mt-8 min-h-screen flex flex-col items-center" style="margin-top: 90px;">
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
                        <input type="hidden" name="type" value="CERTIFICATE OF RESIDENCY">
                        <input type="hidden" name="resident_id" value="<?php echo $_GET['id']; ?>">
                        <input type="text" name="purpose" placeholder="Enter purpose" class="form-input bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 rounded w-full mb-4 focus:outline-none focus:ring-2 focus:ring-green-400">
                        <select name="incharge" id="incharge5" class="form-input bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 rounded w-full mb-4 focus:outline-none focus:ring-2 focus:ring-green-400">
                            <option value="">Select In-Charge</option>
                        </select>
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
                        <input type="hidden" name="type" value="BARAGAY CLEARANCE">
                        <input type="hidden" name="resident_id" value="<?php echo $_GET['id']; ?>">
                        <input type="text" name="purpose" placeholder="Enter purpose" class="form-input bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 rounded w-full mb-4 focus:outline-none focus:ring-2 focus:ring-green-400">
                        <select name="incharge" id="incharge4" class="form-input bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 rounded w-full mb-4 focus:outline-none focus:ring-2 focus:ring-green-400">
                            <option value="">Select In-Charge</option>
                        </select>
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
                        <input type="hidden" name="type" value="CERTIFICATION">
                        <input type="hidden" name="resident_id" value="<?php echo $_GET['id']; ?>">
                        <input type="text" name="purpose" placeholder="Enter purpose" class="form-input bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 rounded w-full mb-4 focus:outline-none focus:ring-2 focus:ring-green-400">
                        <select name="incharge" id="incharge3" class="form-input bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 rounded w-full mb-4 focus:outline-none focus:ring-2 focus:ring-green-400">
                            <option value="">Select In-Charge</option>
                        </select>
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
                        <input type="hidden" name="type" value="CERTIFICATE OF INDIGENCY">
                        <input type="hidden" name="resident_id" value="<?php echo $_GET['id']; ?>">
                        <input type="text" name="purpose" placeholder="Enter purpose" class="form-input bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 rounded w-full mb-4 focus:outline-none focus:ring-2 focus:ring-green-400">
                        <select name="incharge" id="incharge2" class="form-input bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 rounded w-full mb-4 focus:outline-none focus:ring-2 focus:ring-green-400">
                            <option value="">Select In-Charge</option>
                        </select>
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
                        <input type="hidden" name="type" value="CERTIFICATE OF BUSINESS CLOSURE">
                        <input type="hidden" name="resident_id" value="<?php echo $_GET['id']; ?>">
                        <input type="text" name="purpose" placeholder="Enter purpose" class="form-input bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 rounded w-full mb-4 focus:outline-none focus:ring-2 focus:ring-green-400">
                        <select name="incharge" id="incharge1" class="form-input bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 rounded w-full mb-4 focus:outline-none focus:ring-2 focus:ring-green-400">
                            <option value="">Select In-Charge</option>
                        </select>
                        <div class="flex items-center space-x-4">
                            <input type="text" name="or_number" placeholder="Enter OR number" class="form-input bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 rounded w-full focus:outline-none focus:ring-2 focus:ring-green-400">
                            <button type="submit" class="bg-green-500 text-white font-semibold py-2 px-4 rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 transition duration-200">Print</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>


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

    const firebaseConfig = {
        apiKey: "AIzaSyBiT-xjXZpVOUjxCtbMG-LpfdHaUdHDOSg",
        authDomain: "brams-3dfd3.firebaseapp.com",
        databaseURL: "https://brams-3dfd3-default-rtdb.firebaseio.com/",
        projectId: "brams-3dfd3",
        storageBucket: "brams-3dfd3.firebasestorage.app",
        messagingSenderId: "301528550722",
        appId: "1:301528550722:web:9724e3029567a64c904cdb",
    };

    // Initialize Firebase
    const app = firebase.initializeApp(firebaseConfig);
    const database = firebase.database();

    document.querySelectorAll("button[type='submit']").forEach(button => {
    button.addEventListener('click', async function(event) {
        event.preventDefault(); // Stop form from submitting

        const form = this.closest("form"); // Get the form of the clicked button
        const orNumber = form.querySelector("input[name='or_number']").value.trim();

        if (orNumber === "") {
            showModal("Please enter an OR number.");
            return;
        }

        const printLogsRef = firebase.database().ref('PrintLogs');

        try {
            // Wait for Firebase response
            const snapshot = await printLogsRef.orderByChild("orNumber").equalTo(orNumber).once("value");

            if (snapshot.exists()) {
                let shouldBlockSubmission = false;

                snapshot.forEach(childSnapshot => {
                    const data = childSnapshot.val();
                    if (data.printStatus === "successful" && data.orNumber !== "NA") {
                        shouldBlockSubmission = true;
                    }
                });

                if (shouldBlockSubmission) {
                    showModal("This OR number has already been used. Please enter a different one.");                  
                    return;
                }
            }

            form.submit(); // Submit the form if conditions are met
        } catch (error) {
            console.error("Error checking OR number:", error);
        }
    });
});

function fetchOfficials(dropdownId) {
    const dropdown = document.getElementById(dropdownId);
    if (!dropdown) return; // Prevent errors if the element doesn't exist

    dropdown.innerHTML = '<option value="">Select an official</option>'; // Clear existing options

    const officialsRef = database.ref('BrgyOfficials');

    officialsRef.once('value')
        .then(snapshot => {
            snapshot.forEach(childSnapshot => {
                const official = childSnapshot.val();
                if (official.position !== "Punong Barangay") {
                    const fullName = `${official.first_name} ${official.middle_initial}. ${official.last_name}`;
                    const option = document.createElement('option');
                    option.value = fullName;
                    option.textContent = fullName;
                    dropdown.appendChild(option);
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));
}

// Call the function for different dropdowns
document.addEventListener('DOMContentLoaded', () => {
    fetchOfficials('incharge1');  // For the first dropdown
    fetchOfficials('incharge2');  // For the second dropdown
    fetchOfficials('incharge3');  // For the third dropdown (if needed)
    fetchOfficials('incharge4');
    fetchOfficials('incharge5');
});


        function showModal(message) {
            document.getElementById("modalMessage").innerText = message;
            document.getElementById("popupModal").style.display = "block";
            document.getElementById("modalOverlay").style.display = "block";
        }

        function closeModal() {
            document.getElementById("popupModal").style.display = "none";
            document.getElementById("modalOverlay").style.display = "none";
        }

        // Function to show popup
        function showPopup() {
            document.getElementById('popup').classList.add('popup-style');
            
        }

        // Function to close popup
        function closePopup() {
            document.getElementById('popup').classList.remove('popup-style');
        }

        // Function to handle submit inside popup
        function submitPopup() {
            // Here you could process the selected dropdown value
            alert('Form submitted with additional information.');
            closePopup();
        }

        // Attach event listeners to all "Print" buttons
        document.querySelectorAll("cbutton[type='submit']").forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent form submission
                showPopup(); // Show the popup
            });
        });
    </script> 
    <?php include 'Includes/footer.php'; ?>
</body>
</html>
