<?php

namespace Msg\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;
use Msg\Model\DataModel;

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


        $baseDirAdapter = new Local($baseDir. '/../');
        $presentationData = new DataModel(new Filesystem($baseDirAdapter));

        $adapter = new Local($baseDir. '/../web');
        $filesystem = new Filesystem($adapter);
        $filesystem->put(
            'index.html',
            $twig->render('basic.html.twig', ['pres' => $presentationData->getPresentation()])
        );

        $output->writeln('Success');
    }
}

