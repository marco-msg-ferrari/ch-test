<?php

namespace Msg\Model;

use League\Flysystem\Filesystem;
use Symfony\Component\Yaml\Parser;

class DataModel
{
    protected $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function getPresentation(): array
    {
        $parser = new Parser();

        $yml = $this->filesystem->read('app/data/main.yml');
        if ($yml === false) {
            throw new \Exception('Not a valid file');
        }
        $value = $parser->parse($yml);

        return $value['presentation'];
    }
}
