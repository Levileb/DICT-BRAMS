<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Household Form</title>
    <link rel="icon" type="image/png" href="Includes/background/bg.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>

<style>
body::-webkit-scrollbar {
    display: none;
}

.wrapper {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    margin-bottom: 50px;
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Utility function to populate dropdowns
    function populateDropdown(dropdownId, options) {
        const dropdown = document.getElementById(dropdownId);
        options.forEach(function(optionText) {
            const option = document.createElement('option');
            option.value = optionText;
            option.textContent = optionText;
            dropdown.appendChild(option);
        });
    }

    // Populate the Relationship to Household Head dropdown
    populateDropdown('suffix', [
        "Jr.", "Sr.", "II", "III", "IV", "V", "none"
    ]);

    // Populate the Type of Water Source dropdown
    populateDropdown('water_source', [
        "Bottled Water", "Deep Well", "River", "Spring", "Water District"
    ]);

    // Populate the Type of Toilet Facility dropdown
    populateDropdown('toilet_facility', [
        "Water-sealed", "Pit Latrine", "Open Pit", "None"
    ]);

    // Populate the Type of Waste Management dropdown
    populateDropdown('waste_management', [
        "Composting", "Recycling", "Burning", "None"
    ]);

    // Renter Dropdown and Conditional No. of Months Input Handling
    const renterDropdown = document.getElementById('renter');
    const renterMonthsInput = document.getElementById('renter_months');

    // Disable renter months input by default
    renterMonthsInput.disabled = true;

    // Add event listener to enable/disable months input based on renter selection
    renterDropdown.addEventListener('change', function() {
        if (renterDropdown.value === 'Renter_Yes') {
            renterMonthsInput.disabled = false;
        } else {
            renterMonthsInput.disabled = true;
            renterMonthsInput.value = ''; // Clear the value when disabled
        }
    });
});
</script>

<body class="bg-gray-100">
    <?php include 'Includes/header.php'; ?>
    <?php include 'Includes/navbar.php'; ?>

    <div class="wrapper">

        <div class="max-w-4xl mx-auto bg-white p-8 shadow-md" style="margin-top: 100px;">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold">HARMONIZED FAMILY/HOUSEHOLD PROFILE</h2>
                <p class="text-green-600">Please provide the information needed</p>
            </div>

            <!-- Household Form -->
            <form id="householdForm">
                <div class="mb-6">
                    <h3 class="text-lg font-bold mb-2">Name of Respondent *</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name *</label>
                            <input type="text" id="first_name" name="first_name"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                        </div>
                        <div>
                            <label for="middle_name" class="block text-sm font-medium text-gray-700">Middle Name</label>
                            <input type="text" id="middle_name" name="middle_name"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name *</label>
                            <input type="text" id="last_name" name="last_name"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                        </div>
                        <div>
                            <label for="suffix" class="block text-sm font-medium text-gray-700">Suffix</label>
                            <select id="suffix" name="suffix"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option>Select Suffix</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-bold mb-2">Household Information *</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="household_number" class="block text-sm font-medium text-gray-700">Household Number
                                *</label>
                            <input type="number" id="household_number" name="household_number"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                        </div>
                        <div>
                            <label for="renter" class="block text-sm font-medium text-gray-700">Renter (Y/N) *</label>
                            <select id="renter" name="renter"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                                <option value="">Select</option>
                                <option value="Renter_Yes">Yes</option>
                                <option value="Renter_No">No</option>
                            </select>
                        </div>
                        <div id="renter_months_container" class="hidden">
                            <label for="renter_months" class="block text-sm font-medium text-gray-700">If Yes, No. of
                                Months</label>
                            <input type="number" id="renter_months" name="renter_months"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-bold mb-2">Social Economic Status *</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <input type="radio" id="nhts_4ps" name="nhts_status" value="nhts_4ps">
                            <label for="nhts_4ps" class="text-sm font-medium text-gray-700">NHTS 4ps</label><br>
                            <input type="radio" id="nhts_non4ps" name="nhts_status" value="nhts_non4ps">
                            <label for="nhts_non4ps" class="text-sm font-medium text-gray-700">NHTS Non-4ps</label><br>
                            <input type="radio" id="non_nhts" name="nhts_status" value="non_nhts">
                            <label for="non_nhts" class="text-sm font-medium text-gray-700">Non-NHTS</label><br>
                        </div>
                        <div>
                            <input type="radio" id="ip_household" name="nhts_status" value="ip_household">
                            <label for="ip_household" class="text-sm font-medium text-gray-700">IP Household</label><br>
                            <input type="radio" id="non_ip_household" name="nhts_status" value="non_ip_household">
                            <label for="non_ip_household" class="text-sm font-medium text-gray-700">Non-IP
                                Household</label><br>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="tribe" class="block text-sm font-medium text-gray-700">If IP Household, indicate
                                TRIBE:</label>
                            <input type="text" id="tribe" name="tribe"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="water_source" class="block text-sm font-medium text-gray-700">Type of Water Source
                                *</label>
                            <select id="water_source" name="water_source"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                                <option value="">Select Water Source</option>
                            </select>
                        </div>
                        <div>
                            <label for="toilet_facility" class="block text-sm font-medium text-gray-700">Type of Toilet
                                Facility *</label>
                            <select id="toilet_facility" name="toilet_facility"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                                <option value="">Select Toilet Facility</option>
                            </select>
                        </div>
                        <div>
                            <label for="waste_management" class="block text-sm font-medium text-gray-700">Type of Waste
                                Management *</label>
                            <select id="waste_management" name="waste_management"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                                <option value="">Select Waste Management</option>
                            </select>
                        </div>
                        <div>
                            <label for="blind_drainage" class="block text-sm font-medium text-gray-700">With Blind Drainage
                                *</label>
                            <select id="blind_drainage" name="blind_drainage"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                                <option value="">Select Option</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                </div>



                <!-- Household Members Section (Updated) -->
                <div class="max-w-6xl mx-auto bg-white p-8 shadow-lg rounded-lg mt-8">
                    <div class="flex flex-col sm:flex-row justify-between items-center mb-4">
                        <h2 class="text-3xl font-semibold text-gray-700">Household Members</h2>
                        <div class="flex space-x-4 mt-4 sm:mt-0">
                            <input type="text" id="search" placeholder="Search..."
                                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 w-80">
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table
                            class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200 shadow-sm rounded-lg">
                            <thead class="bg-green-100">
                                <tr>
                                    <th class="py-3 px-4 bg-gray-200 text-left text-sm font-medium text-gray-500"></th>
                                    <!-- Checkbox Header -->
                                    <th class="py-3 px-4 bg-gray-200 text-left text-sm font-medium text-gray-700">First Name
                                    </th>
                                    <th class="py-3 px-4 bg-gray-200 text-left text-sm font-medium text-gray-700">Middle
                                        Name</th>
                                    <th class="py-3 px-4 bg-gray-200 text-left text-sm font-medium text-gray-700">Last Name
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="residents-list" class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td colspan="4" class="py-4 text-center text-gray-500">Loading...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="text-center mt-6">
                    <button type="submit"
                        class="bg-green-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-green-700">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Pop-up Message -->
    <div id="successPopup" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg relative">
            <p class="text-lg font-semibold">Registration successful!</p>
            <p class="mt-2 text-gray-600">Thank you for registering.</p>
        </div>
    </div>

    <?php include 'Includes/footer.php'; ?>

    <!-- Firebase SDKs in compat mode -->
    <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-app-compat.js" defer></script>
    <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-database-compat.js" defer></script>

    <!-- Include the household form submission script -->
    <!-- <script src="Includes/Javascript/household_form.js" defer></script> -->
    <script src="hosuehold-firebase.js" defer></script>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.getElementById('search');
        const tableBody = document.getElementById('residents-list');

        // Firebase reference for Residents and Selected Members
        const database = firebase.database();
        const residentsRef = database.ref('Residents');
        const selectedMembersRef = database.ref(
            'SelectedMembers'); // Add a new node for storing selected members

        // Automatically load residents when the page loads
        loadResidents();

        function loadResidents() {
            residentsRef.once('value')
                .then(snapshot => {
                    const residents = snapshot.val();
                    selectedMembersRef.once('value')
                        .then(selectedSnapshot => {
                            const selectedMembers = selectedSnapshot.val() || {};
                            tableBody.innerHTML = ''; // Clear any existing data

                            for (let key in residents) {
                                if (!selectedMembers[
                                        key]) { // Only display residents not in selected members
                                    const resident = residents[key];
                                    const row = document.createElement('tr');
                                    row.dataset.id = key; // Store the unique ID in a data attribute

                                    row.innerHTML = `
                                    <td class="py-2 px-4 text-sm font-medium text-gray-900">
                                        <input type="checkbox" class="checkbox-input" data-id="${key}">
                                    </td>
                                    <td class="py-2 px-4 text-sm text-gray-500">${resident.first_name || ''}</td>
                                    <td class="py-2 px-4 text-sm text-gray-500">${resident.middle_name || ''}</td>
                                    <td class="py-2 px-4 text-sm text-gray-500">${resident.last_name || ''}</td>
                                `;

                                    tableBody.appendChild(row);
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Error loading selected members:', error);
                        });
                })
                .catch(error => {
                    console.error('Error loading residents:', error);
                });
        }

        searchInput.addEventListener('input', () => {
            const searchTerm = searchInput.value.toLowerCase();
            const tableRows = tableBody.querySelectorAll('tr');

            tableRows.forEach(row => {
                const cells = row.querySelectorAll('td');
                const firstName = cells[1]?.textContent.toLowerCase() || '';
                const middleName = cells[2]?.textContent.toLowerCase() || '';
                const lastName = cells[3]?.textContent.toLowerCase() || '';
                if (firstName.includes(searchTerm) || middleName.includes(searchTerm) ||
                    lastName.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Selection handling
        tableBody.addEventListener('change', event => {
            if (event.target.classList.contains('checkbox-input')) {
                const checkbox = event.target;
                const uniqueId = checkbox.dataset.id;

                if (checkbox.checked) {
                    // Add selected member to Firebase
                    residentsRef.child(uniqueId).once('value')
                        .then(snapshot => {
                            const selectedMember = snapshot.val();
                            if (selectedMember) {
                                selectedMembersRef.child(uniqueId).set(selectedMember)
                                    .then(() => {
                                        console.log('Member added successfully:',
                                            selectedMember);
                                    })
                                    .catch(error => {
                                        console.error('Error adding member:', error);
                                    });
                            }
                        });
                } else {
                    // Remove deselected member from Firebase
                    selectedMembersRef.child(uniqueId).remove()
                        .then(() => {
                            console.log('Member removed successfully:', uniqueId);
                        })
                        .catch(error => {
                            console.error('Error removing member:', error);
                        });
                }
            }
        });

        // Show or hide "No. of Months" field based on selected Renter option
        const renterSelect = document.getElementById('renter');
        const renterMonthsContainer = document.getElementById('renter_months_container');

        renterSelect.addEventListener('change', () => {
            const selectedValue = renterSelect.value;

            // Show "No. of Months" input if "Yes" is selected
            if (selectedValue === 'Renter_Yes') {
                renterMonthsContainer.classList.remove('hidden');
            } else {
                renterMonthsContainer.classList.add('hidden');
            }
        });
    });
    </script>


</body>

</html>