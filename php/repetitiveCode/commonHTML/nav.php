<div class="mainNav">
    <div class="nav-logo">
        <h1 style="color: white;">CourseCritics</h1>
    </div>

    <label for="nav-toggle" class="burger-menu">
        <i class="fas fa-bars fa-3x" style="color: white;"></i>
    </label>
    <input type="checkbox" id="nav-toggle" style="display: none;">

    <div class="links">
        <a id="home" href="../index.php">Home</a>
        <a id="courses" href="../php/subjects.php">Courses</a>
        <a id="contactus" href="../php/contactUs.php">Contact Us</a>
        <a id="account" class="account" href="../php/account.php">Account</a>

        <div id="login" onclick="loginDropdown()" class="dropdown">
            Sign In
            <div id="loginDropdown" class="dropdown-content">
                <div id="signin" class="g-signin2" data-onsuccess="onSignIn"></div>
                <div>
                    <fb:login-button class="fb-signin" scope="public_profile,email" onlogin="checkLoginState();">
                    </fb:login-button>
                </div>
            </div>
        </div>
        <div id="logout">
            <a id="signout" href="#" onclick="signOut();">Sign Out</a>
        </div>
    </div>
</div>