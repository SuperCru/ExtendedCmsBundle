<?php
/**
 * This file is part of the SuperCruExtendedCmsBundle
 * @copyright (c) 2015, SuperCru LLC
 */
namespace SuperCru\ExtendedCmsBundle\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;

/**
 * Site document
 * @author Kaelin Jacobson <kaelin@supercru.com>
 * @since 1.0
 * @PHPCR\Document()
 */
class Site
{

    /**
     * The Id for the document
     *
     * @PHPCR\Id()
     * @var string
     */
    protected $id;

    /**
     * The page document that should be the homepage
     * @PHPCR\ReferenceOne()
     * @var mixed
     */
    protected $homepage;

    /**
     * The footer container of the site
     * 
     * @PHPCR\ReferenceOne(cascade={"all"})
     * @var mixed
     */
    protected $footer;

    /**
     * The name of the document
     * @PHPCR\Nodename()
     * @var string
     */
    protected $name;

    /**
     * The pages of the site
     * @PHPCR\Children()
     * @var array
     */
    protected $pages;

    /**
     * Basic constructor. Initializes the name to 'Site' as there is only one
     */
    public function __construct()
    {
        $this->name = "Site";
    }

    /**
     * Get the value of The Id for the document
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of The Id for the document 
     * 
     * @param string id
     * 
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of The page document that should be the homepage
     *
     * @return mixed
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * Set the value of The page document that should be the homepage
     *
     * @param mixed homepage
     *
     * @return self
     */
    public function setHomepage($homepage)
    {
        $this->homepage = $homepage;

        return $this;
    }

    /**
     * Get the value of The name of the document
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of The name of the document
     *
     * @param string name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of The pages of the site
     *
     * @return array
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Set the value of The pages of the site
     *
     * @param array pages
     *
     * @return self
     */
    public function setPages(array $pages)
    {
        $this->pages = $pages;

        return $this;
    }

    public function getFooter()
    {
        return $this->footer;
    }

    public function setFooter($footer)
    {
        $this->footer = $footer;
        return $this;
    }
}
