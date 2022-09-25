<?php

namespace App\Game;

use Symfony\Component\Console\Cursor;
use Symfony\Component\Console\Output\OutputInterface;

class Game
{
    const NUM_GUESSES = 8;

    private Board $board;

    private string $word;
    private int $remainingGuesses = self::NUM_GUESSES;
    private array $lettersGuessed;

    public function __construct(int $width, int $height)
    {
        $this->board = new Board($width, $height);
    }

    public function run($inputStream, OutputInterface $output, Cursor $cursor): void
    {
        $this->board->init($output, $cursor);
        $this->intro($output, $cursor);

        // Wait for any key
        while (!fread($inputStream, 1)) {
            usleep(1000);
        }

        $this->newGame($inputStream, $output, $cursor);
    }

    private function wordFound(): bool
    {
        return count($this->lettersGuessed) > 0 && !in_array(null, $this->lettersGuessed);
    }

    private function clearBoard(OutputInterface $output, Cursor $cursor): void
    {
        // Clear the board
        for ($i = 1; $i < 23; $i++) {
            $this->board->print($output, $cursor, '<background>                                                                              </background>', new Coordinate(2, $i));
        }
    }

    private function intro(OutputInterface $output, Cursor $cursor): void
    {
        $this->board->print($output, $cursor, Images::HANGMAN, new Coordinate(19, 3), 'title');

        $this->board->print($output, $cursor, '--- Press any key to start ---', new Coordinate(25, 21));
    }

    private function getWord(): void
    {
        // List of words grabbed from API:
        // https://random-word-api.herokuapp.com/word?length=8&number=100

        $words = [
            'valleyed', 'oosphere', 'rehashed', 'cathodic', 'braciole', 'myoscope', 'bullaces', 'reevoked',
            'careened', 'diverged', 'symbiote', 'leafiest', 'strutter', 'basseted', 'virilely', 'vitiated',
            'medusoid', 'bicycler', 'retastes', 'langlauf', 'neurulas', 'unslings', 'underuse', 'autosome',
            'minicars', 'negliges', 'tetchily', 'emigrate', 'hopeless', 'sublated', 'crannoge', 'strickle',
            'bylining', 'caramels', 'colander', 'augurers', 'ungulate', 'marchesi', 'monsieur', 'unneeded',
            'headline', 'domineer', 'colewort', 'docketed', 'precaval', 'aliasing', 'sanative', 'pailfuls',
            'triacids', 'thriving', 'oxazepam', 'incensed', 'tiderips', 'acrasins', 'browsing', 'columned',
            'alleyway', 'ecaudate', 'angstrom', 'maquette', 'radicand', 'bustiest', 'cleaning', 'disseize',
            'entasias', 'lanosity', 'temperas', 'illusory', 'weirdies', 'oxidised', 'vowelize', 'mandolin',
            'vanillas', 'ratanies', 'tarriers', 'halloaed', 'lustrate', 'pisolith', 'reseeded', 'overfoul',
            'inconnus', 'endoderm', 'lithiums', 'despises', 'vineries', 'deanship', 'latching', 'mercapto',
            'salchows', 'westings', 'cavilers', 'analysts', 'vigoroso', 'trooping', 'subshrub', 'hooklike',
            'depended', 'wanderoo', 'swingles', 'referred',
        ];

        $this->word = $words[array_rand($words)];
    }

    private function drawLetters(OutputInterface $output, Cursor $cursor): void
    {
        $i = 0;
        foreach ($this->lettersGuessed as $letter) {
            $this->board->print($output, $cursor, Images::getImageForLetter($letter), new Coordinate(3+($i * 6), 2), 'title');
            $i++;
        }
    }

    private function drawMan(OutputInterface $output, Cursor $cursor): void
    {
        $this->board->print($output, $cursor, Images::getImageForMan($this->remainingGuesses), new Coordinate(51, 2), 'title');
    }

    private function nextGuess($inputStream, OutputInterface $output, Cursor $cursor): void
    {
        $this->board->print($output, $cursor, 'Enter next guess:', new Coordinate(3, 22), 'question');

        // Wait for any key
        while (!$input = fread($inputStream, 1)) {
            usleep(1000);
        }

        $this->board->print($output, $cursor, strtoupper($input), new Coordinate(21, 22), 'input');

        usleep(500000);

        $this->board->print($output, $cursor, ' ', new Coordinate(21, 22), 'input');

        $length = strlen($this->word);
        $foundALetter = false;
        for ($i = 0; $i < $length; $i++) {
            if ($this->lettersGuessed[$i] === null && strtoupper($input) === strtoupper($this->word[$i])) {
                $this->lettersGuessed[$i] = strtoupper($this->word[$i]);
                $foundALetter = true;
            }
        }

        if ($foundALetter) {
            $this->drawLetters($output, $cursor);
        } else {
            $this->remainingGuesses--;
            $this->drawMan($output, $cursor);
        }
    }

    private function endGame(OutputInterface $output, Cursor $cursor): void
    {
        $this->clearBoard($output, $cursor);

        if ($this->remainingGuesses > 0) {
            $this->board->print($output, $cursor, 'YOU WIN!', new Coordinate(37, 9), 'title');
        } else {
            $this->board->print($output, $cursor, 'YOU LOSE!', new Coordinate(36, 9), 'title');
        }

        $this->board->print($output, $cursor, '<question>WORD WAS:</question> <input>'.strtoupper($this->word).'</input>', new Coordinate(32, 12));

        usleep(500000);

        $this->board->print($output, $cursor, '--- Press any key to play again ---', new Coordinate(23, 21));
    }

    private function newGame($inputStream, OutputInterface $output, Cursor $cursor): void
    {
        $this->clearBoard($output, $cursor);
        $this->getWord();
        $length = strlen($this->word);
        $this->remainingGuesses = self::NUM_GUESSES;
        $this->lettersGuessed = array_fill(0, $length, null);

        $this->drawLetters($output, $cursor);
        $this->drawMan($output, $cursor);

        while (!$this->wordFound() && $this->remainingGuesses > 0) {
            $this->nextGuess($inputStream, $output, $cursor);
        }

        usleep(500000);
        $this->endGame($output, $cursor);

        // Wait for any key to start again
        while (!fread($inputStream, 1)) {
            usleep(1000);
        }

        $this->newGame($inputStream, $output, $cursor);
    }
}