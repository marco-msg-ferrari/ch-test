<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 10/12/15
 * Time: 14:43
 */

namespace Msg\Repository;

use Msg\Model\Section;

class SectionRepository extends YamlRepository
{
    public function get(\string $sectionName): Section
    {
        $sectionData = $this->getFromYml($sectionName. '.yml');
        $sec = $this->createSection($sectionData);

        if (array_key_exists('subsections', $sectionData)) {
            $subsecs = $sectionData['subsections'];
            foreach ($subsecs as $subsec) {
                $sec->addSubSections($this->createSection($subsec));
            }
        }

        return $sec;
    }

    private function createSection(array $sectionData): Section
    {
        $sec = new Section();
        $sec->setTitle($sectionData['title']);
        $sec->setContent($sectionData['content']);
        $sec->setImg($sectionData['img']);

        return $sec;
    }
}
