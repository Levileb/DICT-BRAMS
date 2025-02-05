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
firebase.initializeApp(firebaseConfig);
const database = firebase.database();

// Function to fetch resident details
function fetchResidentDetails(residentId) {
    const residentRef = database.ref('Residents/' + residentId);
    residentRef.once('value', function(snapshot) {
        if (snapshot.exists()) {
            const residentData = snapshot.val();
            populateResidentDetails(residentData);
        } else {
            console.error("Resident not found!");
        }
    });
}

function fetchOfficials() {
    const officialsRef = firebase.database().ref('BrgyOfficials');

    officialsRef.once('value', (snapshot) => {
      const officials = snapshot.val();
      const officialsContainer = document.getElementById('officers');

      officialsContainer.innerHTML = ""; // Clear previous data

      for (const key in officials) {
        if (officials.hasOwnProperty(key)) {
          const official = officials[key];

          // Create official entry
          const officialElement = document.createElement("div");
          const fullName = `HON. ${official.first_name.toUpperCase()} ${official.middle_initial.toUpperCase()}. ${official.last_name.toUpperCase()}`;
          const position = official.position;
          
          const positionWords = position.split(' ');
          let firstLine = positionWords.slice(0, 4).join(' ');
          let secondLine = positionWords.slice(4, 9).join(' ');
          let thirdLine = positionWords.slice(9).join(' ');

          if (positionWords.length > 9) {
            officialElement.innerHTML = `
              <strong>${fullName}</strong><br>
              ${firstLine}<br>
              ${secondLine}<br>
              ${thirdLine}<br><br>
            `;
          } else {
            officialElement.innerHTML = `
              <strong>${fullName}</strong><br>
              ${firstLine}<br>
              ${secondLine}<br><br>
            `;
          }

          // Append to container
          officialsContainer.appendChild(officialElement);
        }
      }
    });
  }

  // Call function to fetch data
  fetchOfficials();
function fetchPunongBarangayName() {
    const officialsRef = firebase.database().ref('BrgyOfficials');

    officialsRef.orderByChild('position').equalTo('Punong Barangay').once('value', (snapshot) => {
        if (snapshot.exists()) {
            const punongBarangay = snapshot.val();
            const punongBarangayNameElement = document.getElementById('punongBarangayName');

            for (const key in punongBarangay) {
                if (punongBarangay.hasOwnProperty(key)) {
                    const official = punongBarangay[key];
                    const fullName = ` ${official.first_name.toUpperCase()} ${official.middle_initial.toUpperCase()}. ${official.last_name.toUpperCase()}`;

                    punongBarangayNameElement.innerText = fullName;
                }
            }
        } else {
            console.error("Punong Barangay not found!");
        }
    });
}

// Call function to fetch Punong Barangay name
fetchPunongBarangayName();

function populateResidentDetails(residentData) {
  
    // Helper function to check if a value is undefined, null, or empty and replace it with a placeholder
    const safeValue = (value, placeholder) => value && value.trim() ? value : placeholder;

    // Populate the residentName field with names displayed closely together
    const fullName = `${safeValue(residentData.first_name, '')} ${safeValue(residentData.middle_name, '')} ${safeValue(residentData.last_name, '')} ${residentData.suffix === 'Select Suffix' ? '' : safeValue(residentData.suffix, '')}`.trim().replace(/\s+/g, ' ');

    document.getElementById('residentName').innerText = fullName;

    document.getElementById('age').innerText = 
        calculateAge(residentData.date_of_birth) || '____';

    document.getElementById('civilStatus').innerText = 
        safeValue(residentData.civil_status, '________________');

    document.getElementById('gender').innerText = 
        safeValue(residentData.gender, '______');

    document.getElementById('birthDate').innerText = 
        safeValue(residentData.date_of_birth, '________________');

        document.getElementById('birthDate').innerText = 
            formatDate(residentData.date_of_birth) || '________________';

    document.getElementById('birthPlace').innerText = 
        safeValue(residentData.place_of_birth, '________________');

    // Additional document type-specific logic (if any)
    if (documentType === 'clearance') {
        console.log("Processing Barangay Clearance");
    } else if (documentType === 'residency') {
        console.log("Processing Certificate of Residency");
    } else if (documentType === 'indigency') {
        console.log("Processing Certificate of Indigency");
    } else if (documentType === 'certification') {
        console.log("Processing Certification");
    } else {
        console.error("Unknown document type!");
    }
}


function formatDate(dateString) {
    if (!dateString) return '________________';
    const date = new Date(dateString);
    const year = date.getFullYear();
    const month = date.toLocaleString('default', { month: 'long' });
    const day = date.getDate();
    return `${month} ${day}, ${year}`;
}

// Function to calculate age from date of birth
function calculateAge(birthDate) {
    if (!birthDate) return null;
    const birth = new Date(birthDate);
    const today = new Date();
    let age = today.getFullYear() - birth.getFullYear();
    const monthDifference = today.getMonth() - birth.getMonth();
    if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birth.getDate())) {
        age--;
    }
    return age;
}

// Fetch resident details when the page loads
window.onload = function() {
    const residentId = document.getElementById('residentId').value; // Resident ID from PHP
    if (residentId && documentType) {
        fetchResidentDetails(residentId);
    } else {
        console.error("Resident ID or Document Type is missing.");
    }
};
