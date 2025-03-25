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

// Reference to the database
const database = firebase.database();

//Fetch Personnel


    // Reference to the BrgyHealth node in the database
    const dbRef = firebase.database().ref('Utility');

    // Fetch data and populate the table
        dbRef.on('value', (snapshot) => {
        const residentsList = document.getElementById('residents-list');
        residentsList.innerHTML = ''; // Clear the table body

            snapshot.forEach((childSnapshot) => {
                const resident = childSnapshot.val();
                const row = document.createElement('tr');

                    row.innerHTML = `
                        <td class="py-3 px-4 text-sm text-gray-700">${resident.first_name || ''}</td>
                        <td class="py-3 px-4 text-sm text-gray-700">${resident.last_name || ''}</td>
                        <td class="py-2 px-4 text-sm text-gray-500">
                            <div class="relative inline-block text-left">
                                <button class="dropdown-button inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-100 focus:ring-2 focus:ring-green-500 focus:outline-none" onclick="toggleDropdown(this)">
                                    Actions
                                    <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.293 9.293a1 1 0 011.414 0L10 12.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <div class="dropdown-menu origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10 hidden">
                                    <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                        <a href="id-layout/utility-id.php?id=${childSnapshot.key}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-100" role="menuitem">Print ID</a>
                                        <button onclick="deleteResident('${childSnapshot.key}')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-red-100" role="menuitem">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </td>
                    `;

                    // Close dropdowns when clicking outside
                    document.addEventListener('click', (event) => {
                        const dropdowns = document.querySelectorAll('.dropdown-menu');
                        dropdowns.forEach((dropdown) => {
                            if (!dropdown.contains(event.target) && !dropdown.previousElementSibling.contains(event.target)) {
                                dropdown.classList.add('hidden');
                            }
                        });
                    });
                    residentsList.appendChild(row);
                    });
                });

          // Function to delete a resident from the database
          function deleteResident(residentId) {
            if (confirm('Are you sure you want to delete this resident?')) {
                firebase.database().ref(`Utility/${residentId}`).remove()
                    .then(() => {
                        alert('Resident deleted successfully.');
                    })
                    .catch((error) => {
                        console.error('Error deleting resident:', error);
                        alert('Failed to delete resident. Please try again.');
                    });
            }
        }

// Fetch data from the Realtime Database
const residentListTable = document.getElementById('resident-list-table');
function fetchResidents() {
    // Fetch data from BrgyHealth to compare
    database.ref('Utility').once('value', (brgyHealthSnapshot) => {
        const brgyHealthIds = new Set();
        brgyHealthSnapshot.forEach((childSnapshot) => {
            brgyHealthIds.add(childSnapshot.key);
        });

        // Fetch data from Residents
        database.ref('Residents').once('value', (snapshot) => {
            residentListTable.innerHTML = ''; // Clear the table
            snapshot.forEach((childSnapshot) => {
                const residentId = childSnapshot.key;

                // Only display residents not already in BrgyHealth
                if (!brgyHealthIds.has(residentId.trim())) {
                    const resident = childSnapshot.val();
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <input type="checkbox" value="${residentId.trim()}">
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-left">
                            ${resident.first_name || ''} ${resident.last_name || ''}
                        </td>
                    `;
                    residentListTable.appendChild(row);
                }
            });
        });
    });
}

// Save selected residents to BrgyHealth Parent
function saveSelectedResidents() {
    const checkboxes = residentListTable.querySelectorAll('input[type="checkbox"]:checked');
    checkboxes.forEach((checkbox) => {
        const residentId = checkbox.value;
        database.ref(`Residents/${residentId}`).once('value', (snapshot) => {
            const residentData = snapshot.val();
            if (residentData) {
                database.ref(`Utility/${residentId}`).set(residentData);
            }
        });
    });
}

// Call fetchResidents when the modal is opened
document.getElementById('add-resident').addEventListener('click', () => {
    document.getElementById('add-resident-modal').classList.remove('hidden');
    fetchResidents();
});

// Close the modal
document.getElementById('cancel-modal').addEventListener('click', () => {
    document.getElementById('add-resident-modal').classList.add('hidden');
});

// Save button functionality
document.getElementById('save-residents').addEventListener('click', () => {
    saveSelectedResidents();
    document.getElementById('add-resident-modal').classList.add('hidden');
});
   
   
   // modal trigger
   const addResidentButton = document.getElementById('add-resident');
   const modal = document.getElementById('add-resident-modal');
   const cancelModalButton = document.getElementById('cancel-modal');

   addResidentButton.addEventListener('click', () => {
       modal.classList.remove('hidden');
   });

   cancelModalButton.addEventListener('click', () => {
       modal.classList.add('hidden');
   });

   // Optional: Close modal when clicking outside of it
   window.addEventListener('click', (e) => {
       if (e.target === modal) {
           modal.classList.add('hidden');
       }
   });

   // Function to toggle dropdown visibility
   function toggleDropdown(button) {
       const dropdownMenu = button.nextElementSibling;
       dropdownMenu.classList.toggle('hidden');
   }