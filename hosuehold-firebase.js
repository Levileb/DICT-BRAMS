// Firebase configuration
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

// Form submission handler
document.getElementById('householdForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    // Retrieve Household Information
    const firstName = document.getElementById('first_name').value;
    const middleName = document.getElementById('middle_name').value;
    const lastName = document.getElementById('last_name').value;
    const suffix = document.getElementById('suffix').value;
    const householdNumber = document.getElementById('household_number').value;
    const renter = document.getElementById('renter').value;
    const renterMonths = document.getElementById('renter_months').value;

    // Social Economic Status
    const nhtsStatus = document.querySelector('input[name="nhts_status"]:checked')?.value || '';
    const tribe = document.getElementById('tribe').value;

    // Water, Toilet, and Waste Information
    const waterSource = document.getElementById('water_source').value;
    const toiletFacility = document.getElementById('toilet_facility').value;
    const wasteManagement = document.getElementById('waste_management').value;
    const blindDrainage = document.getElementById('blind_drainage').value;

    // Validate required fields
    if (!firstName || !lastName || !householdNumber) {
        alert('Please fill in all required fields.');
        return;
    }

    // Retrieve selected household members' IDs
    const selectedMembers = Array.from(document.querySelectorAll('.checkbox-input'))
        .filter(checkbox => checkbox.checked) // Only include checked checkboxes
        .map(checkbox => checkbox.dataset.id); // Get the `data-id` attribute of the selected checkboxes

    if (selectedMembers.length === 0) {
        alert('Please select at least one household member.');
        return;
    }

    // Create a new reference in Firebase for household
    const householdRef = database.ref('Households').push();
    const householdId = householdRef.key;

    // Capture the current date and time in Philippine time
    const registrationDate = new Date().toLocaleString("en-PH", {
        timeZone: "Asia/Manila",
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit"
    });

    // Insert data into Firebase
    householdRef.set({
        first_name: firstName,
        middle_name: middleName,
        last_name: lastName,
        suffix: suffix,
        household_number: householdNumber,
        renter: renter,
        renter_months: renter === 'Renter_Yes' ? renterMonths : null,
        nhts_status: nhtsStatus,
        tribe: nhtsStatus === 'ip_household' ? tribe : null,
        water_source: waterSource,
        toilet_facility: toiletFacility,
        waste_management: wasteManagement,
        blind_drainage: blindDrainage,
        selected_members: selectedMembers, // Add selected members' IDs
        registration_date: registrationDate,
        timestamp: firebase.database.ServerValue.TIMESTAMP // Add timestamp
    }).then(() => {
        console.log('Resident information added successfully.');
        showPopup(); // Show the pop-up message
    }).catch((error) => {
        console.error('Error adding resident information:', error);
        alert('There was an error adding the resident information. Please try again.');
    });

    function logRegistrationData(email, householdNumber, householdName, registrationDate) {
        const logRef = database.ref('Logs').push();
        logRef.set({
            user: email,
            household_number: householdNumber,
            name: householdName,
            action: `Household Registration`,
            registration_date: registrationDate,
            timestamp: firebase.database.ServerValue.TIMESTAMP // Add timestamp
        }).then(() => {
            console.log('Registration log added successfully.');
        }).catch((error) => {
            console.error('Error adding registration log:', error);
        });
    }
    
    const email = getCookie('email');  
    const householdName = `${firstName} ${middleName} ${lastName}`;
    logRegistrationData(email, householdNumber, householdName, registrationDate);
});

// Function to show the pop-up and then redirect after 2 seconds
function showPopup() {
    const popup = document.getElementById('successPopup');
    popup.classList.remove('hidden');

    // Delay of 2 seconds before redirecting
    setTimeout(() => {
        window.location.href = 'household_profile.php';
    }, 2000); // 2000 milliseconds = 2 seconds
}

// Function to close the pop-up (if needed)
function closePopup() {
    const popup = document.getElementById('successPopup');
    popup.classList.add('hidden');
}
// Function to log registration data
function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}