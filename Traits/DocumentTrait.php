<?php
/**
 * This file is part of the SuperCruExtendedCmsBundle
 * @copyright (c) 2015, SuperCru LLC
 */
namespace SuperCru\ExtendedCmsBundle\Traits;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use Symfony\Cmf\Bundle\SeoBundle\Doctrine\Phpcr\SeoMetadata;

/**
 * Trait for basic page properties
 *
 * @author Kaelin Jacobson <kaelin@supercru.com>
 * @since 1.0
 */
trait DocumentTrait
{

    /**
     * The ID of the page
     * @PHPCR\Id()
     * @var type
     */
    protected $id;

    /**
     * The parent document
     *
     * @PHPCR\ParentDocument()
     * @var mixed
     */
    protected $parent;

    /**
     * The routes for the document
     * @PHPCR\Referrers(
     *     referringDocument="Symfony\Cmf\Bundle\RoutingBundle\Doctrine\Phpcr\Route",
     *     referencedBy="content"
     * )
     * @var array
     */
    protected $routes;

    /**
     * The locale of the document
     * @PHPCR\Locale()
     * @var string
     */
    protected $locale;

    /**
     * The children of the document
     * @var array|null
     * @PHPCR\Children()
     */
    protected $children;

    /**
     * The last part of the URL
     * @var string
     * @PHPCR\Field(type="string")
     */
    protected $lastUrl;

    /**
     * The SEO metadata for the page
     * @PHPCR\Child()
     * @var SeoMetadata
     */
    protected $seoMetadata;

    /**
     * The title of the page
     *
     * @PHPCR\Nodename()
     * @var string
     */
    protected $title;

    /**
     * The tagline for the page
     * @PHPCR\Field(type="string", nullable=true, translated=true)
     * @var string
     */
    protected $tagline;

    /**
     * Creates a menu item during creation if true
     * @var boolean
     */
    protected $createMenu = false;

    /**
     * Gets the full url
     * @return string
     */
    public function getUrl()
    {
        if ($this->getParent() !== null && method_exists($this->getParent(), "getUrl")) {
            return $this->getParent()->getUrl() . "/" . $this->lastUrl;
        } else {
            return $this->lastUrl;
        }
    }

    /**
     * Get the value of The ID of the page
     *
     * @return type
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of The parent document
     *
     * @return self
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set the value of The parent document
     *
     * @param mixed parent
     *
     * @return self
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get the value of The routes for the document
     *
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Set the value of The routes for the document
     *
     * @param array routes
     *
     * @return self
     */
    public function setRoutes(array $routes)
    {
        $this->routes = $routes;

        return $this;
    }

    /**
     * Get the value of The locale of the document
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set the value of The locale of the document
     *
     * @param string locale
     *
     * @return self
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get the value of The children of the document
     *
     * @return array|null
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set the value of The children of the document
     *
     * @param array|null children
     *
     * @return self
     */
    public function setChildren($children)
    {
        $this->children = $children;

        return $this;
    }

    /**
     * Get the value of The last part of the URL
     *
     * @return string
     */
    public function getLastUrl()
    {
        return $this->lastUrl;
    }

    /**
     * Set the value of The last part of the URL
     *
     * @param string lastUrl
     *
     * @return self
     */
    public function setLastUrl($lastUrl)
    {
        $this->lastUrl = $lastUrl;

        return $this;
    }

    /**
     * Get the value of The SEO metadata for the page
     *
     * @return SeoMetadata
     */
    public function getSeoMetadata()
    {
        return $this->seoMetadata;
    }

    /**
     * Set the value of The SEO metadata for the page
     *
     * @param SeoMetadata seoMetadata
     *
     * @return self
     */
    public function setSeoMetadata($seoMetadata)
    {
        $this->seoMetadata = $seoMetadata;

        return $this;
    }

    /**
     * Get the value of The title of the page
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of The title of the page
     *
     * @param string title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of The tagline for the page
     *
     * @return string
     */
    public function getTagline()
    {
        return $this->tagline;
    }

    /**
     * Set the value of The tagline for the page
     *
     * @param string tagline
     *
     * @return self
     */
    public function setTagline($tagline)
    {
        $this->tagline = $tagline;

        return $this;
    }

    /**
     * Get the value of Creates a menu item during creation if true
     *
     * @return boolean
     */
    public function getCreateMenu()
    {
        return $this->createMenu;
    }

    /**
     * Set the value of Creates a menu item during creation if true
     *
     * @param boolean createMenu
     *
     * @return self
     */
    public function setCreateMenu($createMenu)
    {
        $this->createMenu = $createMenu;

        return $this;
    }
}
