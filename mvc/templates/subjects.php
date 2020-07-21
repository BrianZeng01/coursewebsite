<!DOCTYPE html>
<html>

<head>
    <title>Coursecritics - UBC courses</title>
    <link rel="stylesheet" href="../css/subjectStyles.css" />
    <?php require 'repetitiveCode/commonHTML/head.php'; ?>

    <style>
        #courses {
            background-color: #1c77ac;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <?php require 'repetitiveCode/commonHTML/nav.php'; ?>
            <div class="subjectHeader">
                <h1 class="subjectTitle">CourseCritics: UBC Course Schedule</h1>
                <hr>
            </div>
        </div>


        <div class="content">
            <div class="searchinput">
                <form action="course.php">
                    <h1>Enter A Course Code</h1>
                    <div id="courseDoesNotExist"></div>
                    <input id="search" list="datalist1" type="text" name="course" placeholder="Eg. MATH 100" />
                    <button type="button" id="submit" onclick="courseDoesNotExist();">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
                <div id="courseList"></div>
            </div>

            <div class="note">
                <h3>Note: Sign in to submit a review. Please be mindful
                    when submitting reviews, thank you and enjoy!</h3>
            </div>

            <table>
                <tr>
                    <th>Subject Code</th>
                    <th>Title</th>
                    <th>Faculty or School</th>
                </tr>

                <?php foreach ($model as $subject) : ?>
                    <tr class="clickable-row" data-href="https://coursecritics.test/php/sameSubjectCode.php?courses=<?php echo $subject['subject_code'] ?>">
                        <td><?php echo ($subject['subject_code']) ?></td>
                        <td><?php echo ($subject['subject_title']) ?></td>
                        <td><?php echo ($subject['faculty_or_school']) ?></td>
                    </tr>
                <?php endforeach; ?>

            </table>
        </div>
        <?php require 'repetitiveCode/commonHTML/footer.php'; ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../js/searchBar.js"></script>
    <script>
        $(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });
    </script>

</body>

</html>