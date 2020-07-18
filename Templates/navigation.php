<body>
    <div class="container">
        <div class="header">
            <div class="nav">
                <div class="mainNav">
                    <a href="ubc.html">Home</a>
                    <a href="subjects.php">Courses</a>
                    <a href="contactus.html">Contact Us</a>
                    <a id="account" href="account.php">Account</a>
                    <div id="login">
                        <div id="signin" class="g-signin2" data-onsuccess="onSignIn"></div>
                    </div>
                    <div id="logout">
                        <a id="signout" href="#" onclick="signOut();">Sign out</a>
                    </div>
                </div>
            </div>

            <div class="subjectHeader">
                <h1 class="subjectTitle">
                    UBC: <?php echoXss($model['course_code']); ?> reviews
                </h1>
                <hr size="8px" color="#072145">
            </div>
        </div>