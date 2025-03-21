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
    $incharge = $_GET['incharge'] ?? '________________________';
    $resident_id = $_GET['resident_id'] ?? '1';
    $document_type = $_GET['type'] ?? 'clearance'; // Default document type

    // Placeholder fields (to be replaced by JS with Firebase data)
    $name = "________________________";
    $businessName = "________________";
    $businessAddress = "________________";
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
    const printModal = document.getElementById("printModal");
    const confirmButton = document.getElementById("confirmPrint");
    const cancelButton = document.getElementById("cancelPrint");
    const alertModal = document.getElementById("alertModal");
    const alertMessage = document.getElementById("alertMessage");
    const closeAlert = document.getElementById("closeAlert");
    
    function showAlert(message) {
        alertMessage.textContent = message;
        alertModal.style.display = "block";
    }
    
    closeAlert.onclick = function() {
        alertModal.style.display = "none";
    };
    
    window.onafterprint = function() {
        printModal.style.display = "block"; // Show modal after print
    };
    
    confirmButton.onclick = function() {
        logPrintDetails(fullname, docType, "successful", orNumber);
        showAlert("Printing confirmed as successful.");
        printModal.style.display = "none";
    };
    
    cancelButton.onclick = function() {
        logPrintDetails(fullname, docType, "failed", orNumber);
        showAlert("Printing was not successful. Please try again.");
        printModal.style.display = "none";
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


</script>

<div id="alertModal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:white; padding:20px; z-index:1000; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 8px; text-align: center;">
    <p id="alertMessage" style="font-size: 16px; margin-bottom: 20px;"></p>
    <button id="closeAlert" class="btn btn-primary">OK</button>
</div>



<div id="printModal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:white; padding:20px; z-index:1000; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 8px; text-align: center;">
    <p style="font-size: 16px; margin-bottom: 20px;"> <strong> Was the printing completed successfully?</strong><br>
    <em>note: Please confirm after the printing</em></p>
    <button id="confirmPrint" class="btn btn-success" style="margin-right: 10px;">Yes</button>
    <button id="cancelPrint" class="btn btn-danger">No</button>
</div>

<div class="header">
<div class="logo">
        <img class="left-logo" src="barangay8logo.png" alt="Barangay Logo">
        <div class="logo-text">
            <h5>Republic of the Philippines</h5>
            <h4><strong>OFFICE OF THE SANGGUNIANG BARANGAY</strong></h4>
            <p>Ayala Malls Capitol Central, South Capitol Road <br> Barangay 8, Bacolod</p>
        </div>
      
    </div>
      <div class="contact-info d-flex justify-content-between">
        <p style="font-size: 15px;">Contact Number: 0919 560 5949/ 0995 073 6860</p>
        <p style="font-size: 15px;">Gmail: asensobrangayotso@gmail.com</p>
        <p style="font-size: 15px;">Facebook: Barangay Otso(Asesnso Barangay Otso)</p>
    </div>
</div>
   
   
 
    <div class="clearfix centered-logo-wrapper">
        <!-- Officers Content -->
        <div id="officers" style="margin-left: 30px; border-right: 1px solid black; padding-right: 10px; color: #192055;"></div>
        
        <!-- Document Section -->
        <?php
            if ($document_type == 'CERTIFICATE OF RESIDENCY') {
            ?>
            <div class="summary content">
            <h2 id="documentTitle" class="barangay-title"><?php echo $document_type; ?></h2>
                <p>
                TO WHOM IT MAY CONCERN:<br><br>
                This is to CERTIFY that <strong id="residentName"><?php echo $name; ?></strong>, 
                <strong id="age"><?php echo $age; ?></strong> years old, 
                <strong id="civilStatus"><?php echo $civilStatus; ?></strong>, 
                <strong id="gender"><?php echo $gender; ?></strong>, born on 
                <strong id="birthDate"><?php echo $birthDate; ?></strong>, at <strong id="birthPlace"><?php echo $birthPlace; ?></strong>, 
                is a <strong>PERMANENT RESIDENT</strong> of this Barangay 8, Bacolod City.<br><br>
                Based on records of this office, this person has been residing at Barangay 8, Bacolod City.
                This certification is issued upon the request of the above-named person for 
                <strong id="purposeField"><?php echo $purpose; ?></strong> and for whatever lawful purpose/s it may serve best.<br><br>
                Issued this <strong id="dateOfIssuance"><?php echo $dateOfIssuance; ?></strong> at Barangay 8, Bacolod City, Philippines.<br><br><br><br>

                <?php if (!empty($incharge) && $incharge !== '________________________') { ?>
                    <strong id='incharge'><?php echo $incharge; ?></strong><br>
                    Officer In Charge
                    <br> <br> <br>
                <?php } ?>

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
              
                
                <?php if (!empty($incharge) && $incharge !== '________________________') { ?>
                    <strong id='incharge'><?php echo $incharge; ?></strong><br>
                    Officer In Charge
                    <br> <br> <br>
                <?php } ?>

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
                TO WHOM IT MAY CONCERN:<br><br>
                This is to CERTIFY that <strong id="residentName"><?php echo $name; ?></strong>, 
                <strong id="age"><?php echo $age; ?></strong> years old, 
                <strong id="civilStatus"><?php echo $civilStatus; ?></strong>, 
                <strong id="gender"><?php echo $gender; ?></strong>, born on 
                <strong id="birthDate"><?php echo $birthDate; ?></strong>, at <strong id="birthPlace"><?php echo $birthPlace; ?></strong>, 
                is a resident of Barangay 8, Bacolod City is known as to be of a good moral and law-abiding citizen of this barangay.<br><br>
                To certify further, he/she has no derogatory and/or criminal records field in this barangay.<br><br>
                Issued this <strong id="dateOfIssuance"><?php echo $dateOfIssuance; ?></strong> at Barangay 8, Bacolod City, Philippines.<br><br><br><br>
                
                
                <?php if (!empty($incharge) && $incharge !== '________________________') { ?>
                    <strong id='incharge'><?php echo $incharge; ?></strong><br>
                    Officer In Charge
                    <br> <br> <br>
                <?php } ?>

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
                TO WHOM IT MAY CONCERN:<br><br>
                This is to CERTIFY that <strong id="residentName"><?php echo $name; ?></strong>, 
                <strong id="age"><?php echo $age; ?></strong> years old, 
                <strong id="civilStatus"><?php echo $civilStatus; ?></strong>, 
                <strong id="gender"><?php echo $gender; ?></strong>, born on 
                <strong id="birthDate"><?php echo $birthDate; ?></strong>, at <strong id="birthPlace"><?php echo $birthPlace; ?></strong>, 
                is a bonafide resident of Barangay 8, Bacolod City, belong to the <strong>Indigent</strong> families  of this barangay 
                having an annual income not exceeding the Regional Poverty Threshold (RPT) 
                of Php 169, 824.00 per anum as determined by the National Economic Development Authority (NEDA).<br><br>
                This certification is issued upon the request of the above-named person for 
                <strong id="purposeField"><?php echo $purpose; ?></strong> and for whatever lawful purpose/s it may serve best.<br><br>
                Issued this <strong id="dateOfIssuance"><?php echo $dateOfIssuance; ?></strong> at Barangay 8, Bacolod City, Philippines.<br><br><br><br>

                
                <?php if (!empty($incharge) && $incharge !== '________________________') { ?>
                    <strong id='incharge'><?php echo $incharge; ?></strong><br>
                    Officer In Charge
                    <br> <br> <br>
                <?php } ?>

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
                TO WHOM IT MAY CONCERN:<br><br>
                This is to CERTIFY that <strong id="businessName"><?php echo $businessName?></strong> owned by
                 <strong id="residentName"><?php echo $name; ?></strong>, located
                <strong id="businessAddress"><?php echo $businessAddress?></strong>,  has not been operating and is permanently closed as of 
                <strong id="dateOfIssuance"><?php echo $dateOfIssuance; ?></strong>.<br><br>
 
                <span style="display: none;">
                This is to CERTIFY that, 
                that is  <strong id="age"><?php echo $age; ?></strong> years old, 
                <strong id="civilStatus"><?php echo $civilStatus; ?></strong>, 
                <strong id="gender"><?php echo $gender; ?></strong>, born on 
                <strong id="birthDate"><?php echo $birthDate; ?></strong>, at <strong id="birthPlace"><?php echo $birthPlace; ?></strong>, 
                is a bonafide resident of Barangay 8, Bacolod City.<br><br>
                </span>

                This certification is issued upon the request of the above-named person for 
                <strong id="purposeField"><?php echo $purpose; ?></strong> and for whatever lawful purpose/s it may serve best.<br><br>
                Issued this <strong id="dateOfIssuance"><?php echo $dateOfIssuance; ?></strong> at Barangay 8, Bacolod City, Philippines.<br><br><br><br>
               
                
                <?php if (!empty($incharge) && $incharge !== '________________________') { ?>
                    <strong id='incharge'><?php echo $incharge; ?></strong><br>
                    Officer In Charge
                    <br> <br> <br>
                <?php } ?>

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
                <br><strong style="text-align: left; display: block;">TO WHOM IT MAY CONCERN:</strong>
                This is to CERTIFY that <strong id="residentName"><?php echo $name; ?></strong>, 
                <strong id="age"><?php echo $age; ?></strong> years old, 
                <strong id="civilStatus"><?php echo $civilStatus; ?></strong>, 
                <strong id="gender"><?php echo $gender; ?></strong>, born on 
                <strong id="birthDate"><?php echo $birthDate; ?></strong>, at <strong id="birthPlace"><?php echo $birthPlace; ?></strong>, 
                is a bonafide resident of Barangay 8, Bacolod City.<br><br>
                This certification is issued upon the request of the above-named person for 
                <strong id="purposeField"><?php echo $purpose; ?></strong> and for whatever lawful purpose/s it may serve best.<br><br>
                Issued this <strong id="dateOfIssuance"><?php echo $dateOfIssuance; ?></strong> at Barangay 8, Bacolod City, Philippines.<br><br><br><br>
               
                
                <?php if (!empty($incharge) && $incharge !== '________________________') { ?>
                    <strong id='incharge'><?php echo $incharge; ?></strong><br>
                    Officer In Charge
                    <br> <br> <br>
                <?php } ?>

                <strong id='punongBarangayName'></strong><br>
                Punong Barangay
                </p>
            </div>
            <?php
            }
        ?>

    <!-- Footer -->
    <footer class="footer" style="padding-right:20px">
        <span>Official Receipt No.: <strong id="orField"><?php echo $or_number; ?></strong></span>
    </footer>

</body>
</html>
