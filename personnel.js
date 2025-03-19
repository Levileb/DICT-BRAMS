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

// Fetch data from the Realtime Database
const residentListTable = document.getElementById('resident-list-table');

function fetchResidents() {
    database.ref('Residents').once('value', (snapshot) => {
        residentListTable.innerHTML = ''; // Clear the table
        snapshot.forEach((childSnapshot) => {
            const resident = childSnapshot.val();
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="border border-gray-300 px-4 py-2 text-center">
                    <input type="checkbox" value="${childSnapshot.key}">
                </td>
                <td class="border border-gray-300 px-4 py-2 text-left">
                    ${resident.first_name} ${resident.last_name}
                </td>
            `;
            residentListTable.appendChild(row);
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