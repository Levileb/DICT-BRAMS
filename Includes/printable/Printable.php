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
    <style>
        /* Ensure the print button does not show up in the printed document */
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
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

    <!-- Print Button -->
    <div class="no-print text-right m-3">
        <button class="btn btn-primary" onclick="printDocument()">Print Document</button>
    </div>
<script>
    var orNumber = <?php echo json_encode($or_number); ?>;
    var docType = <?php echo json_encode($document_type); ?>;
    var fullname = <?php echo json_encode($name); ?>;


    function printDocument() {
    window.onafterprint = function() {
        const isSuccessful = confirm("Was the printing completed successfully?");
        const printStatus = isSuccessful ? "successful" : "failed";
        logPrintDetails(fullname, docType, printStatus, orNumber);
        if (isSuccessful) {
            alert("Printing confirmed as successful.");
        } else {
            alert("Printing was not successful. Please try again.");
        }
    };
    window.print();
}

function logPrintDetails(fullname , docType, printStatus, orNumber) {
    const printLogRef = database.ref('PrintLogs').push();
    const printDate = new Date().toLocaleDateString('en-US', {
        month: 'long',
        day: 'numeric',
        year: 'numeric'
    });
    const printTime = new Date().toLocaleTimeString('en-US', {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: true
    });

    const email = getCookie('email');  

    printLogRef.set({
        orNumber: orNumber,
        residentName: fullname,
        userEmail: email,
        documentType: docType,
        date: printDate,
        time: printTime,
        printStatus: printStatus
    }, function(error) {
        if (error) {
            console.error("Error logging print details:", error);
        } else {
            console.log("Print details logged successfully.");
        }
    });
}

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}

// Helper function to check if a value is undefined, null, or empty and replace it with a placeholder
const safeValue = (value, placeholder) => value && value.trim() ? value : placeholder;
</script>

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
        <div id="officers" style="margin-left: 30px;"></div>
        
        <!-- Document Section -->
        <?php
            if ($document_type == 'CERTIFICATE OF RESIDENCY') {
            ?>
            <div class="summary content">
            <h2 id="documentTitle" class="barangay-title"><?php echo $document_type; ?></h2>
                <p>
                TO WHOM ITa MAY CONCERN:<br><br>
                This is to CERTIFY that <strong id="residentName"><?php echo $name; ?></strong>, 
                <strong id="age"><?php echo $age; ?></strong> years old, 
                <strong id="civilStatus"><?php echo $civilStatus; ?></strong>, 
                <strong id="gender"><?php echo $gender; ?></strong>, born on 
                <strong id="birthDate"><?php echo $birthDate; ?></strong>, at <strong id="birthPlace"><?php echo $birthPlace; ?></strong>, 
                is a bonafide resident of Barangay 8, Bacolod City whose means of livelihood is barely<br><br>
                This certification is issued upon the request of the above-named person for 
                <strong id="purposeField"><?php echo $purpose; ?></strong> and for whatever lawful purpose/s it may serve best.<br><br>
                Issued this <strong id="dateOfIssuance"><?php echo $dateOfIssuance; ?></strong> at Barangay 8, Bacolod City, Philippines.<br><br><br><br>
                <strong id='punongBarangayName'></strong><br>
                Punong Barangay
                </p>
            </div>
            <?php
            } else if ($document_type == 'CERTIFICATION') {
            ?>
            <div class="summary content">
            <h2 id="documentTitle" class="barangay-title"><?php echo $document_type; ?></h2>
                <p>
                TO WHOM ITb MAY CONCERN:<br><br>
                This is to CERTIFY that <strong id="residentName"><?php echo $name; ?></strong>, 
                <strong id="age"><?php echo $age; ?></strong> years old, 
                <strong id="civilStatus"><?php echo $civilStatus; ?></strong>, 
                <strong id="gender"><?php echo $gender; ?></strong>, born on 
                <strong id="birthDate"><?php echo $birthDate; ?></strong>, at <strong id="birthPlace"><?php echo $birthPlace; ?></strong>, 
                is a bonafide resident of Barangay 8, Bacolod City.<br><br>
                This certification is issued upon the request of the above-named person for 
                <strong id="purposeField"><?php echo $purpose; ?></strong> and for whatever lawful purpose/s it may serve best.<br><br>
                Issued this <strong id="dateOfIssuance"><?php echo $dateOfIssuance; ?></strong> at Barangay 8, Bacolod City, Philippines.<br><br><br><br>
                <strong id='punongBarangayName'></strong><br>
                Punong Barangay
                </p>
            </div>
            <?php
            } else if($document_type == 'BARAGAY CLEARANCE'){
            ?>
            <div class="summary content">
            <h2 id="documentTitle" class="barangay-title"><?php echo $document_type; ?></h2>
                <p>
                TO WHOM ITb MAY CONCERN:<br><br>
                This is to CERTIFY that <strong id="residentName"><?php echo $name; ?></strong>, 
                <strong id="age"><?php echo $age; ?></strong> years old, 
                <strong id="civilStatus"><?php echo $civilStatus; ?></strong>, 
                <strong id="gender"><?php echo $gender; ?></strong>, born on 
                <strong id="birthDate"><?php echo $birthDate; ?></strong>, at <strong id="birthPlace"><?php echo $birthPlace; ?></strong>, 
                is a bonafide resident of Barangay 8, Bacolod City.<br><br>
                This certification is issued upon the request of the above-named person for 
                <strong id="purposeField"><?php echo $purpose; ?></strong> and for whatever lawful purpose/s it may serve best.<br><br>
                Issued this <strong id="dateOfIssuance"><?php echo $dateOfIssuance; ?></strong> at Barangay 8, Bacolod City, Philippines.<br><br><br><br>
                <strong id='punongBarangayName'></strong><br>
                Punong Barangay
                </p>
            </div>
            <?php
            } else if($document_type == 'CERTIFICATE OF INDIGENCY'){
            ?>
            <div class="summary content">
            <h2 id="documentTitle" class="barangay-title"><?php echo $document_type; ?></h2>
                <p>
                TO WHOM ITb MAY CONCERN:<br><br>
                This is to CERTIFY that <strong id="residentName"><?php echo $name; ?></strong>, 
                <strong id="age"><?php echo $age; ?></strong> years old, 
                <strong id="civilStatus"><?php echo $civilStatus; ?></strong>, 
                <strong id="gender"><?php echo $gender; ?></strong>, born on 
                <strong id="birthDate"><?php echo $birthDate; ?></strong>, at <strong id="birthPlace"><?php echo $birthPlace; ?></strong>, 
                is a bonafide resident of Barangay 8, Bacolod City.<br><br>
                This certification is issued upon the request of the above-named person for 
                <strong id="purposeField"><?php echo $purpose; ?></strong> and for whatever lawful purpose/s it may serve best.<br><br>
                Issued this <strong id="dateOfIssuance"><?php echo $dateOfIssuance; ?></strong> at Barangay 8, Bacolod City, Philippines.<br><br><br><br>
                <strong id='punongBarangayName'></strong><br>
                Punong Barangay
                </p>
            </div>
            <?php
            } elseif($document_type == 'CERTIFICATE OF BUSINESS CLOSURE'){
            ?>
            <div class="summary content">
            <h2 id="documentTitle" class="barangay-title"><?php echo $document_type; ?></h2>
                <p>
                TO WHOM ITb MAY CONCERN:<br><br>
                This is to CERTIFY that <strong id="residentName"><?php echo $name; ?></strong>, 
                <strong id="age"><?php echo $age; ?></strong> years old, 
                <strong id="civilStatus"><?php echo $civilStatus; ?></strong>, 
                <strong id="gender"><?php echo $gender; ?></strong>, born on 
                <strong id="birthDate"><?php echo $birthDate; ?></strong>, at <strong id="birthPlace"><?php echo $birthPlace; ?></strong>, 
                is a bonafide resident of Barangay 8, Bacolod City.<br><br>
                This certification is issued upon the request of the above-named person for 
                <strong id="purposeField"><?php echo $purpose; ?></strong> and for whatever lawful purpose/s it may serve best.<br><br>
                Issued this <strong id="dateOfIssuance"><?php echo $dateOfIssuance; ?></strong> at Barangay 8, Bacolod City, Philippines.<br><br><br><br>
                <strong id='punongBarangayName'></strong><br>
                Punong Barangay
                </p>
            </div>
            <?php
            }
            else {
            ?>
            <div class="summary content">
            <h2 id="documentTitle" class="barangay-title"><?php echo $document_type; ?></h2>
                <p>
                TO WHOM ITs MAY CONCERN:<br><br>
                This is to CERTIFY that <strong id="residentName"><?php echo $name; ?></strong>, 
                <strong id="age"><?php echo $age; ?></strong> years old, 
                <strong id="civilStatus"><?php echo $civilStatus; ?></strong>, 
                <strong id="gender"><?php echo $gender; ?></strong>, born on 
                <strong id="birthDate"><?php echo $birthDate; ?></strong>, at <strong id="birthPlace"><?php echo $birthPlace; ?></strong>, 
                is a bonafide resident of Barangay 8, Bacolod City.<br><br>
                This certification is issued upon the request of the above-named person for 
                <strong id="purposeField"><?php echo $purpose; ?></strong> and for whatever lawful purpose/s it may serve best.<br><br>
                Issued this <strong id="dateOfIssuance"><?php echo $dateOfIssuance; ?></strong> at Barangay 8, Bacolod City, Philippines.<br><br><br><br>
                <strong id='punongBarangayName'></strong><br>
                Punong Barangay
                </p>
            </div>
            <?php
            }
        ?>

    <!-- Footer -->
    <footer class="footer">
        <span>Official Receipt No.: <strong id="orField"><?php echo $or_number; ?></strong></span>
    </footer>

</body>
</html>
