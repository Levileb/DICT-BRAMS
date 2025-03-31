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

async function fetchPunongBarangay() {
    const officialsRef = firebase.database().ref('BrgyOfficials');
    console.log("Fetching Punong Barangay data...");

    try {
    const snapshot = await officialsRef.orderByChild('position').equalTo('Punong Barangay').once('value');
    console.log("Snapshot fetched:", snapshot.val());

    if (snapshot.exists()) {
        const punongBarangay = snapshot.val();
        console.log("Punong Barangay data:", punongBarangay);

        const punongBarangayNameElement = document.getElementById('b-name');

        for (const key in punongBarangay) {
        if (punongBarangay.hasOwnProperty(key)) {
            const official = punongBarangay[key];
            console.log("Processing official:", official);

            const fullName = `${official.first_name?.toUpperCase() || "N/A"} ${official.middle_initial?.toUpperCase() || ""}. ${official.last_name?.toUpperCase() || "N/A"}`;
            console.log("Constructed full name:", fullName);

            punongBarangayNameElement.innerText = fullName;
        }
        }
    } else {
        console.error("Punong Barangay not found! Check if 'position' field exists and matches 'Punong Barangay'.");
    }
    } catch (error) {
    console.error("Error fetching Punong Barangay data:", error);
    }
}

// Call the function to fetch data
fetchPunongBarangay();

// Fetch and Display User Data
async function fetchUserData(userId) {
    if (!userId) {
        document.getElementById("first-name").innerText = "No ID Provided";
        return;
    }
  
    const userRef = database.ref("Residents").child(userId);
    try {
        const snapshot = await userRef.once("value");
        if (snapshot.exists()) {
            const userData = snapshot.val();
            document.getElementById("first-name").innerText = userData.first_name || "N/A";
            document.getElementById("last-name").innerText = userData.last_name || "N/A";
            document.getElementById("middle-name").innerText = userData.middle_name || "N/A";
            document.getElementById("address").innerText = `${userData.lot_number || "N/A"}  ${userData.street  || "N/A"} ${userData.barangay  || "N/A"} ${userData.city  || "N/A"}`;
            document.getElementById("contact").innerText = userData.contact_number || "N/A";
            document.getElementById("gender").innerText = userData.gender || "N/A";
            document.getElementById("blood-type").innerText = userData.blood_type || "N/A";
            if (userData.date_of_birth) {
                const date = new Date(userData.date_of_birth);
                const options = { year: 'numeric', month: 'long', day: 'numeric' };
                document.getElementById("dob").innerText = date.toLocaleDateString("en-US", options);
            } else {
                document.getElementById("dob").innerText = "N/A";
            }
            document.getElementById("pob").innerText = userData.place_of_birth || "N/A";
            document.getElementById("emergency-contact").innerText = `${userData.emergency_name || "N/A"} \n ${userData.emergency_phone  || "N/A"}`;
            document.getElementById("id-number").innerText = userData.idNumber || "BC-XXX";
        } else {
            document.getElementById("first-name").innerText = "User Not Found";
            document.getElementById("last-name").innerText = "";
            document.getElementById("middle-name").innerText = "";
            document.getElementById("address").innerText = "";
            document.getElementById("contact").innerText = "";
            document.getElementById("gender").innerText = "";
            document.getElementById("blood-type").innerText = "";
            document.getElementById("dob").innerText = "";
            document.getElementById("pob").innerText = "";
            document.getElementById("emergency-contact").innerText = "";
            document.getElementById("id-number").innerText = "";
        }
    } catch (error) {
        console.error("Error fetching user data:", error);
    }
}

// Run Script on Page Load
document.addEventListener("DOMContentLoaded", () => {
    const userId = getUserIdFromURL();
    fetchUserData(userId);
});
