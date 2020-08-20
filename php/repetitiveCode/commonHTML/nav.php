<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v7.0"
    nonce="uBVAfhzg"></script>
<div class="mainNav">
    <div class="nav-logo">
        <h1 style="color: white;">CourseCritics</h1>
    </div>


    <label for="nav-toggle" class="burger-menu">
        <i class="fas fa-bars fa-3x" style="color: white;"></i>
    </label>
    <input type="checkbox" id="nav-toggle" style="display: none;">

    <div class="links">

        <div class="pages">
            <div><a id="home" href="../index.php">Home</a></div>
            <div><a id="courses" href="../php/subjects.php">Courses</a></div>
            <div><a id="contactUs" href="../php/contactUs.php">Contact Us</a></div>
            <div><a id="account" class="account" href="../php/account.php">Account</a></div>
        </div>

        <div id="login">
            <button data-modal-target="#modal" id="signinBtn">Sign In</button>
            <div class="modal" id="modal">
                <div class="modalHeader">
                    <h2>Sign In</h2>
                    <button data-close-button class="closeModal">&times;</button>
                </div>
                <div class="modalBody">
                    <div id="signin" class="g-signin2" data-onsuccess="onSignIn" data-width="174" data-longtitle="true"
                        data-height="26"></div>
                    <div>
                        <fb:login-button size="large" scope="public_profile" data-width="300px"
                            onlogin="checkLoginState();"> Sign In with Facebook
                        </fb:login-button>
                    </div>
                </div>
            </div>
            <div id="overlay"></div>
        </div>

        <div id="logout">
            <a id="signout" href="#" onclick="signOut();">Sign Out</a>
        </div>
    </div>
</div>