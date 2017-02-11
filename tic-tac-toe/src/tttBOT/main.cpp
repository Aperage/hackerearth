#include<iostream>
#include<cstdio>
#include<cstdlib>
#include<ctime>
using namespace std;

#define GRID_SIZE 3

int main()
{
    int grid[GRID_SIZE][GRID_SIZE], player;

    // Scan previous state
    for (int j = 0; j < GRID_SIZE; j++) {
        for (int i = 0; i < GRID_SIZE; i++) {
            scanf("%d", &grid[i][j]);
        }
    }

    scanf("%d", &player);

    srand(time(NULL));

    while(true) {
        int x = rand() % GRID_SIZE;
        int y = rand() % GRID_SIZE;

        if (grid[x][y] == 0) {
            printf("%d %d", x, y);
            break;
        }
    }

    return 0;
}
