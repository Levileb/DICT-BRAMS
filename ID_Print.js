const firebaseConfig = {
    apiKey: "AIzaSyBiT-xjXZpVOUjxCtbMG-LpfdHaUdHDOSg",
    authDomain: "brams-3dfd3.firebaseapp.com",
    databaseURL: "https://brams-3dfd3-default-rtdb.firebaseio.com/",
    projectId: "brams-3dfd3",
    storageBucket: "brams-3dfd3.appspot.com",
    messagingSenderId: "301528550722",
    appId: "1:301528550722:web:9724e3029567a64c904cdb",
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);
const database = firebase.database();

document.addEventListener("DOMContentLoaded", function () {
    const residentIdInput = document.getElementById("residentId");
    
    if (residentIdInput) {
        const residentId = residentIdInput.value;
        if (residentId) {
            fetchResidentDetails(residentId);
        } else {
            console.error("Resident ID is empty!");
        }
    } else {
        console.error("Resident ID input element not found!");
    }
});

function fetchResidentDetails(residentId) {
    const residentRef = database.ref('Residents/' + residentId);
    
    residentRef.once('value', function (snapshot) {
        if (snapshot.exists()) {
            const residentData = snapshot.val();
            populateResidentDetails(residentData);
        } else {
            console.error("Resident not found!");
        }
    });
}

function safeValue(value, placeholder) {
    return value && value.trim() ? value : placeholder;
}

function populateResidentDetails(residentData) {
    const fullName = `${safeValue(residentData.first_name, '')} ${safeValue(residentData.middle_name, '')} ${safeValue(residentData.last_name, '')} ${residentData.suffix && residentData.suffix !== 'Select Suffix' && residentData.suffix !== 'none' ? safeValue(residentData.suffix, '') : ''}`
        .trim()
        .replace(/\s+/g, ' ');

    const birthDate = safeValue(residentData.date_of_birth, '________________');

    // Ensure the elements exist before updating
    const nameElement = document.getElementById("residentName");
    const birthDateElement = document.getElementById("birthDate");

    if (nameElement) {
        nameElement.innerText = fullName;
    } else {
        console.error("Element #residentName not found!");
    }

    if (birthDateElement) {
        birthDateElement.innerText = birthDate;
    } else {
        console.error("Element #birthDate not found!");
    }
}
