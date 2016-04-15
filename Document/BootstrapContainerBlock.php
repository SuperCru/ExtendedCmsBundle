<?php
/**
 * This file is part of the SuperCruCoursatyBundle.
 *
 * @copyright (c) 2015, SuperCru LLC
 */

namespace SuperCru\ExtendedCmsBundle\Document;

use Symfony\Cmf\Bundle\BlockBundle\Doctrine\Phpcr\ContainerBlock as BaseContainerBlock;
use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;

/**
 * Block document that modifies the default container block to conform better with the theme.
 *
 * @PHPCR\Document(referenceable=true, translator="attribute")
 *
 * @author Kaelin Jacobson <kaelin@supercru.com>
 *
 * @since 1.0
 */
class BootstrapContainerBlock extends BaseContainerBlock
{

    /**
     * @PHPCR\Field(type="string", nullable=true)
     * @var string
     */
    private $title;

    /**
     * Sets default settings for the block.
     *
     * @param string $name
     */
    public function __construct($name = null)
    {
        parent::__construct($name);

        $this->settings = array_merge($this->settings, [
            'no_padding' => false,
            "full_width" => false,
            "per_row" => 1,
        ]);
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }
}
