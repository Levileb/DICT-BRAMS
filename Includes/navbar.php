<style>
.custom-bar {
    background-color: #117A3C;
    padding: 0.5rem 0;
    width: 100%;
    margin-bottom: 2%;
    position: relative;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    z-index: 1000;
}



.-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
    gap: 1rem;
}

.hamburger {
    align-self: flex-start;
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

.-links {
    display: flex;
    flex-direction: row;
    gap: 2rem;
    justify-content: center;
    align-items: center;
    transition: all 0.3s ease-in-out;
}

.-link {
    font-size: 1.25rem;
    color: rgb(236, 250, 252);
    text-decoration: none;
    padding: 0.5rem 1rem;
    border-radius: 0.25rem;
    transition: background-color 0.3s, color 0.3s;
    white-space: nowrap;
    user-select: none;
    cursor: pointer;
}

.-link:hover, .-link.active {
    background-color: rgb(128, 242, 189);
    color: #065F46;
}

@media (max-width: 768px) {
    .hamburger {
        display: flex;
    }

    .-links {
        display: none;
        flex-direction: column;
        width: 100%;
        text-align: center;
        gap: 1rem;
    }

    .-link {
        font-size: 1rem;
        padding: 0.5rem 0.75rem;
    }
}

@media (max-width: 480px) {
    .-link {
        font-size: 0.875rem;
        padding: 0.5rem;
    }

}
.-link:hover, .-link.active {
    background-color: rgb(101, 182, 144);
    color: #065F46;
}

/* Change active button color when hovering over other buttons */
.-links:hover .-link.active {
    background-color: rgb(130, 222, 176);
    /* Slightly lighter color */
}
</style>

<div class="custom-bar">
    <div class="-container">
        <div class="hamburger" onclick="toggleMenu()">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>

        <div class="-links" id="Links">
            <a href="dashboard.php" class="-link">HOME</a>
            <a href="registration_form.php" class="-link">REGISTRATION FORM</a>
            <a href="household_form.php" class="-link">HOUSEHOLD FORM</a>
            <a href="resident_list.php" class="-link">LIST OF RESIDENTS</a>
            <a href="household_profile.php" class="-link">HOUSEHOLD PROFILE</a>
        </div>
    </div>
</div>

<script>
function toggleMenu() {
    const Links = document.getElementById("Links");
    const hamburger = document.querySelector(".hamburger");

    if (Links.style.display === "flex") {
        Links.style.display = "none";
    } else {
        Links.style.display = "flex";
    }

    hamburger.classList.toggle("active");
}

function handleResize() {
    const Links = document.getElementById("Links");

    if (window.innerWidth >= 768) {
        Links.style.display = "flex";
    } else if (!document.querySelector(".hamburger.active")) {
        Links.style.display = "none";
    }
}

function highlightActiveLink() {
    const links = document.querySelectorAll(".-link");
    const currentURL = window.location.href;

    links.forEach(link => {
        if (link.href === currentURL) {
            link.classList.add("active");
        } else {
            link.classList.remove("active");
        }
    });
}

window.addEventListener("resize", handleResize);
window.addEventListener("load", highlightActiveLink);
</script>