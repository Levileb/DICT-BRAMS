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
        <title>Barangay Document</title>
</head>

<body>
<div class="id-card">
        
<div class="id-front">
        
        <div class="blue-border">
                <div class="left-panel">
                        <div class="src">
                                <img id="logo-bacolod" class="bcld" src="logos/bacolod.png" alt="bacolod">
                                <img id="logo-dilg" class="dilg" src="logos/dilg-logo.png" alt="dilg">
                                <img id="logo-barangay" class="b8" src="logos/Barangay-8.jpg" alt="dilg">
                        </div>
                        <div class="txt">
                                <h1 id="tanod-t" class="tnd">T</h1>
                                <h1 id="tanod-a" class="tnd">A</h1>
                                <h1 id="tanod-n" class="tnd">N</h1>
                                <h1 id="tanod-o" class="tnd">O</h1>
                                <h1 id="tanod-d" class="tnd">D</h1>
                        </div>
                </div>
                <div class="right-panel">
                         <div class="header">
                                <p id="republic-info" class="r-ph">
                                        Republic of the Philippines
                                        <br>
                                        City of Bacolod
                                        <br>
                                        Barangay 8
                                        <br>
                                </p>

                                <p id="personnel-title" class="personnel">
                                        BARANGAY TANOD
                                </p>
                         </div>   
                         <div id="profile-image" class="image">

                         </div>
                         <div class="name">
                                <p id="fullname" class="fullname">
                                   JUAN DE LA CRUZ
                                </p>
                                <div class="line">
                                <p id="position">
                                BARANGAY TANOD MEMBER
                                </p>
                                </div>
                           
                         </div>
                         <div class="signature">
                                   
                         <div class="line">
                         <p id="signature-label">
                                CARD HOLDER SIGNATURE
                        </p>
                        </div>
                        
                         </div>
                         <div class="id-num">
                                <p id="id-number">
                                        BC-123
                                </p>
                         </div>
                </div>
                
        </div>

  
</div> 

<div class="id-card-back">
        <div class="blue-border">
                <div class="contents">
                        <div class="info">
                                <div class="info-1">
                                                <div id="address-label" class="address">
                                                                ADDRESS: 
                                                </div>
                                                <div id="address" class="box-1">
                                                                Lambaunao, Iloilo
                                                </div>
                                </div>
                                <div class="info-2">
                                                <div id="contact-label" class="contactno">
                                                                CONTACT#: 
                                                </div>
                                                <div id="contact" class="box-1">
                                                                Lambaunao, Iloilo
                                                </div>
                                </div>
                                <div class="info-3">
                                                <div id="gender-label" class="gender">
                                                        GENDER:
                                                </div>
                                                <div id="gender" class="box-2">
                                                        MALE
                                                </div>
                                                <div id="blood-type-label" class="bt">
                                                        BLOOD <br> TYPE:
                                                </div>
                                                <div id="blood-type" class="box-2">
                                                        MALE
                                                </div>
                                </div>
                                <div class="info-4">
                                                <div id="dob-label" class="dob">
                                                                DATE OF BIRTH:
                                                </div>
                                                <div id="dob" class="box-1">
                                                                Lambaunao, Iloilo
                                                </div>
                                </div>
                                <div class="info-5">
                                                <div id="pob-label" class="dob">
                                                                PLACE OF BIRTH:
                                                </div>
                                                <div id="pob" class="box-1">
                                                                Lambaunao, Iloilo
                                                </div>
                                </div>
                                <div class="info-6">
                                                <div id="emergency-label" class="em">
                                                          INCASE OF EMERGENCY, PLEASE NOTIFY:
                                                </div>
                                                <div id="emergency-contact" class="box-3">
                                                                MOTHER EARTH
                                                </div>
                                </div>
                                <div class="info-7">
                                                <div id="b-name" class="bname">
                                                          BARANGAY CAPTAIN NAME
                                                </div>
                                                <div id="captain-name-value" class="box-4">
                                                                PUNONG BARANGAY
                                                </div>
                                </div>
                        </div>
        </div>

</div>



</div>


</body>

</html> 
