<?php

class Model_User extends ORM {

    /**
     * Rules
     * @var type 
     */
    protected $_rules = array(
        'id' => array(
            'max_length' => 11,
        ),
        'email' => array(
            'max_length' => 255,
        )
    );

    /**
     * Register function
     * @param type $postData
     * @return boolean
     */
    public static function register($postData) {
        // Can not register, if something isnt valid
        if (!isset($postData['eMail']) || empty($postData['eMail']) || !filter_var($postData['eMail'], FILTER_VALIDATE_EMAIL)) {
            Micro_Template::setTemplateVariable('registerError', 'eMail is not valid!');
            return FALSE;
        }

        // Check if the user already exists
        $userID = self::alreadyExists('email', $postData['eMail']);

        // Check if something already exists
        if (!isset($userID) || empty($userID)) {
            // Get the userModel
            $userModel = ORM::factory('user');

            // Set properties
            $userModel->email = htmlentities($postData['eMail']);

            // Save
            $userModel->save();

            // Set the userID
            $userID = $userModel->id;
        }

        // Get session
        $session = Session::instance();

        // Also set session needle
        $session->set('eMail', self::getEmailByID($userID));
        $session->set('userID', $userID);

        // Get the current game score
        $gameModel = ORM::factory('game');

        // Get player score
        $playerScore = $gameModel::getScore($userID);

        // Set the game constellation
        $session->set('gameScore', $playerScore);
        
        return TRUE;
    }

    /**
     * Returns the users email
     * @param type $userID
     * @return type
     */
    private static function getEmailByID($userID) {
        // Get the users email
        $userNeedle = ORM::factory('user')->where('id', '=', $userID)->find();

        // Return true or false
        return ($userNeedle->email) ? $userNeedle->email : FALSE;
    }

    /**
     * Return TRUE if the value already exists
     * @param type $column
     * @param type $value
     * @return type
     */
    public static function alreadyExists($column, $value) {
        // Check if the value exists inside user
        $userNeedle = ORM::factory('user')->where($column, '=', htmlentities($value))->find();

        // Return true or false
        return ($userNeedle->id) ? $userNeedle->id : FALSE;
    }

    /**
     * Logsout the user
     * @return type
     */
    public static function logout() {
        $session = Session::instance();
        return $session->destroy();
    }

}
