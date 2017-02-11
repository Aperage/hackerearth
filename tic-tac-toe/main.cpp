#include<iostream>
#include<cstdio>
#include<cstdlib>
#include<ctime>
using namespace std;

// Grosseur de la GRID de tic tac toe
#define GRID_SIZE 3


/*
*   INPUT EXAMPLE
*   1 0 0
*   0 0 0
*   0 0 0
*   2
*
*   OUTPUT EXAMPLE
*   1 1
*/

void basicRandomStrat(int[GRID_SIZE][GRID_SIZE], int[]);


int main()
{
    // initialise les variables utilisables
    int bestMove[2];
    int grid[GRID_SIZE][GRID_SIZE], player;

    // Scan les 9 cases de l'input (3x3) pour initialiser notre grid de tic tac toe
    for (int j = 0; j < GRID_SIZE; j++) {
        for (int i = 0; i < GRID_SIZE; i++) {
            scanf("%d", &grid[i][j]);
        }
    }
    


    // Scan la prochaine valeur qui sera le joueur qui doit jouer
    scanf("%d", &player);

    

    // Pour cette strat, on fait juste scanner la grid au hazard et si la case est libre, on joue
    basicRandomStrat(grid, bestMove);



    printf("%d %d", bestMove[0], bestMove[1]);

    // quitte notre programme
    return 0;
}




void basicRandomStrat(int grid[GRID_SIZE][GRID_SIZE], int bestMove[2]) {
    
    int move[2];

    // initialise le random avec le microtimer actuel
    srand(time(NULL));

    while(true) {

        // initialiser les coord selon le hasard dans les limites de notre grid (% GRID_SIZE si GRID_SIZE=3 donne tjrs 0, 1, 2)
        int x = rand() % GRID_SIZE;
        int y = rand() % GRID_SIZE;

        // la case est libre, on print les coord de la case actuelle et on sort de la boucle
        if (grid[x][y] == 0) {
            //printf("%d %d", x, y);
            move = {x, y};
            break;
        }
    }

    if( true ) {
        bestMove = move;
    }
}