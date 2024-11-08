<?php

if (isset($_POST['rule'])) {

	$dice1 = rand(1, 6);
	$dice2 = rand(1, 6);

	$total = $dice1 + $dice2;
	$amount = 10;

	if ($_POST['rule'] == 'below' && $total < 7) {
		$amount = 20;
	} else if ($_POST['rule'] == 'above' && $total > 7) {
		$amount = 20;
	} else if ($_POST['rule'] == 'lucky' && $total == 7) {
		$amount = 30;
	}

	echo json_encode(['dice1' => $dice1, 'dice2' => $dice2, 'total' => $total, 'amount' => $amount]);
}