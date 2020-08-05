<!DOCTYPE html>
<html lang="en">

<head>
    <title>CourseCritics-Contact Us</title>
    <?php require "repetitiveCode/commonHTML/head.php"; ?>
</head>

<body>
    <div style="padding-top: 5rem;" class="container">
        <div class="header">
            <?php require "repetitiveCode/commonHTML/nav.php"; ?>
        </div>

        <div class="content">

            <form id="form" method="POST" action="contactUsSubmit.php">
                <label for="reason">What can we help you with?</label>

                <select id="reason" name="reason" required>
                    <option value="Technical Issue">Technical Issue</option>
                    <option value="Feedback">Feedback</option>
                    <option value="Other">Other</option>
                </select>

                <label for="message">Leave a Message</label>
                <textarea id="message" name="message" style="resize: none;" maxlength="500" required></textarea>

                <input type="submit" value="Submit Feedback">

            </form>
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