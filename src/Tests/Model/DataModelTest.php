<?php

namespace Msg\Tests\Model;

use Msg\Model\DataModel;
use Prophecy\Argument;

class DataModelTest extends \PHPUnit_Framework_TestCase
{
    public function testGetPresentation() {

        $filesystem = $this->prophesize('League\Flysystem\Filesystem');
        $testYml = "presentation:\n    title: 'Test'\n    chapters:\n        - chapter1";
        $filesystem->read(Argument::any())->willReturn($testYml)->shouldBeCalled();

        $dataModel = new DataModel($filesystem->reveal());
        $pres = $dataModel->getPresentation();

        $this->assertInternalType('array', $pres);
        $this->assertArrayHasKey('title', $pres);
        $this->assertEquals('Test', $pres['title']);
        $this->assertArrayHasKey('chapters', $pres);
    }
}
