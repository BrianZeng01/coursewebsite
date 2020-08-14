<!DOCTYPE html>
<html lang="en">

<head>
    <title>Coursecritics - UBC</title>
    <?php require "php/repetitiveCode/commonHTML/head.php"; ?>
</head>
<style>
    #home {
        text-decoration: underline;
        font-weight: bold;
    }
</style>

<body>
    <?php require "php/repetitiveCode/commonHTML/nav.php" ?>
    <div class="container">
        <div class="header">
            <div class="headerImage"></div>
            <hr>
            <h1>The University of British Columbia <br>- Vancouver Campus</h1>
            <h3>A place of mind</h3>
        </div>

        <div class="content">


            <div class="ubcinfo">
                <h3 class="firstline">
                    Finding the right courses can be a stressful task.
                    Come share the experiences you've had with courses and explore which
                    courses might be right for you.
                </h3>
            </div>

            <div class="searchinput">
                <div>
                    <form action="php/course.php" method="GET">
                        <h2>Enter A Course Code</h2>
                        <div id="courseDoesNotExist"></div>
                        <input id="searchCourse" list="datalistCourse" type="text" name="course" placeholder="Eg. MATH 100" maxlength="10" />
                        <button type="button" id="submitCourse" onclick="courseDoesNotExist();">
                            <i class="fa fa-search"></i>
                        </button>
                        <div id="courseList"></div>
                    </form>
                </div>
                <div>
                    <h2>OR</h2>
                </div>
                <div>
                    <form action="php/sameSubjectCode.php" method="GET">
                        <h2>Enter a Subject Code</h2>
                        <div id="subjectDoesNotExist"></div>
                        <input id="searchSubject" list="datalistSubject" type="text" name="courses" placeholder="Eg. PHYS" maxlength="10" />
                        <button type="button" id="submitSubject" onclick="subjectDoesNotExist();">
                            <i class="fa fa-search"></i>
                        </button>
                        <div id="subjectList"></div>
                    </form>
                </div>
            </div>

            <div class="browse">
                <a href="php/subjects.php">Browse All Courses</a>
            </div>

        </div>

        <?php require "php/repetitiveCode/commonHTML/footer.php"; ?>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/searchBar.js"></script>
</body>

</html>