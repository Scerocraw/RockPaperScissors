<?php

class Model_Game extends ORM {

    /**
     * Rules
     * @var type 
     */
    protected $_rules = array(
        'id' => array(
            'max_length' => 11,
        ),
        'userID' => array(
            'max_length' => 11,
        ),
        'score' => array(
            'max_length' => 11,
        ),
        'win' => array(
            'max_length' => 11,
        ),
        'lose' => array(
            'max_length' => 11,
        )
    );

    /**
     * Returns a users score constellation
     * If no score constellation exists, this function will create a new one
     * @param type $userID
     * @return type
     */
    public static function getScore($userID) {
        // Check if the value exists inside user
        $gameScore = ORM::factory('game')->where('userID', '=', $userID)->find();

        // Check if is valid
        if (!$gameScore->id) {
            // Declare new model
            $newGameScore = ORM::factory('game');

            // Set properties
            $newGameScore->userID = $userID;
            $newGameScore->score = 0;
            $newGameScore->win = 0;
            $newGameScore->lose = 0;

            // Save the properties
            $newGameScore->save();

            // Update the gameScore
            $gameScore = $newGameScore;
        }

        // Return true or false
        return isset($gameScore) ? array(
            'win' => $gameScore->win,
            'lose' => $gameScore->lose,
            'score' => $gameScore->score
                ) : FALSE;
    }

    /**
     * Refreshs the statistic of a user
     * @param type $userID
     * @param type $playerLose
     * @return boolean
     */
    public static function refreshStatistic($userID, $playerLose) {
        // Check if the userID is valid
        if (!isset($userID) || empty($userID)) {
            return FALSE;
        }

        // Declare the game model
        $gameScoreModel = ORM::factory('game')->where('userID', '=', $userID)->find();

        // Check if we've found a score
        if (!isset($gameScoreModel->id)) {
            return FALSE;
        }

        // Set property
        $gameScoreModel->id = $gameScoreModel->id;

        // If we won, increase "win", otherwise "lose"
        if (!$playerLose) {
            $gameScoreModel->win += 1;
            $gameScoreModel->score += 1;
        } else {
            $gameScoreModel->lose += 1;
            $gameScoreModel->score -= 1;
        }

        // Save the updated props
        $gameScoreModel->save();

        // Return the updated statistic
        return array(
            'win' => (int) $gameScoreModel->win,
            'lose' => (int) $gameScoreModel->lose,
            'score' => (int) $gameScoreModel->score
        );
    }

    /**
     * Grabs the highscore (desc on score)
     * @return type
     */
    public static function getHighscore() {
        // Get the highscore
        $highscore = ORM::factory('game')->order_by('score', 'DESC')->limit(5)->find_all()->as_array();

        // Contains all highscore elements
        $modifiedHighscore = array();

        // Iterate all highscore elements
        foreach ($highscore as $key => $singlePlayerScore) {
            // Get the current user by id
            $userModel = ORM::factory('user')->where('id', '=', $singlePlayerScore->userID)->find();

            // Calculate the score and also add the user
            $modifiedHighscore[$key] = array(
                'user' => $userModel->email,
                'statistic' => array(
                    'win' => (int) $singlePlayerScore->win,
                    'lose' => (int) $singlePlayerScore->lose,
                    'score' => (int) $singlePlayerScore->score
                ),
            );
        }

        // Return the highscore
        return $modifiedHighscore;
    }

}
