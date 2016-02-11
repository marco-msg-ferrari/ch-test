<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 10/12/15
 * Time: 14:47
 */

namespace Msg\Model;

class Presentation
{
    protected $title;
    protected $sections;

    public function __construct()
    {
        $this->title = '';
        $this->sections = new \ArrayObject();
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return \ArrayObject
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * @param Section $section
     */
    public function addSection(Section $section)
    {
        $this->sections->append($section);
    }
}
