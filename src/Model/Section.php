<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 10/12/15
 * Time: 14:51
 */

namespace Msg\Model;

class Section
{
    protected $title;
    protected $content;
    protected $img;
    protected $subSections;

    public function __construct()
    {
        $this->subSections = new \ArrayObject();
    }

    /**
     * @return \ArrayObject
     */
    public function getSubSections()
    {
        return $this->subSections;
    }

    /**
     * @param Section $subSection
     */
    public function addSubSections(Section $subSection)
    {
        $this->subSections->append($subSection);
    }

    /**
     * @return mixed
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param mixed $img
     */
    public function setImg($img)
    {
        $this->img = $img;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getType()
    {
        if (is_array($this->content)) {
            return 'list';
        }
        return 'text';
    }
}
