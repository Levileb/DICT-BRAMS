<style>
        /* navbar-styles.css */

        .custom-navbar {
            background-color: #117A3C; /* Custom green */
            padding: 0.5rem 0;
            width: 100%;
            margin-bottom: 2%; 
        }

        .nav-container {
            display: flex;
            flex-direction: column; /* Stack items vertically */
            align-items: center; /* Center all items horizontally */
            justify-content: center; /* Center items vertically */
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
            gap: 1rem; /* Space between elements */
        }

        /* Hamburger stays aligned to the left */
        .hamburger {
            align-self: flex-start; /* Align hamburger to the left */
            display: none; 
            flex-direction: column;
            justify-content: space-between;
            width: 30px;
            height: 24px;
            cursor: pointer;
        }

        .hamburger .line {
            background-color: #D4EDDA; 
            height: 3px;
            border-radius: 2px;
            transition: transform 0.3s, opacity 0.3s;
        }

        .hamburger.active .line:nth-child(1) {
            transform: translateY(10px) rotate(45deg);
        }

        .hamburger.active .line:nth-child(2) {
            opacity: 0; 
        }

        .hamburger.active .line:nth-child(3) {
            transform: translateY(-10px) rotate(-45deg);
        }

        /* Navbar Links */
        .nav-links {
            display: flex;
            flex-direction: row; /* Horizontal on large screens */
            gap: 2rem; /* Space between links */
            justify-content: center; /* Center links horizontally */
            align-items: center; /* Center links vertically */
            transition: all 0.3s ease-in-out;
        }

        .nav-link {
            font-size: 1.25rem;
            color: #D4EDDA; 
            text-decoration: none;
            padding: 0.5rem 1rem; 
            border-radius: 0.25rem; 
            transition: background-color 0.3s, color 0.3s;
            white-space: nowrap;
            user-select: none; 
            cursor: pointer; 
        }

        .nav-link:hover {
            background-color: #A7F3D0; 
            color: #065F46; 
        }

        @media (max-width: 768px) {
            .hamburger {
                display: flex; 
            }

            .nav-links {
                display: none;
                flex-direction: column; /* Stack links vertically */
                width: 100%; 
                text-align: center;
                gap: 1rem;
            }

            .nav-link {
                font-size: 1rem;
                padding: 0.5rem 0.75rem;
            }
        }

        @media (max-width: 480px) {
            .nav-link {
                font-size: 0.875rem; 
                padding: 0.5rem;
            }
        }

        .dropdown {
                    position: relative;
                    display: inline-block;
                }

                .dropdown-content {
                    display: none;
                    position: absolute;
                    background-color: #117A3C;
                    min-width: 160px;
                    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                    z-index: 1;
                    flex-direction: column;
                }

                .dropdown:hover .dropdown-content {
                    display: flex;
                }

                .dropdown-content .nav-link {
                    color: #D4EDDA;
                    padding: 12px 16px;
                    text-decoration: none;
                    display: block;
                }

                .dropdown-content .nav-link:hover {
                    background-color: #A7F3D0;
                    color: #065F46;
                }
    </style>

    <div class="custom-navbar">
        <div class="nav-container">
            <!-- Hamburger Icon -->
            <div class="hamburger" onclick="toggleMenu()">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>

            <!-- Navbar Links -->
            <div class="nav-links" id="navLinks">
                <a href="admin-dashboard.php" class="nav-link">Dashboard</a>
                <a href="activity-logs.php" class="nav-link">Activity Logs</a>
                <a href="officials-edit.php" class="nav-link">Officials Edit</a>
                <a href="print-counter.php" class="nav-link">Print Counter</a>
                <a href="archived-resident.php" class="nav-link">Archived Resident</a>
            <div class="nav-link dropdown">
                <span>User</span>
                <div class="dropdown-content">
                    <a href="user-list.php" class="nav-link">List</a>
                    <a href="user-register.php" class="nav-link">Registration</a>
                </div>
            </div>
            </div>
        </div>
    </div>

    <script>
        function toggleMenu() {
            const navLinks = document.getElementById("navLinks");
            const hamburger = document.querySelector(".hamburger");

            // Toggle visibility of the nav-links
            if (navLinks.style.display === "flex") {
                navLinks.style.display = "none";
            } else {
                navLinks.style.display = "flex";
            }

            // Toggle hamburger icon animation
            hamburger.classList.toggle("active");
        }

        // Ensure links are visible on large screens and hidden on small screens
        function handleResize() {
            const navLinks = document.getElementById("navLinks");

            if (window.innerWidth >= 768) {
                navLinks.style.display = "flex"; // Always visible on large screens
            } else if (!document.querySelector(".hamburger.active")) {
                navLinks.style.display = "none"; // Hidden by default on small screens
            }
        }

        // Listen for window resize events
        window.addEventListener("resize", handleResize);

        // Run once on page load to set the correct display state
        handleResize();
    </script>