<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        #floating-message {
            display: none;
            position: fixed;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #f0ad4e;
            color: white;
            padding: 10px;
            border-radius: 5px;
            z-index: 1000;
        }
    </style>
</head>
<body>
    <div id="floating-message"></div>
    <form id="registerForm">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="registerEmail">Email:</label>
        <input type="email" id="registerEmail" name="registerEmail" required><br><br>
        
        <label for="registerPassword">Password:</label>
        <input type="password" id="registerPassword" name="registerPassword" required><br><br>
        
        <label>Role:</label>
        <input type="radio" id="roleUser" name="role" value="user" required>
        <label for="roleUser">User</label>
        <input type="radio" id="roleAdmin" name="role" value="admin" required>
        <label for="roleAdmin">Admin</label><br><br>
        
        <button type="button" id="registerButton">Register</button>
    </form>

    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/9.1.0/firebase-app.js";
        import { getAuth, createUserWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/9.1.0/firebase-auth.js";
        import { getDatabase, ref, set, push } from "https://www.gstatic.com/firebasejs/9.1.0/firebase-database.js";

        const firebaseConfig = {
            apiKey: "AIzaSyBiT-xjXZpVOUjxCtbMG-LpfdHaUdHDOSg",
            authDomain: "brams-3dfd3.firebaseapp.com",
            databaseURL: "https://brams-3dfd3-default-rtdb.firebaseio.com/",
            projectId: "brams-3dfd3",
            storageBucket: "brams-3dfd3.appspot.com",
            messagingSenderId: "301528550722",
            appId: "1:301528550722:web:9724e3029567a64c904cdb",
        };

        const app = initializeApp(firebaseConfig);
        const auth = getAuth(app);
        const database = getDatabase(app);

        function showFloatingMessage(message) {
            const messageBox = document.getElementById('floating-message');
            if (messageBox) {
                messageBox.innerText = message;
                messageBox.style.display = 'block';
                setTimeout(() => {
                    messageBox.style.display = 'none';
                }, 5000);
            } else {
                console.error('Floating message element not found.');
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('registerButton').addEventListener('click', function () {
                const email = document.getElementById('registerEmail').value;
                const password = document.getElementById('registerPassword').value;
                const selectedRole = document.querySelector('input[name="role"]:checked')?.value;
                const name = document.getElementById('name').value;

                if (!email || !password || !selectedRole || !name) {
                    showFloatingMessage('All fields are required!');
                    console.error('Validation Error: Missing required fields.');
                    return;
                }

                console.log('Attempting to create user:', email);

                createUserWithEmailAndPassword(auth, email, password)
                    .then(userCredential => {
                        console.log('User successfully registered:', userCredential.user);
                        const userId = userCredential.user.uid;

                        const userRef = ref(database, `Users/${userId}`);
                        set(userRef, { email, name, role: selectedRole })
                            .then(() => console.log('User data saved successfully.'))
                            .catch(err => console.error('Database save failed:', err));
                    })
                    .catch(err => console.error('Auth failed:', err));
            });
        });
    </script>
</body>
</html>
