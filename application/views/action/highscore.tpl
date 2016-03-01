<div class="highscore">
    <legend>HIGHSCORE: Top 5</legend>
    <table class="table table-bordered table-striped">
        <tr>
            <th>Position</th>
            <th>eMail</th>
            <th>Win</th>
            <th>Lose</th>
            <th>Score</th>
        </tr>
        {if isset($highscorePlayers)}
            {foreach $highscorePlayers as $position => $highscore}
                <tr class="highscoreRow{if $session.eMail eq $highscore.user} myHighscore{/if}">
                    <td>{$position+1}</td>
                    <td>{$highscore.user} {if $session.eMail eq $highscore.user} (YOU){/if}</td>
                    <td>{$highscore.statistic.win}</td>
                    <td>{$highscore.statistic.lose}</td>
                    <td>{$highscore.statistic.score}</td>
                </tr>
            {/foreach}
        {else}
            <tr>
                <td colspan="4">No games played</td>
            </tr>
        {/if}
    </table>
</div>