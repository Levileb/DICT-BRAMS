<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BRAMS - ADMIN</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
    <!-- <script src="user-create.js"></script>  -->
    <link rel="stylesheet" href="user-register.css">

</head>

<body class="bg-gray-100">
    <?php include 'Includes/header.php'; ?>
    <?php include_once 'Includes/admin-navbar.php'; ?>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BRAMS - ADMIN</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
        <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-auth.js"></script>
        <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
        <!-- <script src="user-create.js"></script>  -->
        <link rel="stylesheet" href="user-register.css">

    </head>


    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center">Register a User</h2>
            <form action="user-register.php" method="POST" class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                    <input type="email" name="email" id="email" class="input-field">
                </div>
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700">First Name:</label>
                    <input type="text" name="first_name" id="first_name" class="input-field">
                </div>
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name:</label>
                    <input type="text" name="last_name" id="last_name" class="input-field">
                </div>
                <div>
                    <label for="nickname" class="block text-sm font-medium text-gray-700">Nickname:</label>
                    <input type="text" name="nickname" id="nickname" class="input-field">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
                    <input type="password" name="password" id="password" class="input-field">
                </div>
                <div>
                    <input type="submit" value="submit" class="submit-button">
                </div>
            </form>
        </div>
    </div>
    </div>
    <?php include 'Includes/footer.php'; ?>\


    <script>
    document.querySelector('form').addEventListener('submit', function(event) {
        event.preventDefault();

        const email = document.getElementById('email').value;
        const firstName = document.getElementById('first_name').value;
        const lastName = document.getElementById('last_name').value;
        const nickname = document.getElementById('nickname').value;
        const password = document.getElementById('password').value;

        if (!firebase.apps.length) {
            firebase.initializeApp({
                apiKey: "AIzaSyBiT-xjXZpVOUjxCtbMG-LpfdHaUdHDOSg",
                authDomain: "brams-3dfd3.firebaseapp.com",
                databaseURL: "https://brams-3dfd3-default-rtdb.firebaseio.com/",
                projectId: "brams-3dfd3",
                storageBucket: "brams-3dfd3.appspot.com",
                messagingSenderId: "301528550722",
                appId: "1:301528550722:web:9724e3029567a64c904cdb",
            });

            console.log("Firebase initialized.");
        } else {
            console.log("Firebase already initialized.");
        }

        // Firebase services
        const database = firebase.database();
        const auth = firebase.auth();

        // Create user in Firebase Auth
        firebase.auth().createUserWithEmailAndPassword(email, password)
            .then((userCredential) => {
                var user = userCredential.user;

                // Save user data to Firebase Realtime Database
                firebase.database().ref('Users/' + user.uid).set({
                    first_name: firstName,
                    last_name: lastName,
                    nickname: nickname,
                    email: email,
                    role: 'user'
                });

                alert("User registered successfully!");
            })
            .catch((error) => {
                var errorCode = error.code;
                var errorMessage = error.message;
                alert('Error: ' + errorMessage);
            });

    });
    </script>
</body>

</html>