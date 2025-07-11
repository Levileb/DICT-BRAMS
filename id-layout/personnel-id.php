<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="personnel-id.css"> <!-- External CSS -->
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
    <script defer src="personnel-id.js"></script>
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
    <title>Barangay Document</title>
</head>

<body>
<div class="navigation-buttons no-print">
            <button onclick="window.history.back()" class="btn btn-secondary" style="position: absolute; top: 10px; left: 10px;">Back</button>
            <button onclick="window.print()" class="btn btn-primary" style="position: absolute; top: 10px; right: 10px;">Print</button>
        </div>
    <div class="id-card">
        <div class="id-front">
            <div class="blue-border">
                <div class="left-panel">
                    <div class="src">
                        <img class="bcld" src="logos/bacolod.png" alt="bacolod">
                        <img class="dilg" src="logos/dilg-logo.png" alt="dilg">
                        <img class="b8" src="logos/Barangay-8.jpg" alt="dilg">
                    </div>
                    <div class="txt">
                        <h1 class="bhw">B</h1><p>Barangay</p>
                        <h1 class="bhw">H</h1><p>Health</p>
                        <h1 class="bhw">W</h1><p>Worker</p>
                    </div>
                </div>
                <div class="right-panel">
                    <div class="header">
                        <p class="r-ph">
                            Republic of the Philippines <br>
                            City of Bacolod <br>
                            Barangay 8
                        </p>
                        <p class="personnel">BARANGAY PERSONNEL</p>
                    </div>   
                    <div class="image">
                        <img id="profile-img" src="default-profile.png" alt="Profile Image">
                    </div>
                    <div class="name">
                        <p class="fullname" id="fullname">LOADING....</p>
                        <div class="line">
                            <p id="position">BARANGAY HEALTH WORKER</p>
                        </div>
                    </div>
                    <div class="signature">
                        <div class="line">
                            <p>CARD HOLDER SIGNATURE</p>
                        </div>
                    </div>
                    <div class="id-num">
                        <p id="id-number">LOADING....</p>
                    </div>
                </div>
            </div>
        </div> 

        <div class="id-card-back">
            <div class="blue-border">
                <div class="contents">
                    <div class="info">
                        <div class="info-1">
                            <div class="address">ADDRESS:</div>
                            <div class="box-1" id="address">LOADING....</div>
                        </div>
                        <div class="info-2">
                            <div class="contactno">CONTACT#:</div>
                            <div class="box-1" id="contact">LOADING....</div>
                        </div>
                        <div class="info-3">
                            <div class="gender">GENDER:</div>
                            <div class="box-2" id="gender">LOADING....</div>
                            <div class="bt">BLOOD <br> TYPE:</div>
                            <div class="box-2" id="blood-type">LOADING....</div>
                        </div>
                        <div class="info-4">
                            <div class="dob">DATE OF BIRTH:</div>
                            <div class="box-1" id="dob">LOADING....</div>
                        </div>
                        <div class="info-5">
                            <div class="dob">PLACE OF BIRTH:</div>
                            <div class="box-1" id="pob">LOADING....</div>
                        </div>
                        <div class="info-6">
                            <div class="em">IN CASE OF EMERGENCY, PLEASE NOTIFY:</div>
                            <div class="box-3" id="emergency-contact">LOADING....</div>
                        </div>
                        <div class="info-7">
                            <div class="bname" id="b-name">LOADING....</div>
                            <div class="box-4" id="brgy-captain">PUNONG BARANGAY</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>

    <script>
   
    </script>
</body>
</html>
