<?php

/**
 * 
 */
class Micro_Ajax {

    /**
     * AJAX Routing
     * @param type $uri
     * @param type $uriParts
     * @param type $postData
     */
    public static function route($uri, $uriParts, $postData) {
        // jsonResponse
        $jsonResponse = false;
        
        // Handling
        switch ($uri) {
            case 'simulate':
                
                // Check if the player lost or won
                $playerLose = Micro_RPSCore::simulate($postData['id']);
                
                // Get the session
                $session = Session::instance();
                
                // Get the userID
                $userID = $session->get('userID');
                
                // Declare game model
                $gameScoreModel = ORM::factory('game');
                
                // Refresh the score
                $refreshedScore = $gameScoreModel->refreshStatistic($userID, $playerLose);

                // Write the refreshed score into the session
                $session->set('gameScore', $refreshedScore);
                
                // Prepare response
                $jsonResponse = array(
                    'gameLost'  => $playerLose,
                    'statistic' => $refreshedScore
                );
                break;
        }
        
        // Return the response
        echo json_encode($jsonResponse);die();
    }

}
