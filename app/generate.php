#!/usr/bin/env php
<?php

require __DIR__.'/../vendor/autoload.php';

use Msg\Commands\GenerateCommand;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new GenerateCommand());
$application->run();
