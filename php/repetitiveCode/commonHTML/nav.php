<?php
echo '
<div class="nav">
    <a id="home" href="../index.html">Home</a>
    <a id="courses"href="../php/subjects.php">Courses</a>
    <a id="contactus" href="../html/contactus.html">Contact Us</a>
    <a id="account" class="account" href="../php/account.php">Account</a>
    <div id="login" onclick="loginDropdown()" class="dropdown">
    Sign In
        <div id="loginDropdown" class="dropdown-content">
            <div
            id="signin"
            class="g-signin2"
            data-onsuccess="onSignIn"
            ></div>
            <div>
                <fb:login-button
                    class="fb-signin"
                    scope="public_profile,email"
                    onlogin="checkLoginState();"
                >
                </fb:login-button>
            </div>
        </div>
    </div>
    <div id="logout">
    <a id="signout" href="#" onclick="signOut();">Sign Out</a>
    </div>   


</div>

';
