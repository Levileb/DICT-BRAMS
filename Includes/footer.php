<style>
.footer-custom {
    margin-top: 5%;
    background-color: #117A3C;
    /* Green color */
    display: flex;
    align-items: center;
    justify-content: space-between;
    /* Align left and right */
    padding: 1rem;
    text-align: center;
    width: 100%;
    color: white;

}

.footer-container {
    display: flex;
    justify-content: space-between;
    width: 100%;
    align-items: center;
    position: fixed;
    bottom: 0;
    margin-top: auto;
    background-color: #117A3C;
    /* Green color */
    display: flex;
    align-items: center;
    justify-content: space-between;
    /* Align left and right */
    padding: 1rem;
    text-align: center;
    width: 100%;
    color: white;
    z-index: 1000;
}


.footer-links {
    display: flex;
    gap: 1.5rem;
    color: white
}

.footer-link:hover {
    color: lightgray;
}
</style>



<footer class="footer-container">
    <p class="text-sm m-0">&copy; 2024 Department of Information and Communications Technology. All Rights Reserved.
    </p>
    <div class="footer-links">
        <a href="#" class="footer-link">Privacy Policy</a>
        <a href="#" class="footer-link">Terms of Service</a>
        <a href="#" class="footer-link">Contact Us</a>
    </div>
</footer>