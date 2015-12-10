<?php

namespace Msg\Commands;

use Msg\Repository\PresentationRepository;
use Msg\Repository\SectionRepository;
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
        $genericFS = new Filesystem($baseDirAdapter);
        $sectionRepository = new SectionRepository($genericFS);
        $pres = new PresentationRepository($genericFS, $sectionRepository);

        $adapter = new Local($baseDir. '/../web');
        $filesystem = new Filesystem($adapter);
        $filesystem->put(
            'index.html',
            $twig->render('basic.html.twig', ['pres' => $pres->get()])
        );

        $output->writeln('Success');
    }
}
