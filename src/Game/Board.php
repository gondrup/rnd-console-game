<?php

namespace App\Game;

use Symfony\Component\Console\Cursor;
use Symfony\Component\Console\Output\OutputInterface;

class Board
{
    private int $width;
    private int $height;

    public function __construct(int $width, int $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function init(OutputInterface $output, Cursor $cursor): void
    {
        $this->board = [];
        for ($i = 0; $i < $this->width; ++$i) {
            $this->board[$i] = array_fill(0, $this->height, 0);
        }
        $cursor->clearScreen();
        $cursor->moveToPosition(0, 0);

        $output->writeln('<background>┌──────────────────────────────────────────────────────────────────────────────┐</background>');
        for ($i = 0; $i < $this->height - 2; ++$i) {
            $output->writeln('<background>│                                                                              │</background>');
        }
        $output->writeln('<background>└──────────────────────────────────────────────────────────────────────────────┘</background>');
    }

    public function print(OutputInterface $output, Cursor $cursor, string $lines, Coordinate $topLeft, string $font = 'background'): void
    {
        $y = $topLeft->y;
        foreach (explode("\n", $lines) as $line) {
            $cursor->moveToPosition($topLeft->x, $y++);
            $output->write("<$font>$line</$font>");
        }
    }
}