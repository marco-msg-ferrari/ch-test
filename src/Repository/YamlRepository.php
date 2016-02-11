<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 10/12/15
 * Time: 14:43
 */

namespace Msg\Repository;

use League\Flysystem\Filesystem;
use Symfony\Component\Yaml\Parser;

class YamlRepository
{
    protected $filesystem;
    protected $basedir;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
        $this->basedir = 'app/data/';
    }

    protected function getFromYml(string $fileName): array
    {
        $parser = new Parser();

        $yml = $this->filesystem->read($this->basedir. $fileName);
        if ($yml === false) {
            throw new \Exception('Not a valid file');
        }
        return $parser->parse($yml);
    }
}
