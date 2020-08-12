<?php
require_once("../mvc/models/databaseConnection.php");

class contactUsSubmitModel
{

    function __construct()
    {
        $this->databaseConnection = new databaseConnection();
    }

    public function submitFeedback($feedback)
    {

        define("RECAPTCHA_V3_SECRET_KEY", "6LeJoLoZAAAAAMBIHJITE9NZAeuh3h1lI596Cnch");

        if (
            !isset($feedback["token"]) || !isset($feedback["action"]) ||
            !isset($feedback["message"]) || !isset($feedback["reason"])
        ) {
            header("Location: https://cousecritics.test");
            exit;
        }

        $token = $feedback["token"];
        $action = $feedback["action"];
        $reason = $feedback["reason"];
        $message = $feedback["message"];

        if ($this->verifyResponse($token, $action)) {

            $this->verifyInput($reason, $message);

            $query = "INSERT INTO feedback (reason,message) VALUES (?,?)";
            $stmt = $this->databaseConnection->prepare($query);
            $stmt->bind_param('ss', $feedback["reason"], $feedback["message"]);
            $stmt->execute();
            $stmt->close();
            header("Location: https://cousecritics.test/php/contactUs.php?feedback=received");
            exit;
        }
    }

    public function verifyResponse($token, $action)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => RECAPTCHA_V3_SECRET_KEY, 'response' => $token)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $arrResponse = json_decode($response, true);

        if ($arrResponse["success"] == "1" && $arrResponse["action"] == $action && $arrResponse["score"] >= 0.5) {
            return true;
        } else {
            return false;
        }
    }

    public function verifyInput($reason, $message) {
        $reasons = ["Technical Issue", "User Interface", "Missing Course", "Other"];

        if (!in_array($reason, $reasons) || strlen($message) > 500){
            header("Location: https://cousecritics.test");
            exit;
            
        } else {
            return;

        }
    }
}
