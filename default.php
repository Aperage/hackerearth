<?php

/*


echo "<pre>"; print_r($); echo "</pre>"; die();

1 0 0 0 0 0 2
0 0 1 2 0 0 0
0 0 0 0 0 0 0
0 0 2 0 0 0 0
0 0 0 0 0 0 2
2 0 0 0 2 0 1
10
1

1 2
2 2

*/


define('ROWS', 6);
define('COLS', 7);


class Move {
    public $x;
    public $y;
    public function __construct($x = -1, $y = -1) {
        $this->x = $x;
        $this->y = $y;
    }
}

class Stone {
    public $position;
    public $move;

    public function __construct($x = -1, $y = -1) {
        $this->position = new Move($x, $y);
        $this->move = new Move();
    }

    public function setMove($move) {
    	$this->move = $move;
    }

    public function printHexxagon() {
		echo $this->position->x . " " . $this->position->y . "\n" . $this->move->x . " " . $this->move->y;
	}
}


class MyGrid {
    public $grid;
    public $move;
    
    public function __construct($grid) {
        $this->grid = $grid;
    }


    public function getStonesForPlayer($p = false) {
        $output = array();
        if( !$p ) $p = $this->currentPlayer; 
        
        for( $x=0; $x<ROWS; $x++) {
        	for( $y=0; $y<COLS; $y++) {
	        	if( $p == $this->grid[$x][$y]) {
	        		$output []= new Stone($x, $y);
	        	}
	        }
        }

        return $output;
    }

    public function getMovesForStone($p = false) {
        $output = array();
        
        // spreading moves


        // jumping moves

        $output []= new Move(0,1);

        return $output;
    }



   
}

class HexxagonBot {

    public $grid;
    public $currentPlayer;

	public function __construct($grid, $p) {
        $this->grid = $grid;
        $this->currentPlayer = $p;
    }
/*
	public function getRandomMove() {
		$playerStones = $grid->getStonesForPlayer();
		shuffle($playerStones);

		foreach( $playerStones as $playStone ) {

			$moves = $grid->getMovesForStone($playStone);
			if( count($moves) > 0 ) {
				shuffle($moves);

				$playStone->setMove($moves[0]->x, $move[0]->y);

				return $playStone;
			}
		}
		return false;
	}
*/
    public function getBestMove() {
    	$stone = new Stone(0, 0);
        $move = new Move(0, 1);
        $stone->setMove($move);
        

        //if ( $grid->moveAllowed(0, 1) ) {
	    //    $output = new Move(0, 1);
	    //}
	    //else {
	    //	$output = $grid->getRandomMove();
	    //}

        return $stone;
    }	
}



function initGridFromInput() {
    $grid = array();
    for($i=0; $i<ROWS; $i++) {
    	$grid[$i] = array();
    }
    $output = "";

    for ($j = 0; $j < ROWS; $j++) {
        fscanf(STDIN, "%d %d %d %d %d %d %d", $grid[$j][0], $grid[$j][1], $grid[$j][2], $grid[$j][3], $grid[$j][4], $grid[$j][5], $grid[$j][6]);
    }

    return new MyGrid($grid);
}




function start() {

	$grid = initGridFromInput();

	$currentPlayer = 1;

	$bot = new HexxagonBot($grid, $currentPlayer);

	$bestStone = $bot->getBestMove();
	$bestStone->printHexxagon();
}



start();