<?php
echo '
<div class="reviewInputs">
    <form action="review.php" method="POST">
        <input type="hidden" name="courseId" value=' . $courseId . '>
        <input type="hidden" name="action" value="insert">
        
        <div id="overallRating">
            <div>
                <label>
                    <input type="radio" required name="overall" value=1 onclick="overallRating(1)">
                    <img id=" overallRating1" class="starBox overallRating1" onmouseover="hoverOverall(1)" onmouseout="hoverOffOverall()" src=" ../images/starBox.png">
                </label>
                <label>
                    <input type="radio" name="overall" value=2 onclick="overallRating(2)">
                    <img id="overallRating2" class="starBox overallRating2" onmouseover="hoverOverall(2)" onmouseout="hoverOffOverall()" src="../images/starBox.png">
                </label>
                <label>
                    <input type="radio" name="overall" value=3 onclick="overallRating(3)" checked>
                    <img id="overallRating3" class="starBox overallRating3" onmouseover="hoverOverall(3)" onmouseout="hoverOffOverall()" src="../images/starBox.png">
                </label>
                <label>
                    <input type="radio" name="overall" value=4 onclick="overallRating(4)">
                    <img id="overallRating4" class="starBox overallRating4" onmouseover="hoverOverall(4)" onmouseout="hoverOffOverall()" src="../images/starBox.png">
                </label>
                <label>
                    <input type="radio" name="overall" value=5 onclick="overallRating(5)">
                    <img id="overallRating5" class="starBox overallRating5" onmouseover="hoverOverall(5)" onmouseout="hoverOffOverall()" src="../images/starBox.png">
                </label>
                <h2>Overall&nbsp&nbsp&nbsp</h2>
            </div>
        </div>

        <div id="difficultyRating">
            <div>
                <label>
                    <input type="radio" required name="difficulty" value=1 onclick="difficultyRating(1)">
                    <img id="difficultyRating1" class="starBox" onmouseover="hoverDifficulty(1)" onmouseout="hoverOffDifficulty()" src=" ../images/starBox.png">
                </label>
                <label>
                    <input type="radio" name="difficulty" value=2 onclick="difficultyRating(2)">
                    <img id="difficultyRating2" class="starBox" onmouseover="hoverDifficulty(2)" onmouseout="hoverOffDifficulty()" src="../images/starBox.png">
                </label>
                <label>
                    <input type="radio" name="difficulty" value=3 onclick="difficultyRating(3)" checked>
                    <img id="difficultyRating3" class="starBox" onmouseover="hoverDifficulty(3)" onmouseout="hoverOffDifficulty()" src="../images/starBox.png">
                </label>
                <label>
                    <input type="radio" name="difficulty" value=4 onclick="difficultyRating(4)">
                    <img id="difficultyRating4" class="starBox" onmouseover="hoverDifficulty(4)" onmouseout="hoverOffDifficulty()" src="../images/starBox.png">
                </label>
                <label>
                    <input type="radio" name="difficulty" value=5 onclick="difficultyRating(5)">
                    <img id="difficultyRating5" class="starBox" onmouseover="hoverDifficulty(5)" onmouseout="hoverOffDifficulty()" src="../images/starBox.png">
                </label>
                <h2>Difficulty </h2>
            </div>
        </div>

        <div class="anonymous">
            <input type="checkbox" id="anonymous" name="anonymous">
            <label for="anonymous">Post Anonymously</label>
        </div>
        <div class="takeAgain">
            <input type="checkbox" id="takeAgain" name="takeAgain">
            <label for="takeAgain">Take Again</label>
        </div>
        <div class="textbook">
            <select name="textbook" id="textbook" required>
                <option value="" disabled selected>Textbook</option>
                <option value="Required">Required</option>
                <option value="Recommended">Recommended</option>
                <option value="Not Required">Not Required</option>
            </select>
        </div>
        <div class="grade">
            <select name="grade" id="grade" required>
                <option value="" disabled selected>Grade</option>
                <option value="A+">A+</option>
                <option value="A">A</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B">B</option>
                <option value="B-">B-</option>
                <option value="C+">C+</option>
                <option value="C">C</option>
                <option value="C-">C-</option>
                <option value="D">D</option>
                <option value="F">F</option>
                <option value="Rather Not Say">Rather Not Say</option>
                <option value="N/A">N/A</option>
            </select>
        </div>
        <div class="year">
            <select id="year" name="year" required></select>
        </div>

        <div class="professor">
            <label for="professor">Professor</label>
            <input type="text" id="professor" name="professor" maxlength="30" placeholder="(Optional)">
        </div>

        <div class="comment">
            <label for="comment">Comments</label>
            <input disabled maxlength="3" size="3" value="500" id="commentCounter">
            <textarea type="text" id="comment" name="comment" style="resize:none;" required maxlength="500" placeholder="At first glance, the course content seemed daunting and the workload looked heavy. However, the course had great structure and lessons were very organized which made it managable. The "simpler" material seemed kind of rushed. The course content was also extrememly relevant during my first internship and carried over into my upper year courses."></textarea>
        </div>
        <div class="advice">
            <label for="advice">Advice</label>
            <input disabled maxlength="3" size="3" value="500" id="adviceCounter">
            <textarea type="text" id="advice" name="advice" style="resize:none;" maxlength="500" placeholder="(Optional) The entire course builds on itself so make sure to keep up with the lessons. The first few weeks were quite easy which led to a lot of people underestimating the importance of the topics and struggling later on. The question bank for exams is pretty small so as long as you do a couple practice exams you will be fine."></textarea>
        </div>

        <div id="submitReview">
            <input class="buttons" type="submit" value="Submit Review">
        </div>

        <div>
            <input class="buttons" type="button" value="Cancel" onclick="window.location.reload();">
        </div>
    </form>

 </div>
';