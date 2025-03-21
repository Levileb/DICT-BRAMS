
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baranggay ID Form</title>
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-database.js"></script>
    <script src="ID_print.js" ></script>
    <link rel="stylesheet" href="ID_Print.css">
</head>

</head>
<div>

    <div class="id-container">
        <!-- Front Side -->
        <div class="id-card">
            <div class="header">REPUBLIC OF THE PHILIPPINES<br>Office of Sangguniang Barangay
            <br>BARANGAY 8
            <br> Bacolod City
            
            <div class="id_header" > IDENTIFICATION CARD</div>
            <div class="picture-box"></div>
            <div class="custom-form">
                <label> ID Num.:</label>
                <label> Last Name: </label>
             <label> First Name:</label>   
            </div>
            <div class="md">Middle Name:</div>
            <div class="blue-box"></div>
    </div>
    <div class="row">
        <p>Issued:</p>
        <p class="exp">Expires:</p>  
    </div>
    <div class="signature">Signature</div>
    
  
                <img src="elements/Barangay_8_Logo.png" alt="logo" class="photo">

            </div>
            </div>
           
        </div>
        <!-- Back Side -->
      <!-- Back Side of the ID -->
<div class="id-card id-card-back">
    <div class="background-logo"></div>

    <div class="form-group">
        <label>Address :</label>
        <input type="text" class="rounded-input">
    </div>

    <div class="form-row">
        <div class="form-group">
            <label>Gender:</label>
            <input type="text" class="small-rounded">
        </div>
        <div class="form-group">
            <label>Blood Type:</label>
            <input type="text" class="small-rounded">
        </div>
        <div class="form-group">
            <label>Birthday:</label>
            <input type="text" class="small-rounded">
        </div>
    </div>

    <div class="form-group">
        <label>In case of emergency pls notify :</label>
        <input type="text" class="rounded-input">
    </div>

    <div class="captain-name">
        <p>Evelyn F. Donesa</p>
        <p class="position">BARANGAY CAPTAIN</p>
    </div>
</div>
</div>
    <div class="print-button">
        <button onclick="printID()">PRINT</button>	
    </div>
</body>
</html>