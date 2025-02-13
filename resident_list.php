<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Residents</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="Includes/background/bg.png">
    <link href="Includes/resident_list.css" rel="stylesheet">
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script src="firebase-resident.js"></script>
    <script src="archive_resident.js"></script> <!-- Include the archive function -->

    <style>
    .container-width {
        max-width: 90%;
    }

    .container-padding {
        padding: 3rem;
    }

    .large-text {
        font-size: 2.25rem;
        font-weight: 700;
    }

    .search-bar-width {
        width: 20rem;
    }


    body::-webkit-scrollbar {
        display: none;
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.getElementById('search');
        const tableBody = document.getElementById('residents-list');
        const exportButton = document.getElementById('export-button');
        let openDropdown = null; // Track the currently open dropdown

        loadResidents();

        function loadResidents() {
            const database = firebase.database().ref('Residents');
            const residentsData = [];

            database.once('value').then(snapshot => {
                const residents = snapshot.val();
                tableBody.innerHTML = '';

                // Check if no residents exist
                if (!residents || Object.keys(residents).length === 0) {
                    tableBody.innerHTML = `
                            <tr>
                                <td colspan="4" class="py-4 text-center text-gray-500">There is no Resident Been Register</td>
                            </tr>
                        `;
                } else {
                    // Populate table with residents data
                    for (let key in residents) {
                        const resident = residents[key];
                        const row = document.createElement('tr');
                        row.innerHTML = `
                                <td class="py-2 px-4 text-sm text-gray-500">${resident.first_name || ''}</td>
                                <td class="py-2 px-4 text-sm text-gray-500">${resident.middle_name || ''}</td>
                                <td class="py-2 px-4 text-sm text-gray-500">${resident.last_name || ''}</td>
                                <td class="py-2 px-4 text-sm text-gray-500">
                                    <div class="relative inline-block text-left">
                                        <button class="dropdown-button inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-100 focus:ring-2 focus:ring-green-500 focus:outline-none">
                                            Actions
                                            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M5.293 9.293a1 1 0 011.414 0L10 12.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                        <div class="dropdown-menu origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10 hidden">
                                            <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                                <a href="print_template.php?id=${key}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-100" role="menuitem">Print</a>
                                                <a href="edit_form.php?id=${key}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-100" role="menuitem">Edit</a>
                                                <button onclick="archiveResident('${key}')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-red-100" role="menuitem">Archive</button>
                                                <button onclick="showInfoPopup('${key}')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-yellow-100" role="menuitem">Info</button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            `;

                        tableBody.appendChild(row);

                        residentsData.push({
                            first_name: resident.first_name || '',
                            middle_name: resident.middle_name || '',
                            last_name: resident.last_name || '',
                            suffix: resident.suffix || '', // Added suffix here
                            appellation: resident.appellation || '',
                            place_of_birth: resident.place_of_birth || '',
                            date_of_birth: resident.date_of_birth || '',
                            gender: resident.gender || '',
                            nationality: resident.nationality || '',
                            civil_status: resident.civil_status || '',
                            philhealth_id: resident.philhealth_id || '',
                            philhealth_membership: resident.philhealth_membership || '',
                            wra: resident.wra || '',
                            educational_attainment: resident.educational_attainment || '',
                            employment_status: resident.employment_status || '',
                            remark_NS: resident.remark_NS || '',
                            resident_since: resident.resident_since || '',
                            contact_number: resident.contact_number || '',
                            emergency_name: resident.emergency_name || '',
                            emergency_phone: resident.emergency_phone || '',
                            relationship: resident.relationship || ''
                        });
                    }

                    initializeDropdowns();

                    exportButton.addEventListener('click', () => {
                        exportToExcel(residentsData);
                    });
                }
            }).catch(error => {
                console.error('Error loading residents:', error);
            });
        }

        function initializeDropdowns() {
            document.querySelectorAll('.dropdown-button').forEach(button => {
                button.addEventListener('click', event => {
                    event.stopPropagation(); // Prevent event from bubbling up

                    const dropdown = button.nextElementSibling;

                    // Close any open dropdown
                    if (openDropdown && openDropdown !== dropdown) {
                        openDropdown.classList.add('hidden');
                    }

                    // Toggle current dropdown
                    dropdown.classList.toggle('hidden');
                    openDropdown = dropdown.classList.contains('hidden') ? null : dropdown;
                });
            });

            window.addEventListener('click', () => {
                if (openDropdown) {
                    openDropdown.classList.add('hidden');
                    openDropdown = null;
                }
            });
        }

        searchInput.addEventListener('input', () => {
            const searchTerm = searchInput.value.toLowerCase();
            const tableRows = tableBody.querySelectorAll('tr');

            tableRows.forEach(row => {
                const cells = row.querySelectorAll('td');
                const firstName = cells[0].textContent.toLowerCase();
                const middleName = cells[1].textContent.toLowerCase();
                const lastName = cells[2].textContent.toLowerCase();
                if (firstName.includes(searchTerm) || middleName.includes(searchTerm) ||
                    lastName.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        function exportToExcel(residentsData) {
            const date = new Date();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            const year = date.getFullYear();

            const fileName = `residents_data_${month}-${day}-${year}.xlsx`;

            const worksheet = XLSX.utils.json_to_sheet(residentsData);
            const workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, worksheet, "Residents");

            XLSX.writeFile(workbook, fileName);
        }
    });

    function showInfoPopup(residentId) {
        const database = firebase.database().ref('Residents/' + residentId);
        database.once('value').then(snapshot => {
            const resident = snapshot.val();

            // Create the popup container
            const popup = document.createElement('div');
            popup.classList.add('fixed', 'inset-0', 'bg-gray-800', 'bg-opacity-50', 'flex', 'items-center',
                'justify-center', 'z-50');

            // Popup content
            const content = document.createElement('div');
            content.classList.add('bg-white', 'p-6', 'rounded-lg', 'w-1/3');
            content.innerHTML = `
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold">Information of the Resident</h3>
                <button 
                    onclick="closePopup()" 
                    style="
                        width: 2rem; 
                        height: 2rem; 
                        border-radius: 50%; 
                        background-color: #f87171; 
                        color: white; 
                        border: none; 
                        font-size: 1.25rem; 
                        display: flex; 
                        align-items: center; 
                        justify-content: center; 
                        cursor: pointer;
                    " 
                    class="hover:bg-red-600 focus:outline-none">
                    &times;
                </button>
            </div>
            <p><strong>Name:</strong> ${resident.first_name} ${resident.middle_name} ${resident.last_name} ${resident.suffix || ''}</p>
            <p><strong>Appellation:</strong> ${resident.appellation || ''}</p>
            <p><strong>Place of Birth:</strong> ${resident.place_of_birth || ''}</p>
            <p><strong>Date of Birth:</strong> ${resident.date_of_birth || ''}</p>
            <p><strong>Gender:</strong> ${resident.gender || ''}</p>
            <p><strong>Nationality:</strong> ${resident.nationality || ''}</p>
            <p><strong>Civil Status:</strong> ${resident.civil_status || ''}</p>
            <p><strong>PhilHealth ID:</strong> ${resident.philhealth_id || ''}</p>
            <p><strong>PhilHealth Membership:</strong> ${resident.philhealth_membership || ''}</p>
            <p><strong>WRA:</strong> ${resident.wra || ''}</p>
            <p><strong>Educational Attainment:</strong> ${resident.educational_attainment || ''}</p>
            <p><strong>Employment Status:</strong> ${resident.employment_status || ''}</p>
            <p><strong>Remark (NS):</strong> ${resident.remark_NS || ''}</p>
            <p><strong>Resident Since:</strong> ${resident.resident_since || ''}</p>
            <p><strong>Contact Number:</strong> ${resident.contact_number || ''}</p>
            <p><strong>Emergency Contact:</strong> ${resident.emergency_name || ''} - ${resident.emergency_phone || ''}</p>
            <p><strong>Relationship:</strong> ${resident.relationship || ''}</p>
        `;

            // Append popup content to popup
            popup.appendChild(content);
            document.body.appendChild(popup);
        }).catch(error => {
            console.error('Error fetching resident info:', error);
        });
    }

    // Close popup function
    function closePopup() {
        const popup = document.querySelector('.fixed');
        if (popup) {
            popup.remove();
        }
    }
    </script>

</head>

<body class="bg-gray-100">
    <?php include 'Includes/header.php'; ?>
    <?php include 'Includes/navbar.php'; ?>

    <div class="container-width container-padding mx-auto mt-8 min-h-screen bg-white shadow-md rounded-lg" style="margin-top: 100px;">
        <div class="flex flex-col sm:flex-row justify-between items-center mb-4">
            <h2 class="large-text text-gray-700">List Of Residents</h2>
            <div class="flex space-x-4 mt-4 sm:mt-0">
                <input type="text" id="search" placeholder="Search..."
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 search-bar-width">
                <button id="export-button"
                    class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg">Export to Excel</button>
            </div>
        </div>

        <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200 shadow-sm rounded-lg">
            <thead class="bg-green-100">
                <tr>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-500">First Name</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-500">Middle Name</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-500">Last Name</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-500">Actions</th>
                </tr>
            </thead>
            <tbody id="residents-list">
                <!-- Residents list will be dynamically populated here -->
            </tbody>
        </table>
    </div>

    <?php include 'Includes/footer.php'; ?>
</body>

</html>