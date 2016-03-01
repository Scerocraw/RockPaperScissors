<?php

class Micro_RPSCore {
    
    /**
     * Current available figures
     * @var type 
     */
    protected static $_availableFigures = array(
        'Rock', 'Paper', 'Scissor'
    );
    
    /**
     * Simulate the game
     * Return TRUE, if player lose, and FALSE, when player win
     * @param type $playersFigure
     * @return type
     */
    public static function simulate($playersFigure) {
        // Require all game things
        require_once MODPATH . '/micro/classes/RPS/classes/abstract/Figure.php';
        require_once MODPATH . '/micro/classes/RPS/classes/Rock.php';
        require_once MODPATH . '/micro/classes/RPS/classes/Paper.php';
        require_once MODPATH . '/micro/classes/RPS/classes/Scissor.php';
        
        // Copy the figures
        $botFigure = self::$_availableFigures;
        
        // Something went wrong (because someone edited the id)
        if(!isset($botFigure[$playersFigure])) {
            Micro_Template::set('error', 'Woah, something went wrong.');
            header("Location: /");
        }
        
        // Declare player figure
        $playerChoose = new $botFigure[$playersFigure]();
        
        // Unset the players choose - the bot have to choose something else
        unset($botFigure[$playersFigure]);
        
        // Now declare the bot choose
        $botChoose = new $botFigure[array_rand($botFigure)]();
        
        // Select the bots choose
        $playerLose = $botChoose->checkPlayerWin($playerChoose);
        
        // Return if player won
        return $playerLose;
    }
    
}