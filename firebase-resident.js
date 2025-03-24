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

document.getElementById('registrationForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    // Retrieve Personal Information
    const firstName = document.getElementById('first_name').value;
    const middleName = document.getElementById('middle_name').value;
    const lastName = document.getElementById('last_name').value;
    const appellation = document.getElementById('appellation').value;
    const suffix = document.getElementById('suffix').value; // Added suffix
    const placeOfBirth = document.getElementById('place_of_birth').value;
    const dateOfBirth = document.getElementById('date_of_birth').value;
    const gender = document.querySelector('input[name="gender"]:checked').value;
    const bloodType = document.getElementById('blood_type').value;
    const nationality = document.getElementById('nationality').value;
    const civilStatus = document.getElementById('civil_status').value;
    const philhealthId = document.getElementById('philhealth_id').value;
    const philhealthMembership = document.getElementById('philhealth_membership').value;
    const wra = document.getElementById('wra').value;
    const educationalAttainment = document.getElementById('educational_attainment').value;
    const employmentStatus = document.getElementById('employment_status').value;
    const remarkNS = document.getElementById('remark_NS').value;
    const lotNo = document.getElementById('lot_number').value;
    const street = document.getElementById('street').value;
    const barangay = document.getElementById('barangay').value;
    const city = document.getElementById('city').value;

    // Retrieve Contact Information
    const residentSince = document.getElementById('resident_since').value;
    const contactNumber = document.getElementById('contact_number').value;

    // Retrieve Emergency Contact Information
    const emergencyName = document.getElementById('emergency_name').value;
    const emergencyPhone = document.getElementById('emergency_phone').value;
    const relationship = document.getElementById('relationship').value;

    const businessName = document.getElementById('business_name').value;
    const businessAddress = document.getElementById('business_address').value ;

    // Form validation
    if (!firstName || !lastName || !placeOfBirth || !dateOfBirth || !gender || !civilStatus) {
        alert('Please fill in all required fields.');
        return;
    }

    if (philhealthId && philhealthId.length !== 12) {
        alert('PhilHealth ID must be exactly 12 digits.');
        return;
    }

    if (contactNumber && (contactNumber.length !== 11 || !contactNumber.startsWith('09'))) {
        alert('Contact Number must be exactly 11 digits and start with "09".');
        return;
    }

    // Create a reference for a new resident and get a unique ID
    const residentRef = database.ref('Residents').push();
    const residentId = residentRef.key; // Firebase generates a unique ID

    // Capture current date and time for registration in Philippine time
    const registrationDate = new Date().toLocaleString("en-PH", {
        timeZone: "Asia/Manila",
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit"
    });

    // Insert all data into a single Residents table
    residentRef.set({
        first_name: firstName,
        middle_name: middleName,
        last_name: lastName,
        appellation: appellation,
        suffix: suffix, // Included suffix here
        place_of_birth: placeOfBirth,
        date_of_birth: dateOfBirth,
        gender: gender,
        blood_type: bloodType,
        nationality: nationality,
        civil_status: civilStatus,
        philhealth_id: philhealthId,
        philhealth_membership: philhealthMembership,
        wra: wra,
        educational_attainment: educationalAttainment,
        employment_status: employmentStatus,
        remark_NS: remarkNS,

        // Address Information
        lot_number: lotNo,
        street: street,
        barangay: barangay,
        city: city,

        // Contact Information
        resident_since: residentSince,
        contact_number: contactNumber,
        // Emergency Contact Information
        emergency_name: emergencyName,
        emergency_phone: emergencyPhone,
        relationship: relationship,
        // Registration Date and Time in Philippine Time
        registration_date: registrationDate, // Stores date and time in Philippine format
        business_name: businessName,
        business_address: businessAddress
    }).then(() => {
        console.log('Resident information added successfully.');
        showPopup(); // Show the pop-up message
    }).catch((error) => {
        console.error('Error adding resident information:', error);
        alert('There was an error adding the resident information. Please try again.');
    });

    function logRegistrationActivity(email, registeredName, registrationDate) {
        const logRef = database.ref('Logs').push();
        logRef.set({
            user: email,
            action: `Register Resident`,
            name: registeredName,
            timestamp: registrationDate
        }).then(() => {
            console.log('Registration activity logged successfully.');
        }).catch((error) => {
            console.error('Error logging registration activity:', error);
        });
    }
    

    const email = getCookie('email');  
    const registeredName = `${firstName} ${middleName} ${lastName}`;
    
    // Log the registration activity
    logRegistrationActivity(email, registeredName, registrationDate);
});

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}

function showPopup() {
    const popup = document.getElementById('successPopup');
    popup.classList.remove('hidden');

    // Delay of 2 seconds before redirecting
    setTimeout(() => {
        window.location.href = 'resident_list.php';
    }, 2000); // 2000 milliseconds = 2 seconds
}

// Function to close the pop-up (if needed)
function closePopup() {
    const popup = document.getElementById('successPopup');
    popup.classList.add('hidden');
}
