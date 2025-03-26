<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay ID Form</title>
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-database.js"></script>
    <script src="ID_print.js"></script>
    <link rel="stylesheet" href="ID_Print.css">
</head>
<body>
    <div class="id-container">
        <!-- Front Side -->
        <div class="id-card">

            <div class="header">REPUBLIC OF THE PHILIPPINES<br>Office of Sangguniang Barangay
                <br>BARANGAY 8
                <br>Bacolod City
                <div class="id_header">IDENTIFICATION CARD</div>
                <div class="picture-box"></div>
                <div class="custom-form">
                    <p>ID Number: 12321312312312312 </p>
                    <p>Last Name: sdasdasdasdasd</p>
                    <p>First Name: sdasdasdasd</p> 
                    <p>Middle Name: sdasdasdasd</p> 
                    <div class="blue-box">
                        <img src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="">
                    </div>
                </div>
            </div>
    
            <div class="row">
                <p>Issued:</p>
                <p id="issued"></p>
                <p class="exp">Expires:</p>   <p id="expire"></p>
            </div>
            <div class="signature">SIGNATURE</div>
    
            <img src="elements/Barangay_8_Logo.png" alt="logo" class="photo">
        </div>

        <!-- Back Side -->
        <div class="id-card id-card-back">
    <div class="background-logo"></div>

    <div class="form-group">
        <label>Address :</label>
        <div class="rounded-input"></div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label>Gender:</label>
            <div class="small-rounded"></div>
        </div>
        <div class="form-group">
            <label>Blood Type:</label>
            <div class="small-rounded"></div>
        </div>
        <div class="form-group">
            <label>Birthday:</label>
            <div class="small-rounded"></div>
        </div>
    </div>

    <div class="form-group">
        <label>In case of emergency pls notify :</label>
        <div class="rounded-input"></div>
    </div>

    <div class="captain-name">
        <p>Evelyn F. Donesa</p>
        <p class="position">BARANGAY CAPTAIN</p>
    </div>
</div>

</div>
</body>