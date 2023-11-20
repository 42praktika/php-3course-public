<?php

namespace App\Command;

use App\Repository\StudentsRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:show-students',
    description: 'Show students list',
)]
class ShowStudentsCommand extends Command
{
    private StudentsRepository $studentsRepository;

    public function __construct(StudentsRepository $studentsRepository)
    {
        parent::__construct();
        $this->studentsRepository = $studentsRepository;
    }

    protected function configure(): void
    {
        /* $this
                ->addArgument('arg1', InputArgument::REQUIRED, 'Argument description')
                ->addArgument('arg2', InputArgument::OPTIONAL, 'Argument description2');*/
            $this ->addOption('option1', "o", InputOption::VALUE_NEGATABLE, 'Option description')
            ;
    }

    private function YieldStudent() {
        $students = $this->studentsRepository->findAll();
        foreach ($students as $student) {
            yield $student->getFullName();
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
      /*  $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));

        }

        if ($input->getOption('option1')) {
            // ...
        }
*/

       // $io->writeln($this->YieldStudent() );
        $style = new OutputFormatterStyle('white', 'yellow', ["bold", "blink"]);
        $io->getFormatter()->setStyle("hate", $style);
        $io->writeln("<hate>Test hate style</hate>");
      //  $io->writeln($input->getOption("option1"));
        //$io->success('You have a new command! Now make it your own! Pass --help to see your options.');
        $output->writeln("https://sd-praktika.ru");
        return Command::SUCCESS;
    }
}
