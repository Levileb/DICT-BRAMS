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
        document.getElementById("fullname").innerText = "No ID Provided";
        return;
    }
  
    const userRef = database.ref("BrgyHealth/" + userId);
    try {
        const snapshot = await userRef.once("value");
        if (snapshot.exists()) {
            const userData = snapshot.val();
            document.getElementById("fullname").innerText = `${userData.first_name?.toUpperCase() || "N/A"} ${userData.last_name?.toUpperCase() || "N/A"}`;
            document.getElementById("address").innerText = `${userData.lot_number?.toUpperCase() || "N/A"} ${userData.street?.toUpperCase() || "N/A"} ${userData.barangay?.toUpperCase() || "N/A"} ${userData.city || "N/A"}`;
            document.getElementById("contact").innerText = userData.contact_number?.toUpperCase() || "N/A";
            document.getElementById("gender").innerText = userData.gender?.toUpperCase() || "N/A";
            document.getElementById("blood-type").innerText = userData.blood_type?.toUpperCase() || "N/A";
            if (userData.date_of_birth) {
            const date = new Date(userData.date_of_birth);
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById("dob").innerText = date.toLocaleDateString("en-US", options).toUpperCase();
            } else {
            document.getElementById("dob").innerText = "N/A";
            }
            document.getElementById("pob").innerText = userData.place_of_birth?.toUpperCase() || "N/A";
            document.getElementById("emergency-contact").innerText = `${userData.emergency_name?.toUpperCase() || "N/A"} \n ${userData.emergency_phone || "N/A"}`;
            document.getElementById("id-number").innerText = userData.idNumber ? userData.idNumber.toUpperCase() : "BC-XXX";
        } else {
            // Add user if not existing
            const newUserRef = database.ref("BrgyHealth/" + userId);
            const newUserData = {
            first_name: "N/A",
            last_name: "N/A",
            lot_number: "N/A",
            street: "N/A",
            barangay: "N/A",
            city: "N/A",
            contact_number: "N/A",
            gender: "N/A",
            blood_type: "N/A",
            date_of_birth: null,
            place_of_birth: "N/A",
            emergency_name: "N/A",
            emergency_phone: "N/A",
            idNumber: "BC-XXX"
            };
            await newUserRef.set(newUserData);
            document.getElementById("fullname").innerText = "User Not Found. Default User Created.";
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
