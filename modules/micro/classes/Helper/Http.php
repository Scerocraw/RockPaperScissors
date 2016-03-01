<?php

/**
 * 
 */
class Micro_Http {

    /**
     *
     * HTTP Routing
     * @param $uri
     * @param $uriParts
     * @param $postData
     * @return bool
     */
    public static function route($uri, $uriParts, $postData) {
        // Json response
        $httpResponse = false;

        switch ($uri) {
            case 'play':

                Micro_Template::setTemplateVariable('actionToInclude', htmlentities($uri));

                // Check if postdata is okay
                if (isset($postData) && !empty($postData) && is_array($postData)) {
                    // Declare the user model
                    $userModel = ORM::factory('user');

                    // Register function
                    $verified = $userModel->register($postData);
                    
                    if($verified) {
                        // Back to the home
                        header("Location: /play");
                    }
                }
                break;
            case 'highscore':

                $gameModel = ORM::factory('game');
                
                Micro_Template::setTemplateVariable('actionToInclude', htmlentities($uri));
                Micro_Template::setTemplateVariable('highscorePlayers', $gameModel->getHighscore());
                break;
            case 'logout':
                // Declare user
                $userModel = ORM::factory('user');

                // Logout / destroy the session
                $userModel->logout();

                // Back to the home
                header("Location: /");
                break;
            default:
                Micro_Template::setTemplateVariable('actionToInclude', htmlentities($uri));
                break;
        }

        return $httpResponse;
    }

}
