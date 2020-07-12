<?php
echo '
<div class="nav">
    <div class="mainNav">
        <a class="home" href="../html/ubc.html">Home</a>
        <a class="courses"href="../php/subjects.php">Courses</a>
        <a class="contactus" href="../html/contactus.html">Contact Us</a>
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
