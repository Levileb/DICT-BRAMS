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

                // Ensure the hidden input exists before setting the household ID
                let householdIdInput = document.getElementById('modal-household-id');
                if (!householdIdInput) {
                    householdIdInput = document.createElement('input');
                    householdIdInput.type = 'hidden';
                    householdIdInput.id = 'modal-household-id';
                    document.body.appendChild(householdIdInput);
                }
                householdIdInput.value = childSnapshot.key;

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

                        // Add delete button
                        const deleteButtonCell = document.createElement('td');
                        deleteButtonCell.classList.add('py-2', 'px-4', 'text-sm', 'text-gray-600');
                        const deleteButton = document.createElement('button');
                        deleteButton.textContent = 'Delete';
                        deleteButton.classList.add('bg-red-500', 'text-white', 'py-1', 'px-2', 'rounded');
                        deleteButton.addEventListener('click', (e) => {
                            e.stopPropagation(); // Prevent triggering the row click event
                            if (confirm('Are you sure you want to delete this member?')) {
                                // Remove member from the household's selected_members array
                                const updatedMembers = household.selected_members.filter(id => id !== memberId);
                                firebase.database().ref(`Households/${childSnapshot.key}`).update({ selected_members: updatedMembers }).then(() => {
                                    // Delete the member data from the Residents node
                                    firebase.database().ref(`SelectedMembers/${memberId}`).remove().then(() => {
                                        // Refresh the modal content
                                        row.click();
                                    });
                                });
                            }
                        });
                        deleteButtonCell.appendChild(deleteButton);
                        memberRow.appendChild(deleteButtonCell);

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

    document.getElementById("add-modal").addEventListener("click", function () {
        document.getElementById("modal").classList.remove("hidden");
    });

    document.getElementById("closed-modal").addEventListener("click", function () {
        document.getElementById("modal").classList.add("hidden");
    });

    window.addEventListener("click", function (event) {
        let modal = document.getElementById("modal");
        if (event.target === modal) {
            modal.classList.add("hidden");
        }
    });

    function fetchResidents() {
        const residentsRef = firebase.database().ref('Residents');
        const selectedMembersRef = firebase.database().ref('SelectedMembers');
        const residentsList = document.getElementById("modal-residents-list");
        const householdId = document.getElementById("modal-household-id").value;
    
        // Fetch selected members globally
        selectedMembersRef.once('value', (selectedSnapshot) => {
            const globalSelectedMembers = selectedSnapshot.exists() ? Object.keys(selectedSnapshot.val()) : [];
    
            // Fetch selected members of the current household
            firebase.database().ref(`Households/${householdId}`).once('value', (householdSnapshot) => {
                const household = householdSnapshot.val();
                const householdSelectedMembers = household?.selected_members || [];
    
                residentsRef.once('value', (residentsSnapshot) => {
                    residentsList.innerHTML = ""; // Clear existing data
    
                    if (residentsSnapshot.exists()) {
                        residentsSnapshot.forEach((childSnapshot) => {
                            const residentID = childSnapshot.key;
                            const resident = childSnapshot.val();
    
                            // Check if the resident ID is in either SelectedMembers or Household's selected_members
                            if (!globalSelectedMembers.includes(residentID) && !householdSelectedMembers.includes(residentID)) {
                                const row = document.createElement("tr");
                                row.innerHTML = `
                                    <td class="py-2 px-4 text-sm text-gray-700">
                                        <input type="checkbox" class="resident-checkbox checkbox-input" data-resident-id="${residentID}">
                                    </td>
                                    <td class="py-2 px-4 text-sm text-gray-700">${residentID}</td>
                                    <td class="py-2 px-4 text-sm text-gray-700">${resident.first_name || ''} ${resident.last_name || ''}</td>
                                `;
                                residentsList.appendChild(row);
                            }
                        });
                    } else {
                        residentsList.innerHTML = "<tr><td colspan='3' class='py-2 px-4 text-gray-500'>No residents found.</td></tr>";
                    }
                });
            });
        });
    }
    
    document.getElementById("add-modal").addEventListener("click", fetchResidents);

    document.getElementById("add-member").addEventListener("click", () => {
        const selectedMembers = Array.from(document.querySelectorAll('.checkbox-input'))
            .filter(checkbox => checkbox.checked) // Only include checked checkboxes
            .map(checkbox => checkbox.dataset.residentId); // Get the `data-resident-id` attribute of the selected checkboxes
        const householdId = document.getElementById("modal-household-id").value; // Assuming you have a hidden input to store the household ID

        if (householdId && selectedMembers.length > 0) {
            const householdRef = firebase.database().ref(`Households/${householdId}`);
            householdRef.once('value', (snapshot) => {
                const household = snapshot.val();
                const updatedMembers = household.selected_members ? household.selected_members.concat(selectedMembers) : selectedMembers;
                householdRef.update({ selected_members: updatedMembers }).then(() => {
                    // Add member data to SelectedMembers node
                    selectedMembers.forEach(memberId => {
                        firebase.database().ref(`SelectedMembers/${memberId}`).set(true);
                    });
                    alert("Members added successfully!");
                    document.getElementById("modal").classList.add("hidden");
                });
            });
        } else {
            alert("No members selected or household ID missing.");
        }
    });
    // Listen for changes in the Residents node
    const residentsRef = firebase.database().ref('Residents');
    residentsRef.on('child_changed', fetchResidents);
    residentsRef.on('child_removed', fetchResidents);
    residentsRef.on('child_added', fetchResidents);
