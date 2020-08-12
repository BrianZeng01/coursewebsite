<!DOCTYPE html>
<html lang="en">

<head>
    <title>CourseCritics-Contact Us</title>
    <?php require "repetitiveCode/commonHTML/head.php"; ?>
    <link rel="stylesheet" href="../../css/feedbackStyles.css">
    <style>
        #contactUs {
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php require "repetitiveCode/commonHTML/nav.php"; ?>
    <div class="container">
        <div class="header">
            <div>
                <h1>Contact Us</h1>
            </div>
        </div>

        <div class="content">
            <div>
                <?php if (isset($_GET["feedback"])) {
                    echo "<h2 class='thanks'>Thank you for your Feedback!</h2>";
                }
                ?>
                <form id="form" method="POST" action="contactUsSubmit.php">
                    <label for="reason">What can we help you with?</label>

                    <select id="reason" name="reason" required>
                        <option value="Technical Issue">Technical Issue</option>
                        <option value="User Interface">User Interface</option>
                        <option value="Missing Course">Missing Course</option>
                        <option value="Other">Other</option>
                    </select>

                    <label for="message">Leave a Message</label>
                    <textarea id="message" name="message" style="resize: none;" maxlength="500" required placeholder="My reviews are not being submitted."></textarea>

                    <input type="submit" value="Submit Feedback">

                </form>
            </div>
        </div>

        <?php require "repetitiveCode/commonHTML/footer.php"; ?>
    </div>
    <script>
        $("#form").submit(function(event) {
            event.preventDefault();
            grecaptcha.ready(function() {
                grecaptcha.execute('6LeJoLoZAAAAAK4V6WwcFIjJSzvIAfTEBGVwhnIf', {
                    action: 'submit'
                }).then(function(token) {
                    $('#form').prepend('<input type="hidden" name="token" value="' + token + '">');
                    $('#form').prepend('<input type="hidden" name="action" value="submit">');
                    $('#form').unbind('submit').submit();
                });
            });
        })
    </script>
</body>

</html>