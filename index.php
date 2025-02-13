<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B.R.A.M.S</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Includes/index.css">
    <style>
        #floating-message {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0, 128, 0, 0.8);
            color: white;
            padding: 15px 25px;
            border-radius: 5px;
            font-size: 16px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: none;
            z-index: 1000;
            animation: fadeInOut 5s ease-in-out forwards;
        }

        @keyframes fadeInOut {
            0% { opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { opacity: 0; }
        }
    </style>
    <script type="module">
    import { initializeApp } from "https://www.gstatic.com/firebasejs/9.1.0/firebase-app.js";
    import { getAuth, signInWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/9.1.0/firebase-auth.js";
    import { getDatabase, ref, push, child, get } from "https://www.gstatic.com/firebasejs/9.1.0/firebase-database.js";

    const firebaseConfig = {
        apiKey: "AIzaSyBiT-xjXZpVOUjxCtbMG-LpfdHaUdHDOSg",
        authDomain: "brams-3dfd3.firebaseapp.com",
        databaseURL: "https://brams-3dfd3-default-rtdb.firebaseio.com/",
        projectId: "brams-3dfd3",
        storageBucket: "brams-3dfd3.firebasestorage.app",
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

    function setCookie(name, value, days) {
        let expires = "";
        if (days) {
            const date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    document.addEventListener('DOMContentLoaded', function() {
        const loginButton = document.getElementById('loginButton');
        const loginForm = document.getElementById('loginForm');

        function handleLogin() {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const selectedRole = document.querySelector('input[name="role"]:checked').value;

            signInWithEmailAndPassword(auth, email, password)
                .then(userCredential => {
                    const userId = userCredential.user.uid;
                    const dbRef = ref(database);
                    get(child(dbRef, `Users/${userId}/role`))
                        .then((snapshot) => {
                            if (snapshot.exists()) {
                                const userRole = snapshot.val();
                                if (userRole === selectedRole) {
                                    setCookie('email', email, 7); // Cookie expires in 7 days
                                    setCookie('role', userRole, 7);
                                    showFloatingMessage(`Welcome ${userRole === 'admin' ? 'Admin' : 'User'}, ${email}`);

                                    // Log the login action with Philippines time zone
                                    const logRef = ref(database, 'Logs');
                                    const philippineTime = new Date().toLocaleString('en-PH', { timeZone: 'Asia/Manila' });
                                    push(logRef, {
                                        action: 'login',
                                        user: email,
                                        role: selectedRole,
                                        timestamp: philippineTime
                                    });

                                    setTimeout(() => {
                                        if (userRole === 'admin') {
                                            window.location.href = 'admin-dashboard.php';
                                        } else if (userRole === 'user') {
                                            window.location.href = 'dashboard.php';
                                        }
                                    }, 2500);
                                } else {
                                    showFloatingMessage('Role mismatch. Please select the correct role.');
                                }
                            } else {
                                showFloatingMessage('Role not found for this user.');
                            }
                        })
                        .catch((error) => {
                            showFloatingMessage('Error fetching role: ' + error.message);
                        });
                })
                .catch(error => {
                    showFloatingMessage(error.message);
                });
        }

        loginButton.addEventListener('click', handleLogin);
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault();
            handleLogin();
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                handleLogin();
            }
        });
    });
    </script>
</head>
<body>
    <!-- Floating message container -->
    <div id="floating-message"></div>
    <div class="min-h-screen flex items-center justify-center">
        <div class="w-full max-w-md">
            <form id="loginForm" class="bg-white shadow-md rounded-xl card px-8 pt-6 pb-8 mb-4 transition-transform duration-700 ease-in-out hover:scale-105 hover:shadow-2xl">
                <h2 class="text-4xl mb-6 text-center text-gray-800 font-bold animate-fadeInUp">Welcome ka B.R.A.M.S</h2>
                <div class="mb-4 animate-fadeInUp delay-200">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input type="email" id="email" required autocomplete="email" class="input-field shadow appearance-none border rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-300 focus:ring-opacity-50 transition-transform duration-500 ease-in-out hover:scale-105">
                </div>
                <div class="mb-6 animate-fadeInUp delay-400">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    <input type="password" id="password" required autocomplete="current-password" class="input-field shadow appearance-none border rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-300 focus:ring-opacity-50 transition-transform duration-500 ease-in-out hover:scale-105">
                </div>
                <div class="mb-4 animate-fadeInUp delay-600">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Login as:</label>
                    <label class="inline-flex items-center mr-4">
                        <input type="radio" name="role" value="user" checked>
                        <span class="ml-2">User</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="role" value="admin">
                        <span class="ml-2">Admin</span>
                    </label>
                </div>
                <div class="flex items-center justify-between animate-fadeInUp delay-800">
                    <button type="button" id="loginButton" class="loginButton text-white font-bold py-2 px-6 rounded-full bg-gradient-to-r from-green-400 to-green-500 focus:outline-none focus:ring-2 focus:ring-green-300 transition-transform duration-500 ease-in-out hover:scale-110">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
