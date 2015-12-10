<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 10/12/15
 * Time: 14:43
 */

namespace Msg\Repository;

use League\Flysystem\Filesystem;
use Msg\Model\Presentation;

class PresentationRepository extends YamlRepository
{
    protected $sectionRepo;

    public function __construct(Filesystem $filesystem, SectionRepository $sectionRepository)
    {
        parent::__construct($filesystem);
        $this->sectionRepo = $sectionRepository;
    }

    public function get(): Presentation
    {
        $value = $this->getFromYml('main.yml');

        $pres = new Presentation();
        $pres->setTitle($value['presentation']['title']);

        foreach ($value['presentation']['sections'] as $sectionName) {
            $pres->addSection($this->sectionRepo->get($sectionName));
        }

        return $pres;
    }
}
