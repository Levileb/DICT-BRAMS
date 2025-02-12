<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Logs</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <!-- Include SheetJS for Excel export -->
    <!-- <script src="firebase-resident.js"></script> Your Firebase config file -->
    <script src="archive_resident.js"></script>
</head>
<style>
body::-webkit-scrollbar {
    display: none;
}

.sub-container {
    width: 100%;
    margin-left: 0.5rem;

}

.inner-container {
    max-height: 100%;
    overflow-y: auto;
    width: 100%;
    margin-left: 0.5rem;
    margin-right: 0.5rem;
}
</style>

<body class="bg-gray-100">
    <?php include 'Includes/header.php'; ?>
    <?php include 'Includes/admin-navbar.php'; ?>

    <div class="inner-container">
        <div class="sub-container p-6 w-full bg-white rounded-lg shadow-md overflow-x-auto">
            <div class="container-width container-padding bg-white shadow-md rounded-lg">
                <div class="flex flex-col sm:flex-row justify-between items-center px-4 py-4">
                    <h2 class="large-text text-gray-700">Archived Residents</h2>
                    <div class="flex space-x-4 mt-4 sm:mt-0">
                        <input type="text" id="search" placeholder="Search..."
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 search-bar-width">
                        <button id="export-button"
                            class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg">Export to
                            Excel</button>
                    </div>
                </div>

                <table
                    class="min-w-full bg-white border border-gray-200 divide-y px-4 py-4 divide-gray-200 shadow-sm rounded-lg">
                    <thead class="bg-green-100">
                        <tr>
                            <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">First Name</th>
                            <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Middle Name</th>
                            <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Last Name</th>
                            <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Actions</th>
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
    </div>
    </div>

    <!-- Modal Structure -->
    <div id="resident-modal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Resident Details
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500" id="modal-content">Loading...</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                        onclick="closeModal()">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="recover_resident.js"></script> <!-- Include the archive function -->

    <script>
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


    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.getElementById('search');
        const tableBody = document.getElementById('residents-list');
        const exportButton = document.getElementById('export-button');
        let openDropdown = null;

        loadResidents();

        function loadResidents() {
            const database = firebase.database().ref('Archived_Resident');
            const residentsData = [];

            database.once('value').then(function(snapshot) {
                const residents = snapshot.val();
                tableBody.innerHTML = '';

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
                                            <path fill-rule="evenodd" d="M5.293 9.293a1 1 0 011.414 0L10 12.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a 1 1 0 01-1.414 0l-4-4a 1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10 hidden">
                                        <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                            <a href="javascript:void(0);" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-100" role="menuitem" onclick="showResidentDetails('${key}');">View Details</a>
                                            <a href="javascript:void(0);" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-100" role="menuitem" onclick="confirmDeleteResident('${key}');">Delete</a>
                                            <a href="javascript:void(0);" class="block px-4 py-2 text-sm text-gray-700 hover:bg-yellow-100" role="menuitem" onclick="recoverResident('${key}');">Recover</a>
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
            }).catch(function(error) {
                console.error('Error loading residents:', error);
            });
        }

        function initializeDropdowns() {
            document.querySelectorAll('.dropdown-button').forEach(button => {
                button.addEventListener('click', event => {
                    event.stopPropagation();
                    const dropdown = button.nextElementSibling;

                    if (openDropdown && openDropdown !== dropdown) {
                        openDropdown.classList.add('hidden');
                    }

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
            const fileName = `archived_residents_data_${month}-${day}-${year}.xlsx`;

            const worksheet = XLSX.utils.json_to_sheet(residentsData);
            const workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, worksheet, "Residents");

            XLSX.writeFile(workbook, fileName);
        }



        function recoverResident(residentId) {
            // Show confirmation dialog
            const confirmation = document.createElement('div');
            confirmation.classList.add('confirmation-popup');
            confirmation.innerHTML = `
                    <div class="popup-content">
                        <p class="text-lg font-semibold text-center">Are you sure you want to recover this resident?</p>
                        <div class="flex justify-center mt-4">
                            <button class="bg-green-500 text-white px-6 py-2 rounded-md mr-4" onclick="confirmRecoverResident('${residentId}')">Yes</button>
                            <button class="bg-red-500 text-white px-6 py-2 rounded-md" onclick="cancelRecoverResident()">No</button>
                        </div>
                    </div>
                `;
            document.body.appendChild(confirmation);
        }

        function confirmRecoverResident(residentId) {
            const residentRef = firebase.database().ref('Archived_Resident/' + residentId);

            // Recover resident by moving back to active
            const activeResidentRef = firebase.database().ref('Resident/' + residentId);
            residentRef.once('value').then((snapshot) => {
                if (snapshot.exists()) {
                    activeResidentRef.set(snapshot.val()).then(() => {
                        residentRef.remove();
                        alert('Resident has been successfully recovered.');
                        loadResidents();
                    });
                }
            }).catch((error) => {
                console.error('Error recovering resident:', error);
                alert('Failed to recover resident.');
            });
        }

        function cancelRecoverResident() {
            const confirmation = document.querySelector('.confirmation-popup');
            confirmation.remove();
        }

        window.showResidentDetails = function(residentId) {
            const residentRef = firebase.database().ref('Archived_Resident/' + residentId);
            const modal = document.getElementById('resident-modal');
            const modalContent = document.getElementById('modal-content');

            residentRef.once('value').then((snapshot) => {
                if (snapshot.exists()) {
                    const resident = snapshot.val();
                    modalContent.innerHTML = `
                            <p><strong>First Name:</strong> ${resident.first_name || ''}</p>
                            <p><strong>Middle Name:</strong> ${resident.middle_name || ''}</p>
                            <p><strong>Last Name:</strong> ${resident.last_name || ''}</p>
                            <p><strong>Appellation:</strong> ${resident.appellation || ''}</p>
                            <p><strong>Place of Birth:</strong> ${resident.place_of_birth || ''}</p>
                            <p><strong>Date of Birth:</strong> ${resident.date_of_birth || ''}</p>
                            <p><strong>Gender:</strong> ${resident.gender || ''}</p>
                            <p><strong>Nationality:</strong> ${resident.nationality || ''}</p>
                            <p><strong>Civil Status:</strong> ${resident.civil_status || ''}</p>
                            <p><strong>Philhealth ID:</strong> ${resident.philhealth_id || ''}</p>
                            <p><strong>Philhealth Membership:</strong> ${resident.philhealth_membership || ''}</p>
                            <p><strong>WRA:</strong> ${resident.wra || ''}</p>
                            <p><strong>Educational Attainment:</strong> ${resident.educational_attainment || ''}</p>
                            <p><strong>Employment Status:</strong> ${resident.employment_status || ''}</p>
                            <p><strong>Remark NS:</strong> ${resident.remark_NS || ''}</p>
                            <p><strong>Resident Since:</strong> ${resident.resident_since || ''}</p>
                            <p><strong>Contact Number:</strong> ${resident.contact_number || ''}</p>
                            <p><strong>Emergency Name:</strong> ${resident.emergency_name || ''}</p>
                            <p><strong>Emergency Phone:</strong> ${resident.emergency_phone || ''}</p>
                            <p><strong>Relationship:</strong> ${resident.relationship || ''}</p>
                        `;
                    modal.classList.remove('hidden');
                } else {
                    modalContent.innerHTML = 'No data available for this resident.';
                    modal.classList.remove('hidden');
                }
            }).catch((error) => {
                console.error('Error fetching resident details:', error);
                modalContent.innerHTML = 'Failed to fetch resident details.';
                modal.classList.remove('hidden');
            });
        };

        window.closeModal = function() {
            const modal = document.getElementById('resident-modal');
            modal.classList.add('hidden');
        };
    });
    </script>

    <?php include 'Includes/footer.php'; ?>
</body>

</html>