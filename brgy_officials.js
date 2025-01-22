// Firebase initialization (Make sure this is present in your script.js)
const firebaseConfig = {
    apiKey: "AIzaSyBiT-xjXZpVOUjxCtbMG-LpfdHaUdHDOSg",
    authDomain: "brams-3dfd3.firebaseapp.com",
    databaseURL: "https://brams-3dfd3-default-rtdb.firebaseio.com/",
    projectId: "brams-3dfd3",
    storageBucket: "brams-3dfd3.firebasestorage.app",
    messagingSenderId: "301528550722",
    appId: "1:301528550722:web:9724e3029567a64c904cdb",
};
const app = firebase.initializeApp(firebaseConfig);
const database = firebase.database();

// Form submission handler
document.getElementById('editForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    console.log("Form submitted"); // Debug log

    // Retrieve form data
    const firstName = document.querySelector('input[name="first_name"]').value;
    const middleInitial = document.querySelector('input[name="middle_initial"]').value;
    const lastName = document.querySelector('input[name="last_name"]').value;
    const suffix = document.querySelector('select[name="suffix"]').value;

    // Validation (basic)
    if (!firstName || !lastName || !middleInitial) {
        alert('Please fill in all required fields.');
        return;
    }

    // Create reference to database
    const ref = database.ref('Brgy_Official').push();
    
    // Insert data into Firebase Realtime Database
    ref.set({
        first_name: firstName,
        middle_initial: middleInitial,
        last_name: lastName,
        suffix: suffix,
    })
    .then(() => {
        console.log('Data inserted successfully');
        showPopup(); // Call function to show success popup
    })
    .catch((error) => {
        console.error('Error inserting data: ', error);
        alert('There was an error inserting data. Please try again.');
    });
});

// Popup function
function showPopup() {
    const popup = document.createElement('div');
    popup.textContent = 'Data inserted successfully!';
    popup.style.position = 'fixed';
    popup.style.top = '50%';
    popup.style.left = '50%';
    popup.style.transform = 'translate(-50%, -50%)';
    popup.style.padding = '20px';
    popup.style.backgroundColor = 'green';
    popup.style.color = 'white';
    popup.style.fontWeight = 'bold';
    document.body.appendChild(popup);

    setTimeout(() => {
        window.location.href = 'resident_list.php'; // Redirect after 2 seconds
    }, 2000);
}
