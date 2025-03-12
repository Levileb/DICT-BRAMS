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
            <div class="header">REPUBLIC OF THE PHILIPPINES<br>Province of Negros<br>BARANGGAY 8<br>BARANGGAY IDENTIFICATION CARD</div>
            <div class="picture-box"></div>
            <img src="Includes/background/dict.png" alt="logo" class="photo">

            <div class="custom-form">
                <p> 
                Name: <strong id="residentName"><?php echo $name?></strong> <br>
                Date of Birth: <strong id="birthDate"><?php echo $birthDate?></strong><br>
                Adress:  <strong> Branggay 8 Bacolod </strong> 
            </div>
            </div>
           
        <!-- Back Side -->
        <div class="id-card back">
            <p>Holder is a bonafide constituent of this barangay and is entitled to all privileges and services holder may require.</p>
            <p>If found, please return to the Barangay Secretary, Marikina Heights Barangay Hall, Marikina City.</p>
            <div class="signature">Your Signature</div>
            <div class="signature-box">Conforme</div>
            <p><strong>HON. JUAN BARTOLATA</strong><br>Barangay Chairman</p>
        </div>
    </div>
</body>
</html>