<?php

namespace Msg\Model;

use League\Flysystem\Filesystem;
use Symfony\Component\Yaml\Exception\ParseException;
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
        try {
            $yml = $this->filesystem->read('app/data/main.yml');
            if (!$yml) {
                throw new \Exception('Not a alid yaml');
            }
            $value = $parser->parse($yml);
        } catch (ParseException $e) {
            printf("Unable to parse the YAML string: %s", $e->getMessage());
        }

        return $value['presentation'];
    }
}
