 <div class="searchinput">
     <form action="php/course.php" method="GET">
         <h1>Enter A Course Code</h1>
         <div id="courseDoesNotExist"></div>
         <input id="searchCourse" list="datalist1" type="text" name="course" placeholder="Eg. MATH 100" maxlength="10" />
         <button type="button" id="submitCourse" onclick="courseDoesNotExist();">
             <i class="fa fa-search"></i>
         </button>
         <div id="courseList"></div>
     </form>
     <form action="php/course.php" method="GET">
         <h1><br> Or <br><br> Enter a Subject Code</h1>
         <div id="subjectDoesNotExist"></div>
         <input id="searchSubject" list="datalist1" type="text" name="courses" placeholder="Eg. MATH 100" maxlength="10" />
         <button type="button" id="submitSubject" onclick="subjectDoesNotExist();">
             <i class="fa fa-search"></i>
         </button>
         <div id="subjectList"></div>
     </form>
 </div>