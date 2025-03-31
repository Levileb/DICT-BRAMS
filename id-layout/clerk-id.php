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
        <div class="navigation-buttons">
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
                <p>Barangay</p>
                <h1 class="tnd">C</h1>
                <h1 class="tnd">L</h1>
                <h1 class="tnd">E</h1>
                <h1 class="tnd">R</h1>
                <h1 class="tnd">K</h1>
            </div>
        </div>
        <div class="right-panel">
             <div class="header">
                <p class="r-ph">
                    Republic of the Philippines
                    <br>
                    City of Bacolod
                    <br>
                    Barangay 8
                    <br>
                </p>

                <p class="personnel">
                    BARANGAY PERSONNEL
                </p>
             </div>   
             <div class="image">

             </div>
             <div class="name">
                <p id="fullname"  class="fullname">
                LOADING....
                </p>
                <div class="line">
                <p>
                BARANGAY TANOD MEMBER
                </p>
                </div>
               
             </div>
             <div class="signature">
                   
             <div class="line">
             <p>
                CARD HOLDER SIGNATURE
            </p>
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
                        <div class="address">
                                ADDRESS: 
                        </div>
                        <div id="address"  class="box-1">
                        LOADING....
                        </div>
                </div>
                <div class="info-2">
                        <div class="contactno">
                                CONTACT#: 
                        </div>
                        <div id="contact" class="box-1">
                        LOADING....
                        </div>
                </div>
                <div class="info-3">
                        <div class="gender">
                            GENDER:
                        </div>
                        <div  id="gender"  class="box-2">
                        LOADING....
                        </div>
                        <div class="bt">
                            BLOOD <br> TYPE:
                        </div>
                        <div  id="blood-type" class="box-2">
                        LOADING....
                        </div>
                </div>
                <div class="info-4">
                        <div class="dob">
                                DATE OF BIRTH:
                        </div>
                        <div  id="dob" class="box-1">
                        LOADING....
                        </div>
                </div>
                <div class="info-5">
                        <div class="dob">
                                PLACE OF BIRTH:
                        </div>
                        <div  id="pob" class="box-1">
                        LOADING....
                        </div>
                </div>
                <div class="info-6">
                        <div class="em">
                              INCASE OF EMERGENCY, PLEASE NOTIFY:
                        </div>
                        <div  id="emergency-contact"  class="box-3">
                        LOADING....
                        </div>
                </div>
                <div class="info-7">
                        <div  id="b-name"  class="bname">
                        LOADING....
                        </div>
                        <div class="box-4">
                                PUNONG BARANGAY
                        </div>
                </div>
            </div>
    </div>

</div>



</div>


</body>

</html> 
