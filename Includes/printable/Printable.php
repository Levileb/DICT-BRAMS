<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="printable.css"> <!-- External CSS -->
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
    <script src="printable.js"></script> <!-- External JS -->
    <title>Barangay Document</title>
</head>
<body>

    <?php
    // Function to add the ordinal suffix to a day
    function getOrdinalSuffix($day) {
        if (!in_array(($day % 100), [11, 12, 13])) {
            switch ($day % 10) {
                case 1: return 'st';
                case 2: return 'nd';
                case 3: return 'rd';
            }
        }
        return 'th';
    }

    // Current date for issuance
    $day = date('j');
    $suffix = getOrdinalSuffix($day);
    $month = date('F');
    $year = date('Y');
    $dateOfIssuance = "{$day}{$suffix} of {$month} {$year}";

    // Retrieve GET parameters
    $or_number = $_GET['or_number'] ?? '________________________';
    $purpose = $_GET['purpose'] ?? '________________________';
    $resident_id = $_GET['resident_id'] ?? '1';
    $document_type = $_GET['type'] ?? 'clearance'; // Default document type

    // Placeholder fields (to be replaced by JS with Firebase data)
    $name = "________________________";
    $age = "____";
    $civilStatus = "________________";
    $gender = "______";
    $birthDate = "________________";
    $birthPlace = "________________";
    ?>

    <!-- Hidden inputs for JS -->
    <input type="hidden" id="residentId" value="<?php echo $resident_id; ?>">
    <input type="hidden" id="documentType" value="<?php echo $document_type; ?>">
    <input type="hidden" id="purpose" value="<?php echo $purpose; ?>">
    <input type="hidden" id="orNumber" value="<?php echo $or_number; ?>">

    <div class="logo">
        <img class="left-logo" src="barangay8logo.png" alt="Barangay Logo">
        <div class="logo-text">
            <h5>Republic of the Philippines</h5>
            <h4><strong>OFFICE OF THE SANGGUNIANG BARANGAY</strong></h4>
            <h5>Barangay 8, Bacolod City</h5>
        </div>
    </div>

    <div class="clearfix centered-logo-wrapper">
        <!-- Officers Content -->
        <div class="officers content">
            <strong>HON. EVELYN F. DONESA</strong><br>
            Punong Barangay<br><br><br>
            
            <strong>KAGAWAD</strong><br><br>
            <strong>HON. JIMMY D. MARANON</strong><br>
            Chairman Committee on<br>
            Appropriation Disaster & Rescue<br><br><br>
            
            <strong>HON. CRISTY P. BAUTISTA</strong><br>
            Chairman Committee on<br>
            Social Services/Women and Family<br><br><br>
            
            <strong>HON. JOHNRY V. MALONGAYON</strong><br>
            Chairman Committee on<br>
            Health & Sanitation / Environmental<br>
            Protection & Natural Resources<br><br><br>
            
            <strong>HON. HELEN S. MAMOM</strong><br>
            Chairman Committee on<br>
            Education Laws and Ordinances<br><br><br>
            
            <strong>HON. NOMER S. EDRAMA SR.</strong><br>
            Chairman Committee on<br>
            Market & Livelihood/Tourism Development<br><br><br>
            
            <strong>JAYCO FRANCISCO L. DOCTORA</strong><br>
            Chairman Committee on<br>
            Barangay Affair/ Ways & Means/ Infrastructure<br><br><br>
            
            <strong>JOENITO Q. TALEON</strong><br>
            Chairman Committee on<br>
            Peace & Order / Human Rights<br><br><br>
            
            <strong>JOEKAILLAH A. TALEON</strong><br>
            Sk Chairman / Committee on<br>
            Youth & Sports Development<br><br><br>
            
            <strong>DARYLL LYN O. TOLOSA</strong><br>
            Barangay Secretary<br><br><br>
            
            <strong>JAMES G. TORRES</strong><br>
            Barangay Treasurer<br><br>
        </div>

        <!-- Document Section -->
        <div class="summary content">
            <h2 id="documentTitle" class="barangay-title"></h2>
            <p>
                TO WHOM IT MAY CONCERN:<br><br>
                This is to CERTIFY that <strong id="residentName"><?php echo $name; ?></strong>, 
                <strong id="age"><?php echo $age; ?></strong> years old, 
                <strong id="civilStatus"><?php echo $civilStatus; ?></strong>, 
                <strong id="gender"><?php echo $gender; ?></strong>, born on 
                <strong id="birthDate"><?php echo $birthDate; ?></strong>, at <strong id="birthPlace"><?php echo $birthPlace; ?></strong>, 
                is a bonafide resident of Barangay 8, Bacolod City.<br><br>
                This certification is issued upon the request of the above-named person for 
                <strong id="purposeField"><?php echo $purpose; ?></strong> and for whatever lawful purpose/s it may serve best.<br><br>
                Issued this <strong id="dateOfIssuance"><?php echo $dateOfIssuance; ?></strong> at Barangay 8, Bacolod City, Philippines.<br><br><br><br>
                <strong>HON. EVELYN F. DONESA</strong><br>
                Punong Barangay
            </p>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <span>Official Receipt No.: <strong id="orField"><?php echo $or_number; ?></strong></span>
    </footer>

    <script>
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


        firebase.initializeApp(firebaseConfig);
        const database = firebase.database();

        const residentId = document.getElementById("residentId").value;
        const documentType = document.getElementById("documentType").value;
        const purpose = document.getElementById("purpose").value;
        const orNumber = document.getElementById("orNumber").value;

        

        database.ref(`Residents/${residentId}`).once("value").then((snapshot) => {
            if (snapshot.exists()) {
                const data = snapshot.val();
                document.getElementById("residentName").textContent = `${data.appellation} ${data.first_name} ${data.last_name}`;
                document.getElementById("age").textContent = calculateAge(data.date_of_birth);
                document.getElementById("civilStatus").textContent = data.civil_status;
                document.getElementById("gender").textContent = data.appellation === "Mr." ? "Male" : "Female";
                document.getElementById("birthDate").textContent = DateR(data.date_of_birth);
                document.getElementById("birthPlace").textContent = data.birth_place || "Barangay 8";
                document.getElementById("purposeField").textContent = purpose;
                document.getElementById("orField").textContent = orNumber;

                const documentTitleMap = {
                    clearance: "BARANGAY CLEARANCE",
                    residency: "CERTIFICATE OF RESIDENCY",
                    indigency: "CERTIFICATE OF INDIGENCY",
                    certification: "CERTIFICATION"
                };
                document.getElementById("documentTitle").textContent = documentTitleMap[documentType] || "CERTIFICATION";
            } else {
                console.error("Resident data not found.");
            }
        });

        // Calculate Age
        export function calculateAge(birthDate) {
        const birth = new Date(birthDate);
        const today = new Date();
        let age = today.getFullYear() - birth.getFullYear();
        const monthDiff = today.getMonth() - birth.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
            age--;
        }
        return age;
         }

        // Convert to Date object
        export function DateR(dateString) {
        const dateObj = new Date(dateString);

            if (isNaN(dateObj.getTime())) {
                throw new Error("Invalid date format");
            }

            return dateObj.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            }
    </script>
</body>
</html>
