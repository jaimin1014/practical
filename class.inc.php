<?php

/**
 *  
 */
class Grid
{
	private $grid;
	private $boxes = [];
	private $players = [];
	private $currentPlayer = 0;
	private $total;

	function __construct($grid)
	{
		$this->grid = $grid;
		$this->total = $grid * $grid;
	}

	public function addPlayer($number) {
		$this->players[] = new Player($number);
	}

	public function getBoxes() {
		$finalBoxes = [];
		for ($i=0; $i < $this->grid ; $i++) {
			$box = [];
			for ($j=0; $j < $this->grid; $j++) {
				if ($i % 2 == 0) {
					$position = ($this->grid * $i) + $j + 1;
				} else {
					$position = ($this->grid * $i) - $j + $this->grid;
				}
				
				$this->boxes[$position] = '(' . $j . ',' . $i. ')';
			}
		}
		return $this->boxes;
	}

	public function play() {
		while (true) {
			$current = $this->players[$this->currentPlayer];
			
			$move = rand(1, 6);
			$current->setPosition($move, $this->getBoxes(), $this->total);
			
			if ($current->getPosition() >= $this->total) {
				$current->setWinner();
				return $this->players;
			}
			
			$this->currentPlayer = ($this->currentPlayer + 1) % count($this->players);
			// code...
		}
	}
}

class Player{
	public $number;
	public $position;
	public $rolls;
	public $positions;
	public $winner;
	public $cordinates;

	function __construct($number)
	{
		$this->number = $number;
		$this->position = 0;
		$this->winner = 0;
		$this->rolls = [];
		$this->positions = [];
		$this->cordinates = [];
	}

	public function move() {
		return rand(1,6);
	}

	public function getNumber()
	{
		return $this->number;
	}

	public function setWinner()
	{
		$this->winner = 1;
	}

	public function getPosition(){
		return $this->position;
	}

	public function setPosition($steps, $boxes, $total)
	{
		$newPosition = $this->position + $steps;
		if ($newPosition > $total) {
			$this->position = $this->position;
			$this->rolls[] = $steps;
			$this->positions[] = $this->position;
			$this->cordinates[] = $boxes[$this->position];
		} else {
			$this->position += $steps;
			$this->rolls[] = $steps;
			$this->positions[] = $this->position;
			$this->cordinates[] = $boxes[$this->position];
		}
	}
}