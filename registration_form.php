<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="Includes/background/bg.png">
    <title>Registration Form</title>
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
document.addEventListener('DOMContentLoaded', () => {
    // Dropdown Options
    const appellations = [
        "Select Appellation", "Mr.", "Mrs.", "Ms.", "Dr.", "Prof.", "Hon."
    ];
    const suffixes = [
        "Select Suffix", "Jr.", "Sr.", "II", "III", "IV", "V", "none"
    ];
    const placesOfBirth = [
        "Select Place of Birth", "Abra", "Agusan del Norte", "Agusan del Sur", "Aklan", "Albay", "Antique",
        "Apayao",
        "Aurora", "Basilan", "Bataan", "Batanes", "Batangas", "Benguet", "Biliran",
        "Bohol", "Bukidnon", "Bulacan", "Cagayan", "Camarines Norte", "Camarines Sur",
        "Camiguin", "Capiz", "Catanduanes", "Cavite", "Cebu", "Compostela Valley",
        "Cotabato", "Davao del Norte", "Davao del Sur", "Davao Occidental", "Davao Oriental",
        "Dinagat Islands", "Eastern Samar", "Guimaras", "Ifugao", "Ilocos Norte",
        "Ilocos Sur", "Iloilo", "Isabela", "Kalinga", "La Union", "Laguna", "Lanao del Norte",
        "Lanao del Sur", "Leyte", "Maguindanao", "Marinduque", "Masbate", "Metro Manila",
        "Misamis Occidental", "Misamis Oriental", "Mountain Province", "Negros Occidental",
        "Negros Oriental", "Northern Samar", "Nueva Ecija", "Nueva Vizcaya", "Occidental Mindoro",
        "Oriental Mindoro", "Palawan", "Pampanga", "Pangasinan", "Quezon", "Quirino",
        "Rizal", "Romblon", "Samar", "Sarangani", "Siquijor", "Sorsogon", "South Cotabato",
        "Southern Leyte", "Sultan Kudarat", "Sulu", "Surigao del Norte", "Surigao del Sur",
        "Tarlac", "Tawi-Tawi", "Zambales", "Zamboanga del Norte", "Zamboanga del Sur",
        "Zamboanga Sibugay"
    ];
    const civilStatuses = [
        "Select Civil Status", "Single", "Married", "Widowed", "Divorced", "Separated", "Annulled"
    ];
    const philhealthMemberships = [
        "Select Membership", "Member", "Dependent", "Retiree", "None"
    ];
    const educationalAttainments = [
        "Select Educational Attainment", "No Formal Education", "Elementary Graduate",
        "High School Graduate",
        "Vocational", "Associate Degree", "Bachelor's Degree", "Master's Degree", "Doctorate"
    ];
    const employmentStatuses = [
        "Select Employment Status", "Employed", "Unemployed", "Self-Employed", "Student", "Retired",
        "Others"
    ];
    const remarksNS = [
        "Select Nutrition Status", "Normal", "Underweight", "Overweight", "Obese", "Malnourished", "Others"
    ];
    const nationalities = [
        "Select Nationality", "Filipino", "American", "Chinese", "Japanese", "Korean", "Indian", "British",
        "Canadian", "Australian", "Other"
    ];
    const relationships = [
        "Select Relationship", "Parent", "Sibling", "Spouse", "Child", "Relative", "Friend", "Colleague",
        "Neighbor", "Other"
    ];

    // Function to populate dropdowns
    function populateDropdown(dropdownId, options) {
        const dropdown = document.getElementById(dropdownId);
        dropdown.innerHTML = ''; // Clear existing options
        options.forEach(option => {
            const optionElement = document.createElement('option');
            optionElement.value = option;
            optionElement.textContent = option;
            dropdown.appendChild(optionElement);
        });
    }

    // Populate static dropdowns
    populateDropdown('appellation', appellations);
    populateDropdown('suffix', suffixes); // Populate suffix dropdown
    populateDropdown('place_of_birth', placesOfBirth);
    populateDropdown('civil_status', civilStatuses);
    populateDropdown('philhealth_membership', philhealthMemberships);
    populateDropdown('educational_attainment', educationalAttainments);
    populateDropdown('employment_status', employmentStatuses);
    populateDropdown('remark_NS', remarksNS);
    populateDropdown('nationality', nationalities);
    populateDropdown('relationship', relationships);

    // Validate PhilHealth ID to be exactly 12 digits
    const philhealthIdInput = document.getElementById('philhealth_id');
    philhealthIdInput.addEventListener('input', (event) => {
        const value = event.target.value;
        if (/^\d{0,12}$/.test(value)) {
            event.target.value = value; // Allow only digits and up to 12 characters
        } else {
            event.target.value = value.slice(0, -1); // Remove last character if invalid
        }
    });

    // Validate Contact Number to be exactly 11 digits
    const contactNumberInput = document.getElementById('contact_number');
    contactNumberInput.setAttribute('placeholder', '09xxxxxxxxx'); // Hint for phone number format

    contactNumberInput.addEventListener('input', (event) => {
        let value = event.target.value;
        // Remove all non-numeric characters
        value = value.replace(/\D/g, '');

        // Ensure it is exactly 11 digits
        if (value.length > 11) {
            value = value.slice(0, 11); // Limit to 11 digits
        }
        event.target.value = value;
    });

    // Validate Emergency Phone Number to be exactly 11 digits
    const emergencyPhoneInput = document.getElementById('emergency_phone');
    emergencyPhoneInput.setAttribute('placeholder', '09xxxxxxxxx'); // Hint for phone number format

    emergencyPhoneInput.addEventListener('input', (event) => {
        let value = event.target.value;
        // Remove all non-numeric characters
        value = value.replace(/\D/g, '');

        // Ensure it is exactly 11 digits
        if (value.length > 11) {
            value = value.slice(0, 11); // Limit to 11 digits
        }
        event.target.value = value;
    });
});
</script>


<body class="bg-gray-100">
    <?php include 'Includes/header.php'; ?>
    <?php include 'Includes/navbar.php'; ?>

    <div class="wrapper">
        <div class="table-container">
        <div class="max-w-4xl mx-auto bg-white p-8 shadow-md" style="margin-top: 100px;">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold">Barangay Resident Registration Form</h2>
                <p class="text-green-600">Please provide the information needed</p>
            </div>

            <form id="registrationForm">
                <div class="mb-6">
                    <h3 class="text-lg font-bold mb-2">Personal Information</h3>
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
                        <div>
                            <label for="appellation" class="block text-sm font-medium text-gray-700">Appellation</label>
                            <select id="appellation" name="appellation"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option>Select Appellation</option>
                            </select>
                        </div>
                        <div>
                            <label for="place_of_birth" class="block text-sm font-medium text-gray-700">Place of Birth
                                *</label>
                            <select id="place_of_birth" name="place_of_birth"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option>Select Place of Birth</option>
                            </select>
                        </div>
                        <div>
                            <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth
                                *</label>
                            <input type="date" id="date_of_birth" name="date_of_birth"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                        </div>
                        <div>
                            <label for="gender" class="block text-sm font-medium text-gray-700">Gender *</label>
                            <div class="mt-1 flex">
                                <input type="radio" name="gender" id="male" value="Male" class="mr-2">
                                <label for="male" class="mr-4">Male</label>
                                <input type="radio" name="gender" id="female" value="Female" class="mr-2">
                                <label for="female">Female</label>
                            </div>
                        </div>
                        <div>
                            <label for="blood_type" class="block text-sm font-medium text-gray-700">Blood Type *</label>
                            <select id="blood_type" name="blood_type"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option>Select Blood Type</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>
                        <div>
                            <label for="nationality" class="block text-sm font-medium text-gray-700">Nationality *</label>
                            <select id="nationality" name="nationality"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option>Select Nationality</option>
                            </select>
                        </div>
                        <div>
                            <label for="civil_status" class="block text-sm font-medium text-gray-700">Civil Status *</label>
                            <select id="civil_status" name="civil_status"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option>Select Civil Status</option>
                            </select>
                        </div>
                        <div>
                            <label for="philhealth_membership" class="block text-sm font-medium text-gray-700">PhilHealth
                                Membership *</label>
                            <select id="philhealth_membership" name="philhealth_membership"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option>Select Membership</option>
                            </select>
                        </div>
                        <div id="philhealth_id_container" class="hidden">
                            <label for="philhealth_id" class="block text-sm font-medium text-gray-700">PhilHealth ID</label>
                            <input type="text" id="philhealth_id" name="philhealth_id"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div id="wra_container" class="hidden">
                            <label for="wra" class="block text-sm font-medium text-gray-700">WRA Last Menstruation
                                Period</label>
                            <input type="date" id="wra" name="wra"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="educational_attainment" class="block text-sm font-medium text-gray-700">Educational
                                Attainment *</label>
                            <select id="educational_attainment" name="educational_attainment"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option>Select Educational Attainment</option>
                            </select>
                        </div>
                        <div>
                            <label for="employment_status" class="block text-sm font-medium text-gray-700">Employment Status
                                *</label>
                            <select id="employment_status" name="employment_status"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option>Select Employment Status</option>
                            </select>
                        </div>
                        <div>
                            <label for="remark_NS" class="block text-sm font-medium text-gray-700">Remarks Nutrition Status
                                *</label>
                            <select id="remark_NS" name="remark_NS"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option>Select Nutrition Status</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="mb-6">
                    <h3 class="text-lg font-bold mb-2">Address Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="house_number" class="block text-sm font-medium text-gray-700">House Number *</label>
                            <input type="text" id="house_number" name="house_number"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                        </div>
                        <div>
                            <label for="street" class="block text-sm font-medium text-gray-700">Street *</label>
                            <input type="text" id="street" name="street"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                        </div>
                        <div>
                            <label for="barangay" class="block text-sm font-medium text-gray-700">Barangay *</label>
                            <input type="text" id="barangay" name="barangay"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                        </div>
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700">City *</label>
                            <input type="text" id="city" name="city"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                        </div>
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-bold mb-2">Contact Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="contact_number" class="block text-sm font-medium text-gray-700">Contact Number
                                *</label>
                            <input type="tel" id="contact_number" name="contact_number"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required pattern="\d{11}" placeholder="09xxxxxxxxx">
                        </div>
                        <div>
                            <label for="resident_since" class="block text-sm font-medium text-gray-700">Resident Since
                                *</label>
                            <input type="date" id="resident_since" name="resident_since"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-bold mb-2">Person to Notify in Case of Emergency</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="emergency_name" class="block text-sm font-medium text-gray-700">Full Name *</label>
                            <input type="text" id="emergency_name" name="emergency_name"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                        </div>
                        <div>
                            <label for="emergency_phone" class="block text-sm font-medium text-gray-700">Contact Number
                                *</label>
                            <input type="tel" id="emergency_phone" name="emergency_phone"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required pattern="\d{11}" placeholder="09xxxxxxxxx">
                        </div>
                        <div>
                            <label for="relationship" class="block text-sm font-medium text-gray-700">Relationship *</label>
                            <select id="relationship" name="relationship"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option>Select Relationship</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-bold mb-2">Business Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Do you own a business? *</label>
                            <div class="mt-1 flex">
                                <input type="radio" name="business_owner" id="business_owner_yes" value="Yes" class="mr-2">
                                <label for="business_owner_yes" class="mr-4">Yes</label>
                                <input type="radio" name="business_owner" id="business_owner_no" value="No" class="mr-2">
                                <label for="business_owner_no">No</label>
                            </div>
                        </div>
                    </div>
                    <div id="business_info_container" class="grid grid-cols-1 md:grid-cols-3 gap-4 hidden">
                        <div>
                            <label for="business_name" class="block text-sm font-medium text-gray-700">Business Name *</label>
                            <input type="text" id="business_name" name="business_name"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="business_address" class="block text-sm font-medium text-gray-700">Business Address *</label>
                            <input type="text" id="business_address" name="business_address"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                    </div>
                </div>
                
                <div class="text-center">
                    <button type="submit" class="bg-green-500 text-white font-bold py-2 px-4 rounded-md">Submit</button>
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
    </div>
    <?php include 'Includes/footer.php'; ?>

    <!-- Firebase SDKs in compat mode -->
    <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-app-compat.js" defer></script>
    <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-database-compat.js" defer></script>

    <!-- External JS File for Firebase and Form Handling -->
    <script src="firebase-resident.js" defer></script>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const businessOwnerInputs = document.querySelectorAll('input[name="business_owner"]');
        const businessInfoContainer = document.getElementById('business_info_container');
            businessOwnerInputs.forEach(input => {
                input.addEventListener('change', () => {
                  if (input.value === 'Yes') {
                        businessInfoContainer.classList.remove('hidden');
                    } else {
                         businessInfoContainer.classList.add('hidden');
                        }
                    });
            });
    });

    // Show or hide WRA field based on selected gender
    const genderInputs = document.querySelectorAll('input[name="gender"]');
    const wraContainer = document.getElementById('wra_container');

    genderInputs.forEach(input => {
        input.addEventListener('change', () => {
            if (input.value === 'Female') {
                wraContainer.classList.remove('hidden');
            } else {
                wraContainer.classList.add('hidden');
            }
        });
    });

    // Show or hide PhilHealth ID field based on selected PhilHealth Membership
    const philhealthMembershipSelect = document.getElementById('philhealth_membership');
    const philhealthIdContainer = document.getElementById(
        'philhealth_id_container'); // Assuming the PhilHealth ID input is inside a container

    philhealthMembershipSelect.addEventListener('change', () => {
        const selectedValue = philhealthMembershipSelect.value;

        // Show PhilHealth ID for "Member" and "Retiree"
        if (selectedValue === 'Member' || selectedValue === 'Retiree') {
            philhealthIdContainer.classList.remove('hidden');
        } else {
            philhealthIdContainer.classList.add('hidden');
        }
    });
    </script>
</body>

</html>