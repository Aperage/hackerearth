<?php

/*
 * Read input from stdin and provide input before running code

fscanf(STDIN, "%s\n", $name);
echo "Hi, ".$name;

echo "<pre>"; print_r($); echo "</pre>"; die();

*/

define('GRID_SIZE', 3);

class Move {
    public $x;
    public $y;
    public function __construct($x = -1, $y = -1) {
        $this->x = $x;
        $this->y = $y;
    }
}

class MyGrid {
    public $grid;
    public $currentPlayer;
    public $move;
    
    public function __construct($grid) {
        $this->grid = $grid;
    }

    public function getVerticalByLineForPlayer($line, $player) {
        $output = array();

        return $output;
    }

    public function getHorizontalByLineForPlayer($line, $player) {
        $output = array();

        return $output;
    }

    public function getDiagonaleByLineForPlayer($line, $player) {
        $output = array();

        return $output;
    }

    public function setCurrentPlayer($p) {
        $this->currentPlayer = $p;
    }

    public function emptyCenter() {
        return $this->grid[1][1] === 0;
    }

    public function moveAllowed($x, $y) {
        return $this->grid[$x][$y] === 0;
    }


    public function hasWinningMove() {
        $this->move = false;
        $this->move = $this->getWinningMoveForPlayerVertically(1);

        if( !$this->move ) {
            $this->move = $this->getWinningMoveForPlayerHorizontally(1);
        }

        if( !$this->move ) {
            $this->move = $this->getWinningMoveForPlayerDiagonally(2);
        }

        return !empty($this->move);
    }

    public function mustPreventLost() {
        $this->move = false;
        $this->move = $this->getWinningMoveForPlayerVertically(2);

        if( !$this->move ) {
            $this->move = $this->getWinningMoveForPlayerHorizontally(2);
        }

        if( !$this->move ) {
            $this->move = $this->getWinningMoveForPlayerDiagonally(2);
        }

        return $this->move != false;
    }


    public function getWinningMoveForPlayerDiagonally($playerNumber) {
        $output = false;


        $emptyMoves = array();
        $playerMoves = array();

        // diagonale 1
        $moves = array( new Move(0,0), new Move(1,1), new Move(2,2) );
        foreach( $moves as $move ) {
            //echo "<pre>"; print_r($move); echo "</pre>"; 
            if( $this->grid[$move->x][$move->y] === $playerNumber) {
                $playerMoves []= new Move($move->x, $move->y);  
            } 
            else if ($this->grid[$move->x][$move->y] === 0 ) {
                $emptyMoves []= new Move($move->x, $move->y);
            }

        }


        if( count($playerMoves) == 2 && count($emptyMoves) == 1 ) {
            $output = $emptyMoves[0];
            return $output;
        }

        $emptyMoves = array();
        $playerMoves = array();

        // diagonale 2
        $moves = array( new Move(0,2), new Move(1,1), new Move(2,0) );
        foreach( $moves as $move ) {
            if( $this->grid[$move->x][$move->y] === $playerNumber) {
                $playerMoves []= new Move($move->x, $move->y);  
            } 
            else if ($this->grid[$move->x][$move->y] === 0 ) {
            $emptyMoves []= new Move($move->x, $move->y);
            }

        }

        if( count($playerMoves) == 2 && count($emptyMoves) == 1 ) {
            $output = $emptyMoves[0];
            return $output;
        }

        return $output;
   }



   public function getWinningMoveForPlayerVertically($playerNumber) {
        $output = false;


        for ($x = 0; $x < GRID_SIZE; $x++) {

            $emptyMoves = array();
            $playerMoves = array();

            for ($y = 0; $y < GRID_SIZE; $y++) {
                if( $this->grid[$x][$y] === $playerNumber) {
                    $playerMoves []= new Move($x, $y);  
                } 
                else if ($this->grid[$x][$y] === 0 ) {
                    $emptyMoves []= new Move($x, $y);
                }
            }

            if( count($playerMoves) == 2 && count($emptyMoves) == 1 ) {
                $output = $emptyMoves[0];
                return $output;
            }
        }
            
        return $output;
    }

    public function getWinningMoveForPlayerHorizontally($playerNumber) {
        $output = false;


        for ($y = 0; $y < GRID_SIZE; $y++) {

            $emptyMoves = array();
            $playerMoves = array();

            for ($x = 0; $x < GRID_SIZE; $x++) {
                if( $this->grid[$x][$y] === $playerNumber) {
                    $playerMoves []= new Move($x, $y);  
                } 
                else if ($this->grid[$x][$y] === 0 ) {
                    $emptyMoves []= new Move($x, $y);
                }
            }

            if( count($playerMoves) == 2 && count($emptyMoves) == 1 ) {
                $output = $emptyMoves[0];
                return $output;
            }
        }
            
        return $output;
    }



    public function getRandomMove() {
        $output = new Move();
        // Pour cette strat, on fait juste scanner la grid au hazard et si la case est libre, on joue
        while(true) {

            // initialiser les coord selon le hasard dans les limites de notre grid (% GRID_SIZE si GRID_SIZE=3 donne tjrs 0, 1, 2)
            $x = rand(0,2);
            $y = rand(0,2);

            // la case est libre, on print les coord de la case actuelle et on sort de la boucle
            if ($this->grid[$x][$y] === 0) {
                $output = new Move ($x, $y);
                break;
            }
        }
        return $output;
    }
}

function initGridFromInput() {
    $grid = array();
    $grid[0] = array();
    $grid[1] = array();
    $grid[2] = array();

    $output = "";

    for ($j = 0; $j < GRID_SIZE; $j++) {
        fscanf(STDIN, "%d %d %d", $grid[0][$j], $grid[1][$j], $grid[2][$j]);
    }
    return new MyGrid($grid);
}


function printMoveOutput($move) {
    echo $move->x . " " . $move->y;
}




function getBestMove($grid) {
    $output = new Move();

    if( $grid->hasWinningMove() ) {
        $output = $grid->move;
    }
    else if( $grid->mustPreventLost() ) {
        $output = $grid->move;
    }
    else if( $grid->emptyCenter() ) {
        $output = new Move(1, 1);
    }
    else if( $grid->moveAllowed(0, 0) ) {
        $output = new Move(0, 0);
    }     
    else {
        $output = $grid->getRandomMove();
    }

    return $output;
}




/*
*
*
*
*   LANCEMENT DU JEU !!
*
*
*/

$grilleDeJeu = initGridFromInput();
$player = 1; //initPlayer();
$grilleDeJeu->setCurrentPlayer($player);

//$bestMove = getRandomMoveFromGrid($grilleDeJeu);
$bestMove = getBestMove($grilleDeJeu);
//$bestMove = getRandomMoveFromGrid($grilleDeJeu);

printMoveOutput($bestMove);

//echo "<pre>"; print_r($bestMove); echo "</pre>";
//echo "<pre>"; print_r($grilleDeJeu); echo "</pre>"; die();
