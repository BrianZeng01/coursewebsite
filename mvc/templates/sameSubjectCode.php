<?php require_once("utils.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Coursecritics - UBC courses</title>
    <link rel="stylesheet" href="../css/subjectStyles.css" />
    <?php require 'repetitiveCode/commonHTML/head.php'; ?>
</head>

<body>
    <div class="container">
        <div class="header">
            <?php require 'repetitiveCode/commonHTML/nav.php'; ?>
            <div class="subjectHeader">
                <h1 class="subjectTitle">CourseCritics: UBC Course Schedule</h1>
                <hr size="8px" color="#072145">
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
                    <th>Ratings</th>
                    <th>Course</th>
                    <th>Title</th>
                </tr>

                <?php 
                $ratings = $model["ratings"];
                $text = $model["text"];

                for ($i=0; $i < sizeof($ratings); $i++) : ?>
                    <tr class="clickable-row" data-href="https://coursecritics.test/php/course.php?course=<?php echoXss($text[$i]["course_code"]); ?>"> <td>
                            <span class="ratings"><?php echo $ratings[$i]["overall"]; ?></span>
                            <span style="color:gray;">(<?php echo $ratings[$i]["reviewCount"]; ?>)</span>
                        </td>
                        <td><?php echoXss($text[$i]["course_code"]); ?></td>
                        <td><?php echoXss($text[$i]["course_title"]); ?></td>
                    </tr>
                <?php endfor;?>
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

    <script src="../js/ratings.js"></script>
</body>

</html>