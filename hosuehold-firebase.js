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
    const relationshipToHead = document.getElementById('rhh').value;
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
    if (!firstName || !lastName || !householdNumber || !relationshipToHead) {
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
        relationship_to_head: relationshipToHead,
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
        registration_date: registrationDate
    }).then(() => {
        console.log('Resident information added successfully.');
        showPopup(); // Show the pop-up message
    }).catch((error) => {
        console.error('Error adding resident information:', error);
        alert('There was an error adding the resident information. Please try again.');
    });
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
