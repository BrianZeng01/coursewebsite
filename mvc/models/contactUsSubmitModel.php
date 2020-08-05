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

        if (!isset($feedback["token"]) || !isset($feedback["action"]) ||
         !isset($feedback["message"]) || !isset($feedback["reason"])) {
             print_r($feedback);
             exit;
        }

            $token = $feedback["token"];
            $action = $feedback["action"];
            
            if ($this->verifyResponse($token, $action)) {

                $query = "INSERT INTO feedback (reason,message) VALUES (?,?)";
                $stmt = $this->databaseConnection->prepare($query);
                $stmt->bind_param('ss', $feedback["reason"], $feedback["message"]);
                $stmt->execute();
                $stmt->close();
                return;
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

        if($arrResponse["success"] == "1" && $arrResponse["action"] == $action && $arrResponse["score"] >= 0.5) {
            return true;
        } else {
            return false;
        }
    }
}
