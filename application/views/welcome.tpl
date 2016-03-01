<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h2>Play Rock Paper Scissor Online!</h2><hr/>
    {if isset($session.eMail)}
        {include file="navigation.tpl"}

        {if isset($actionToInclude)}
            {include file="action/$actionToInclude.tpl"}
        {/if}
    {else}    
        {if isset($registerError)}
            <p class="error">{$registerError}</p>
        {/if}
        <form method="POST" action="/play" name="registerRPS">
            <label for="eMail">Your eMail</label>
            <input name="eMail" id="eMail" value="" class="form-control"/>
            <br/>
            <button type="submit" name="register" class="btn btn-block btn-success">PLAY</button>
        </form>
    {/if}
</div>