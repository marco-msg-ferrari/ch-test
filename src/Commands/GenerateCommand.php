<?php

namespace Msg\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('presentation:dump')
            ->setDescription('Dump files')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $baseDir = dirname(dirname(__FILE__));
        $loader = new \Twig_Loader_Filesystem($baseDir. '/../app/Resources/templates/');
        $twig = new \Twig_Environment($loader);

        $output->writeln($twig->render('basic.html.twig', ['the' => 'variables', 'go' => 'here']));
    }
}

