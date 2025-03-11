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
            gap: 3rem;
        }
        .id-container {
            display: flex;
            
        }
        .id-card {
            width: 300px;
            height: 500px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgb(36, 81, 23);
            text-align: center;
            padding: 20px;
            border: 1px solid  rgb(36, 81, 23);
            position: relative;
        }
        .header {
            font-size: 14px;
            font-weight: bold;
            margin-top: 1rem;
            font-family: Arial, Helvetica, sans-serif;
            gap: 2rem;
        }
        .picture-box {
            float: right;
            width: 10rem;
            border: 1px solid gray;
            height: 10rem; 
            margin-top: 3rem;
            margin-bottom: 3rem; 
            margin-right: 1rem;

        }
        .photo {
            width: 5rem;
            height: 5rem;
            margin-top: 5rem;
            margin-left: 1rem;
            display: block;
           float: left;
            
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
        .custom-form {
            display: flex;
            flex-direction: column;
            gap: 2px; /* Adds spacing between inputs */
            width: 250px; /* Adjust width */
            height: 20px;
            margin: 20px auto;
        }
        input {
            width: 100%;
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            outline: none;
            margin: auto 0;
            align-items: center;
            font-family: Arial, Helvetica, sans-serif;
          
}
        
    </style>
</head>
<body>
    <div class="id-container">
        <!-- Front Side -->
        <div class="id-card">
            <div class="header">REPUBLIC OF THE PHILIPPINES<br>Province of Negros<br>BARANGGAY 8<br>BARANGGAY IDENTIFICATION CARD</div>
            <div class="picture-box"></div>
            <img src="Includes/background/dict.png" alt="logo" class="photo">
       
        <form class="custom-form">
            <input type="text" placeholder="Full Name" required><br>
            <input type="text" placeholder="Address" required><br>
            <input type="date" placeholder="Birthdate" required><br>
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