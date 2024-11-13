<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lucky 7</title>
	<script type="text/javascript" src="jquery-3.5.1.min.js"></script>
</head>
<body>

<?php 

if (isset($_POST['grid'])) {

	require_once 'class.inc.php';

	$grid = new Grid($_POST['grid']);

	$grid->addPlayer(1);
	$grid->addPlayer(2);
	$grid->addPlayer(3);

	$players = $grid->play();
	?>
	<table border="1">
		<tr>
			<th>Player</th>
			<th>Roll History</th>
			<th>Position History</th>
			<th>Cordinate History</th>
			<th>Winner Status</th>
		</tr>
	<?php 
	foreach ($players as $key => $value) {?>
		<tr>
			<td><?php echo $value->number;?></td>
			<td><?php echo implode(',', $value->rolls);?></td>
			<td><?php echo implode(',', $value->positions);?></td>
			<td><?php echo implode(',', $value->cordinates);?></td>
			<td><?php echo $value->winner == 1 ? 'winner' : '';?></td>
		</tr>
	<?php }
} else { ?>
<h4>Snake & Ladder Game</h4>

<div class="input-box">
	
	<form method="post">
		<input type="text" name="grid" placeholder="Grid">

		<input type="submit" name="Start">
	</form>
</div>
<?php 
}
?> 
</body>
</html>