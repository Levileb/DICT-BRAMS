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

    // Reference to the 'Households' node in your Realtime Database
        const householdsRef = firebase.database().ref('Households');
        householdsRef.on('value', (snapshot) => {
    const residentsList = document.getElementById('residents-list');
    residentsList.innerHTML = ''; // Clear existing data

    snapshot.forEach((childSnapshot) => {
        const household = childSnapshot.val();

        // Create a table row
        const row = document.createElement('tr');
        row.classList.add('bg-white', 'border-b', 'hover:bg-gray-50', 'cursor-pointer');

        // Add household number
        const householdNumberCell = document.createElement('td');
        householdNumberCell.classList.add('py-3', 'px-4', 'text-sm', 'text-gray-600');
        householdNumberCell.textContent = household.household_number;
        row.appendChild(householdNumberCell);

        // Add last name
        const lastNameCell = document.createElement('td');
        lastNameCell.classList.add('py-3', 'px-4', 'text-sm', 'text-gray-600');
        lastNameCell.textContent = household.last_name;
        row.appendChild(lastNameCell);

        // Add first name
        const firstNameCell = document.createElement('td');
        firstNameCell.classList.add('py-3', 'px-4', 'text-sm', 'text-gray-600');
        firstNameCell.textContent = household.first_name;
        row.appendChild(firstNameCell);

        // Add event listener to show modal on click
        row.addEventListener('click', () => {
            // Populate resident details
            document.getElementById('modal-registration-date').textContent = household.registration_date || 'N/A';
            document.getElementById('modal-household-number').textContent = household.household_number || 'N/A';
            document.getElementById('modal-first-name').textContent = household.first_name || 'N/A';
            document.getElementById('modal-middle-name').textContent = household.middle_name || 'N/A';
            document.getElementById('modal-last-name').textContent = household.last_name || 'N/A';
            document.getElementById('modal-nhts-status').textContent = household.nhts_status || 'N/A';

            // Populate the table with selected members
            const membersList = document.getElementById('modal-members-list');
            membersList.innerHTML = ''; // Clear previous data

            if (household.selected_members) {
                household.selected_members.forEach((memberId) => {
                    // Create a new row for each member
                    const memberRow = document.createElement('tr');
                    memberRow.classList.add('bg-white', 'border-b', 'hover:bg-gray-50');

                    const memberIdCell = document.createElement('td');
                    memberIdCell.classList.add('py-2', 'px-4', 'text-sm', 'text-gray-600');
                    memberIdCell.textContent = memberId; // Display the member ID
                    memberRow.appendChild(memberIdCell);

                    const memberNameCell = document.createElement('td');
                    memberNameCell.classList.add('py-2', 'px-4', 'text-sm', 'text-gray-600');
                    memberNameCell.textContent = 'Fetching Details...'; // Placeholder

                    // Fetch resident details using member ID
                    firebase.database().ref(`Residents/${memberId}`).once('value', (memberSnapshot) => {
                        const memberData = memberSnapshot.val();
                        if (memberData) {
                            memberNameCell.textContent = `${memberData.first_name || ''} ${memberData.last_name || ''}`;
                        } else {
                            memberNameCell.textContent = 'No details found';
                        }
                    });

                    memberRow.appendChild(memberNameCell);


                    membersList.appendChild(memberRow);
                });
            } else {
                const noMembersRow = document.createElement('tr');
                noMembersRow.innerHTML = `<td colspan="5" class="py-2 px-4 text-sm text-gray-600 text-center">No members found</td>`;
                membersList.appendChild(noMembersRow);
            }

            // Show the modal
            document.getElementById('resident-modal').classList.remove('hidden');
        });

        // Append the row to the table body
        residentsList.appendChild(row);
    });
});

// Close modal
document.getElementById('close-modal').addEventListener('click', () => {
    document.getElementById('resident-modal').classList.add('hidden');
});

    // Export to Excel functionality
    document.getElementById('export-button').addEventListener('click', () => {
        const table = document.querySelector('table');
        const workbook = XLSX.utils.table_to_book(table, { sheet: "Households" });
        XLSX.writeFile(workbook, 'households.xlsx');
    });