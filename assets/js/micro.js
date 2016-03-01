var RPS = {
    init: function () {
        // Register a "click on option" event
        $('.option').on('click', function () {
            var clickedElement = $(this);

            RPS.simulate($(clickedElement).data('id'));
        });
    },
    
    simulate: function(elementID) {
        $.ajax({
                url: '/simulate',
                data: {
                    id: elementID
                },
                type: 'POST',
                dataType: 'JSON',
                success: function (data) {
                    if(data.gameLost) {
                        $.jGrowl("You lost the game!");
                    } else {
                        $.jGrowl("You won the game!")
                    }
                    $('.gamesWon').html(data.statistic.win);
                    $('.gamesLost').html(data.statistic.lose);
                    $('.gamesScore').html(data.statistic.score);
                }
            });
    }
};

$(document).ready(function () {
    RPS.init();
});