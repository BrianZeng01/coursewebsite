<?php
echo '
<div class="nav">
    <div class="mainNav">
        <a href="../html/ubc.html">Home</a>
        <a href="../php/subjects.php">Courses</a>
        <a href="../html/contactus.html">Contact Us</a>
        <a id="account" href="../php/account.php">Account</a>
        <div id="login">
            <div id="signin" class="g-signin2" data-onsuccess="onSignIn"></div>
        </div>
        <div id="logout">
            <a id="signout" href="#" onclick="signOut(); loggedIn();">Sign out</a>
        </div>
    </div>
</div>

';
