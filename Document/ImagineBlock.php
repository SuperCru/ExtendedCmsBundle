<?php
/**
 * This file is part of the SuperCruExtendedCmsBundle
 * @copyright (c) 2015, SuperCru LLC
 */
namespace SuperCru\ExtendedCmsBundle\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use Symfony\Cmf\Bundle\BlockBundle\Doctrine\Phpcr\ImagineBlock as BaseImagineBlock;
use Symfony\Cmf\Bundle\MediaBundle\Doctrine\Phpcr\Image;

/**
 * Block class that adds ability to map an iamge document to the block
 *
 * @PHPCR\Document(referenceable=true, translator="attribute")
 * @author Kaelin Jacobson <kaelin@supercru.com>
 * @since 1.0
 */
class ImagineBlock extends BaseImagineBlock
{

    use \KMJ\ToolkitBundle\Traits\SlugifyTrait;

    /**
     * The image to link to the block
     * @PHPCR\ReferenceOne(targetDocument="Symfony\Cmf\Bundle\MediaBundle\Doctrine\Phpcr\Image")
     * @var Image
     */
    protected $imageRef;

    /**
     * The filter name to use to render the thumbnail of the image
     * @PHPCR\Field(type="string", nullable=true)
     * @var string
     */
    protected $thumbFilter;

    /**
     * The category for the image (used when displaying in a slideshow block)
     * @PHPCR\Field(type="string", nullable=true)
     * @var string
     */
    protected $category;

    /**
     * The filter name to use to render the full size version on the image
     * @PHPCR\Field(type="string", nullable=true)
     * @var string
     */
    protected $fullFilter;

    /**
     * Assigns the image to the block
     * @param Image $image
     * @return self
     */
    public function setImage($image = null)
    {
        $this->imageRef = $image;
        return $this;
    }

    /**
     * Updates the block name     
     */
    public function updateName()
    {
        $this->name = $this->slugify($this->label) . "-imagine-block";
    }

    /**
     * Get the value of The image to link to the block
     *
     * @return Image
     */
    public function getImageRef()
    {
        return $this->imageRef;
    }

    /**
     * Set the value of The image to link to the block
     *
     * @param Image imageRef
     *
     * @return self
     */
    public function setImageRef(Image $imageRef = null)
    {
        $this->imageRef = $imageRef;

        return $this;
    }

    /**
     * Get the value of The filter name to use to render the thumbnail of the image
     *
     * @return string
     */
    public function getThumbFilter()
    {
        return $this->thumbFilter;
    }

    /**
     * Set the value of The filter name to use to render the thumbnail of the image
     *
     * @param string thumbFilter
     *
     * @return self
     */
    public function setThumbFilter($thumbFilter)
    {
        $this->thumbFilter = $thumbFilter;

        return $this;
    }

    /**
     * Get the value of The category for the image (used when displaying in a slideshow block)
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of The category for the image (used when displaying in a slideshow block)
     *
     * @param string category
     *
     * @return self
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get the value of The filter name to use to render the full size version on the image 
     *
     * @return string
     */
    public function getFullFilter()
    {
        return $this->fullFilter;
    }

    /**
     * Set the value of The filter name to use to render the full size version on the image
     *
     * @param string fullFilter
     *
     * @return self
     */
    public function setFullFilter($fullFilter)
    {
        $this->fullFilter = $fullFilter;

        return $this;
    }
}
