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
            document.getElementById("fullname").innerText = `${userData.first_name || "N/A"} ${userData.last_name || "N/A"}`;
            document.getElementById("address").innerText = userData.address || "N/A";
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
            document.getElementById("bname").innerText = userData.barangayCaptain || "N/A";
            document.getElementById("id-number").innerText = userData.idNumber || "BC-XXX";

            // Load Profile Image
            if (userData.profileImage) {
                document.getElementById("profile-img").src = userData.profileImage;
            }
        } else {
            document.getElementById("fullname").innerText = "User Not Found";
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
