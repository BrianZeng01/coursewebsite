<?php
echo '
<div class="nav">
    <div class="mainNav">
        <a id="home" href="../index.html">Home</a>
        <a id="courses"href="../php/subjects.php">Courses</a>
        <a id="contactus" href="../html/contactus.html">Contact Us</a>
        <a id="account" class="account" href="../php/account.php">Account</a>
        <div id="login">
            <div id="signin" class="g-signin2" data-onsuccess="onSignIn"></div>
        </div>
        <div id="logout">
            <a id="signout" href="#" onclick="signOut(); loggedIn();">Sign out</a>
        </div>
    </div>
</div>

';
