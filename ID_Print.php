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
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .id-card {
            width: 400px;
            background: #ffffff;
            border: 2px solid #117A3C;
            padding: 30px;
            
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(65, 54, 54, 0.2);
            text-align: center;
        }
        .id-card h2 {
            color:#117A3C;
            margin-bottom: 10px;
        }
        .id-card input[type="text"],
        .id-card input[type="date"],
        .id-card input[type="file"] {
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
        .id-card button {
            background:#117A3C;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .id-card button:hover {
            background:rgb(59, 63, 67);
        }
</style>

   <div class="container">
    <div class="id-card">
       <h2> Baranggay ID Form</h2>
        <form>
            <input type="text" placeholder="Full Name" required>
            <input type="text" placeholder="Address" required>
            <input type="date" placeholder="Birthdate" required>
            <input type="file" accept="image/*" required>
            <button type="submit">Generate ID</button>
        </form>


    </div>
    </div>
     
</body>
</html>