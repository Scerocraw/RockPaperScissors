<div class="navigation">
    <a href="/play">Game</a>
    <a href="/highscore">Highscore</a>
    <a href="/logout">Logout</a>
    <hr/>
</div>
<div class="score">
    Good to see you {$session.eMail}!<br/>Your current score: Wins <a class='gamesWon' href='#'>{$session.gameScore.win}</a>, Loses <a class='gamesLost' href='#'>{$session.gameScore.lose}</a>, Score total: <a class='gamesScore' href='#'>{$session.gameScore.score}</a>
</div>