<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 10/12/15
 * Time: 15:42
 */

namespace Msg\Tests\Repository;

use Msg\Repository\SectionRepository;
use Prophecy\Argument;

class SectionRepositoryTest extends \PHPUnit_Framework_TestCase
{
    public function testGetPresentation()
    {
        $filesystem = $this->prophesize('League\Flysystem\Filesystem');
        $testYml = "title: 'Test'\ncontent: content value\nimg: imgname.jpg";
        $filesystem->read(Argument::any())->willReturn($testYml)->shouldBeCalled();

        $repo = new SectionRepository($filesystem->reveal());
        $sec = $repo->get('test');

        $this->assertInstanceOf('Msg\Model\Section', $sec);
        $this->assertEquals('Test', $sec->getTitle());
        $this->assertEquals('content value', $sec->getContent());
        $this->assertEquals('imgname.jpg', $sec->getImg());
    }
}
