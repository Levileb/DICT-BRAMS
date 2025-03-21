
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baranggay ID Form</title>
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-database.js"></script>
    <script src="ID_Print.js" ></script>
    <link rel="stylesheet" href="ID_Print.css">
</head>
<body>
<?php
$resident_id = $_GET['id'] ?? '1';


 $name = "________________________";
 $birthDate = "________________";
?>

<script>
     var fullname = <?php echo json_encode($name); ?>;
</script>

<input type="hidden" id="residentId" value="<?php echo $resident_id; ?>">
    <div class="id-container">
        <div class="contents">
        <!-- Front Side -->
            <div class="id-card">
            <div class="header">REPUBLIC OF THE PHILIPPINES<br>Province of Negros<br>BARANGGAY 8</div>
            <H4>BARANGGAY IDENTICATION CARD</H4>
            <div class="picture-box"></div>
            <img src="Includes/background/dict.png" alt="logo" class="photo">

            <div class="custom-form">
                <H3><strong id="residentName"><?php echo $name?></strong></p></H3>
                <hr class="divider">
                <p><strong id="birthDate"><?php echo $birthDate?></strong><br></p>
                <p><strong id="address">BARANGGAY 8 BACOLOD</strong></p>
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