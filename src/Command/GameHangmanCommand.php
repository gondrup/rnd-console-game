<?php

namespace App\Command;

use App\Game\Game;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Cursor;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\StreamableInputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(
    name: 'game:hangman',
    description: 'Start a game of hangman in the console',
)]
class GameHangmanCommand extends Command
{
    public function __construct(
        private HttpClientInterface $httpClient
    ){
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if ($input instanceof StreamableInputInterface && $stream = $input->getStream()) {
            $inputStream = $stream;
        } else {
            $inputStream = STDIN;
        }

        stream_set_blocking($inputStream, false);
        $sttyMode = shell_exec('stty -g');
        shell_exec('stty -icanon -echo');

        $cursor = new Cursor($output);
        $cursor->hide();

        $output->getFormatter()->setStyle('title', new OutputFormatterStyle('yellow', 'black', ['bold']));
        $output->getFormatter()->setStyle('background', new OutputFormatterStyle('cyan', 'black'));
        $output->getFormatter()->setStyle('question', new OutputFormatterStyle('white', 'black', ['bold']));
        $output->getFormatter()->setStyle('input', new OutputFormatterStyle('white', 'black'));

        $game = new Game($this->httpClient, 80, 24);
        $game->run($inputStream, $output, $cursor);

        $cursor->show();

        stream_set_blocking($inputStream, true);
        shell_exec(sprintf('stty %s', $sttyMode));

        return Command::SUCCESS;
    }
}
