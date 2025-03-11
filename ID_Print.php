<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baranggay ID Form</title>
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-database.js"></script>
</head>

<style>
  body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .id-container {
            display: flex;
            gap: 2rem;
        }
        .id-card {
            width: 300px;
            height: 500px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            padding: 20px;
            border: 2px solid #333;
            position: relative;
        }
        .header {
            font-size: 14px;
            font-weight: bold;
        }
        .photo {
            width: 100px;
            height: 100px;
           
            margin: 10px auto;
            display: block;
           float: right;
            
        }
        .photo2 {
            width: 100px;
            height: 100px;
          
            margin: 10px auto;
            display: block;
           float: left;
            
        }
        .details {
            text-align: left;
            font-size: 14px;
            margin-top: 10px;
        }
        .details div {
            margin-bottom: 5px;
            background: #f4f4f4;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;

        }
        .barcode {
            width: 100%;
            height: 40px;
            background: black;
            margin-top: 10px;
        }
        .signature-box {
            border-top: 1px solid black;
            width: 80%;
            margin: 20px auto 0;
            font-size: 14px;
            text-align: center;
        }
        .back {
            font-size: 12px;
            text-align: center;
            padding: 20px;
        }
        .back .signature {
            margin-top: 30px;
            text-align: center;
        }
        .id-card input [type="text"],
        .id-card input [type="date"],
        .id-card input [type="file"] {
        
            width: 100%;
            padding: 10px;
            margin-left:-1rem;
            margin-right: -1rem;
            margin-bottom: 15px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none; 
            
          
        }	
    </style>
</head>
<body>
    <div class="id-container">
        <!-- Front Side -->
        <div class="id-card">
            <div class="header">REPUBLIC OF THE PHILIPPINES<br>BARANGAY MARIKINA HEIGHTS</div>
            <img src="ts.jpg" alt="Profile Picture" class="photo">
            <img src="Includes/background/dict.png" alt="logo" class="photo2">
        <form>
        <input type="text" placeholder="Full Name" required>
            <input type="text" placeholder="Address" required>
            <input type="date" placeholder="Birthdate" required>
                </form>
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
