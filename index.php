<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lucky 7</title>
	<script type="text/javascript" src="jquery-3.5.1.min.js"></script>
</head>
<body>

<h4>Welcome to Lucky 7 Game</h4>

<div class="selection">
	<p>Place your bet (RS 10):</p>

	<select class="rule">
		<option value="below">Below 7</option>
		<option value="lucky">Lucky 7</option>
		<option value="above">Above 7</option>
	</select>
	<a href="javascript:;" class="play">Play</a>
</div>
<div class="game_result" style="display: none;">
	<p>Game Results:</p>

	<p>Dice 1 : <span class="dice1"></span></p>
	<p>Dice 2 : <span class="dice2"></span></p>
	<p>Total : <span class="total"></span></p>

	<p>OutCome : <span class="outcome"></span></p>
	<p>Total Balance : <span class="total_balance"></span></p>

	<a href="javascript:;" class="reset">Reset and Play Again</a>
	<a href="javascript:;" class="play_again">Continue Playing</a>
</div>

<script type="text/javascript">

var totalBalance = 100;
var betAmount = 10;
var playCount = 0;
$(document).ready(function(){

	$('body').on('click', '.play', function() {
		if (totalBalance == 0) {
			alert('Your balance is over');
		} else {
			$.ajax({
	            type: 'POST',
	            url: 'dice.php',
	            data: {'rule' : $('.rule').val()},
	            dataType : 'json',
	            async: false
	        })
	        .done(function (response) {
	            $('.dice1').html(response.dice1);
	            $('.dice2').html(response.dice2);
	            $('.total').html(response.total);
	            
	            if (response.amount == 10) {
	            	$('.outcome').html('You lose Rs 10');

	            	totalBalance = totalBalance - betAmount;
	            	$('.total_balance').html('Rs ' + totalBalance);
	            } else {
	            	$('.outcome').html('You win Rs ' + response.amount);
	            	totalBalance = totalBalance - betAmount + response.amount;
	            	$('.total_balance').html('Rs ' + totalBalance);
	            }
	            $('.game_result').show();
	            $('.selection').hide();
	            playCount++;
	        });
		}
	});

	$('body').on('click', '.play_again', function() {
        $('.selection').show();
		$('.game_result').hide();
	});

	$('body').on('click', '.reset', function() {
		window.location.reload();
	});
});

</script>
</body>
</html>