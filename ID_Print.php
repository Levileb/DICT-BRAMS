<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay ID Form</title>
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-database.js"></script>
    <link rel="stylesheet" href="ID_Print.css">
</head>
<body>
<script>
// Firebase Configuration
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
firebase.initializeApp(firebaseConfig);
const database = firebase.database();

// Function to Get User ID from URL
function getUserIdFromURL() {
    const params = new URLSearchParams(window.location.search);
    return params.get("id");
}

// Function to Fetch Punong Barangay Data
async function fetchPunongBarangay() {
    try {
        const officialsRef = database.ref("BrgyOfficials");
        const snapshot = await officialsRef.orderByChild("position").equalTo("Punong Barangay").once("value");

        if (snapshot.exists()) {
            const punongBarangay = snapshot.val();
            console.log("Punong Barangay Data:", punongBarangay);

            const punongBarangayNameElement = document.getElementById("punong-barangay-name");

            for (const key in punongBarangay) {
                if (punongBarangay.hasOwnProperty(key)) {
                    const official = punongBarangay[key];
                    const fullName = `${official.first_name?.toUpperCase() || "N/A"} ${official.middle_initial?.toUpperCase() || ""}. ${official.last_name?.toUpperCase() || "N/A"}`;
                    punongBarangayNameElement.innerText = fullName;
                    break; // Only take the first match
                }
            }
        } else {
            console.warn("Punong Barangay not found!");
        }
    } catch (error) {
        console.error("Error fetching Punong Barangay data:", error);
    }
}

// Function to Fetch and Display User Data
async function fetchUserData(userId) {
    if (!userId) {
        console.error("No ID Provided");
        return;
    }

    const userRef = database.ref("Residents").child(userId);
    try {
        const snapshot = await userRef.once("value");

        if (snapshot.exists()) {
            const userData = snapshot.val();
            console.log("User Data:", userData);

            document.getElementById("first-name").innerText = (userData.first_name || "N/A").toUpperCase();
            document.getElementById("last-name").innerText = (userData.last_name || "N/A").toUpperCase();
            document.getElementById("middle-name").innerText = (userData.middle_name || "N/A").toUpperCase();
            document.getElementById("address").innerText = `${(userData.lot_number || "N/A").toUpperCase()} ${(userData.street || "N/A").toUpperCase()} ${(userData.barangay || "N/A").toUpperCase()} ${(userData.city || "N/A").toUpperCase()}`;
            document.getElementById("gender").innerText = (userData.gender || "N/A").toUpperCase();
            document.getElementById("blood-type").innerText = (userData.blood_type || "N/A").toUpperCase();
            document.getElementById("dob").innerText = userData.date_of_birth ? new Date(userData.date_of_birth).toLocaleDateString("en-US", { month: "2-digit", day: "2-digit", year: "numeric" }).toUpperCase() : "N/A";
            document.getElementById("emergency-contact").innerText = `${(userData.emergency_name ? userData.emergency_name : "N/A").toUpperCase()} \n ${(userData.emergency_phone ? userData.emergency_phone : "N/A").toUpperCase()}`;
            document.getElementById("id-number").innerText = (userData.idNumber || "BC-XXX").toUpperCase();
        } else {
            console.warn("User not found:", userId);
        }
    } catch (error) {
        console.error("Error fetching user data:", error);
    }
}

// Run Script on Page Load
document.addEventListener("DOMContentLoaded", () => {
    const userId = getUserIdFromURL();
    fetchPunongBarangay();
    fetchUserData(userId);
});
</script>

<!-- ID Card Layout -->
<div class="id-container">
    <!-- Front Side -->
    <div class="id-card">
        <div class="header">
            REPUBLIC OF THE PHILIPPINES<br>Office of Sangguniang Barangay<br>BARANGAY 8<br>Bacolod City
            <div class="id_header">IDENTIFICATION CARD</div>
            <div class="picture-box"></div>
            <div class="custom-form">
                <p>ID Number: <span id="id-number">Loading...</span></p>
                <p>Last Name: <span id="last-name">Loading...</span></p>
                <p>First Name: <span id="first-name">Loading...</span></p>
                <div class="blue-box"></div>
                <p>Middle Name: <span id="middle-name">Loading...</span></p>
            </div>
        </div>
        <div class="row">
            <p>Issued:</p><p id="issued"><?php echo date("m/d/Y"); ?></p>
            <p class="exp">Expires:</p><p id="expire"><?php echo date("m/d/Y", strtotime("+1 year")); ?></p>
        </div>
        <div class="signature">SIGNATURE</div>
        <img src="elements/Barangay_8_Logo.png" alt="logo" class="photo">
    </div>

    <!-- Back Side -->
    <div class="id-card id-card-back">
        <div class="background-logo"></div>
        <div class="form-group">
            <label>Address:</label>
            <div class="rounded-input">
                <div id="address">Loading...</div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Gender:</label>
                <div class="small-rounded"><div id="gender">Loading...</div></div>
            </div>
            <div class="form-group">
                <label>Blood Type:</label>
                <div class="small-rounded"> <div id="blood-type">Loading...</div></div>
            </div>
            <div class="form-group">
                <label>Birthday:</label>
                <div class="small-rounded"><div id="dob">Loading...</div></div>
            </div>
        </div>
        <div class="form-group">
            <label>In case of emergency, please notify:</label>
            <div class="rounded-input"><div id="emergency-contact">Loading...</div></div>
        </div>
        <div class="b-name">
            <p id="punong-barangay-name">Loading...</p>
            <p class="position">BARANGAY CAPTAIN</p>
        </div>
    </div>
</div>
</body>
</html>
