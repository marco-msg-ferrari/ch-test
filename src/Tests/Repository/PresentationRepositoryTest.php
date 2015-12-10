<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 10/12/15
 * Time: 15:42
 */

namespace Msg\Tests\Repository;

use Msg\Model\Section;
use Msg\Repository\PresentationRepository;
use Prophecy\Argument;

class PresentationRepositoryTest extends \PHPUnit_Framework_TestCase
{
    public function testGetPresentation()
    {
        $filesystem = $this->prophesize('League\Flysystem\Filesystem');
        $testYml = "presentation:\n    title: 'Test'\n    sections:\n        - chapter1";
        $filesystem->read(Argument::any())->willReturn($testYml)->shouldBeCalled();
        $sectionRepo = $this->prophesize('Msg\Repository\SectionRepository');
        $section = new Section();
        $section->setTitle('test sec');
        $sectionRepo->get(Argument::any())->willReturn($section)->shouldBeCalled();

        $repo = new PresentationRepository($filesystem->reveal(), $sectionRepo->reveal());
        $pres = $repo->get();

        $this->assertInstanceOf('Msg\Model\Presentation', $pres);
        $this->assertEquals('Test', $pres->getTitle());
        $this->assertInstanceOf('ArrayObject', $pres->getSections());
        $this->assertEquals($section, $pres->getSections()->offsetGet(0));
    }
}
