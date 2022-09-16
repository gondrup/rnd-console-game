<?php

namespace App\Game;

use Symfony\Component\Console\Cursor;
use Symfony\Component\Console\Output\OutputInterface;

class Game
{
    private Board $board;

    public function __construct(int $width, int $height)
    {
        $this->board = new Board($width, $height);
    }

    public function run($inputStream, OutputInterface $output, Cursor $cursor): void
    {
        $this->board->init($output, $cursor);
        $this->intro($inputStream, $output, $cursor);
    }

    private function intro($inputStream, OutputInterface $output, Cursor $cursor): void
    {
        $this->board->print($output, $cursor, Images::HANGMAN, new Coordinate(19, 3), 'title');

        $this->board->print($output, $cursor, '--- Press any key to start ---', new Coordinate(25, 21));
        /*
        while (!$next = fread($inputStream, 1)) {
            usleep(1000);
        }

        for ($i = 6; $i < 18; $i += 2) {
            $this->board->print($output, $cursor, '                                                                              ', new Coordinate(2, $i));
            usleep(200000);
        }

        for ($i = 7; $i < 17; $i += 2) {
            $this->board->print($output, $cursor, '                                                                              ', new Coordinate(2, $i));
            usleep(200000);
        }
        $this->board->print($output, $cursor, '                                                                              ', new Coordinate(2, 17));
        $this->board->print($output, $cursor, '                                                                              ', new Coordinate(2, 19));
        */
        sleep(1);
    }
}