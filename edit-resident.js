// Firebase configuration and initialization
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

// Get the resident ID from the URL or other means
const urlParams = new URLSearchParams(window.location.search);
const residentId = urlParams.get('id');

if (!residentId) {
    alert('Resident ID not found!');
    // Optionally redirect the user if no ID is found
}

// Fetch existing data and populate the form
database.ref('Residents/' + residentId).once('value').then((snapshot) => {
    const residentData = snapshot.val();
    if (!residentData) {
        console.error('No data found for resident ID:', residentId);
        alert('No data found for this resident.');
        return;
    }
    console.log('Fetched data:', residentData);

    // Populate the form fields
    document.getElementById('first_name').value = residentData.first_name || '';
    document.getElementById('middle_name').value = residentData.middle_name || '';
    document.getElementById('last_name').value = residentData.last_name || '';
    document.getElementById('appellation').value = residentData.appellation || '';
    document.getElementById('place_of_birth').value = residentData.place_of_birth || '';
    document.getElementById('date_of_birth').value = residentData.date_of_birth || '';
    
    // Handle the suffix
    document.getElementById('suffix').value = residentData.suffix || '';

    // Handle radio buttons for gender
    if (residentData.gender) {
        document.querySelector(`input[name="gender"][value="${residentData.gender}"]`).checked = true;
    }
    
    document.getElementById('nationality').value = residentData.nationality || '';
    document.getElementById('civil_status').value = residentData.civil_status || '';
    document.getElementById('philhealth_id').value = residentData.philhealth_id || '';
    document.getElementById('philhealth_membership').value = residentData.philhealth_membership || '';
    document.getElementById('wra').value = residentData.wra || '';
    document.getElementById('educational_attainment').value = residentData.educational_attainment || '';
    document.getElementById('employment_status').value = residentData.employment_status || '';
    document.getElementById('remark_NS').value = residentData.remark_NS || '';
    document.getElementById('resident_since').value = residentData.resident_since || '';
    document.getElementById('contact_number').value = residentData.contact_number || '';
    document.getElementById('emergency_name').value = residentData.emergency_name || '';
    document.getElementById('emergency_phone').value = residentData.emergency_phone || '';
    document.getElementById('relationship').value = residentData.relationship || '';
}).catch((error) => {
    console.error('Error fetching resident data:', error);
    alert('Error fetching resident data. Please check your connection.');
});

// Form submission and update logic
document.getElementById('editForm').addEventListener('submit', function(event) {
    event.preventDefault();

    // Retrieve updated values from the form
    const firstName = document.getElementById('first_name').value;
    const middleName = document.getElementById('middle_name').value;
    const lastName = document.getElementById('last_name').value;
    const appellation = document.getElementById('appellation').value;
    const placeOfBirth = document.getElementById('place_of_birth').value;
    const dateOfBirth = document.getElementById('date_of_birth').value;
    const gender = document.querySelector('input[name="gender"]:checked').value;
    const nationality = document.getElementById('nationality').value;
    const civilStatus = document.getElementById('civil_status').value;
    const philhealthId = document.getElementById('philhealth_id').value;
    const philhealthMembership = document.getElementById('philhealth_membership').value;
    const wra = document.getElementById('wra').value;
    const educationalAttainment = document.getElementById('educational_attainment').value;
    const employmentStatus = document.getElementById('employment_status').value;
    const remarkNS = document.getElementById('remark_NS').value;
    const residentSince = document.getElementById('resident_since').value;
    const contactNumber = document.getElementById('contact_number').value;
    const emergencyName = document.getElementById('emergency_name').value;
    const emergencyPhone = document.getElementById('emergency_phone').value;
    const relationship = document.getElementById('relationship').value;

    // Retrieve the suffix value from the form
    const suffix = document.getElementById('suffix').value;

    // Update all data into a single Residents table
    database.ref('Residents/' + residentId).update({
        first_name: firstName,
        middle_name: middleName,
        last_name: lastName,
        appellation: appellation,
        place_of_birth: placeOfBirth,
        date_of_birth: dateOfBirth,
        gender: gender,
        nationality: nationality,
        civil_status: civilStatus,
        philhealth_id: philhealthId,
        philhealth_membership: philhealthMembership,
        wra: wra,
        educational_attainment: educationalAttainment,
        employment_status: employmentStatus,
        remark_NS: remarkNS,
        resident_since: residentSince,
        contact_number: contactNumber,
        emergency_name: emergencyName,
        emergency_phone: emergencyPhone,
        relationship: relationship,
        suffix: suffix // Add the suffix to the update
    }).then(() => {
        console.log('Resident information updated successfully.');
        document.getElementById('successPopup').classList.remove('hidden');
        setTimeout(() => {
            window.location.href = 'resident_list.php'; // Redirect after success
        }, 2000);
    }).catch((error) => {
        console.error('Error updating resident information:', error);
    });
});
