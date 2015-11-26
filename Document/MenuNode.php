<?php
/**
 * This file is part of the SuperCruExtendedCmsBundle
 * @copyright (c) 2015, SuperCru LLC
 */
namespace SuperCru\ExtendedCmsBundle\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use Symfony\Cmf\Bundle\MenuBundle\Doctrine\Phpcr\MenuNode as BaseMenuNode;

/**
 * Menu node that supports role based access enumeration
 *
 * @PHPCR\Document(referenceable=true, translator="attribute")
 * @author Kaelin Jacobson <kaelin@supercru.com>
 * @since 1.0
 */
class MenuNode extends BaseMenuNode
{

    /**
     * The role for that should be required to see the menu item
     *
     * @PHPCR\Field(type="string", nullable=true)
     * @var string
     */
    private $addWhenGranted;

    /**
     * The role for that should be required to see the menu item
     *
     * @PHPCR\Field(type="string", nullable=true)
     * @var string
     */
    private $removeWhenGranted;


    /**
     * Get the value of The role for that should be required to see the menu item
     *
     * @return string
     */
    public function getAddWhenGranted()
    {
        return $this->addWhenGranted;
    }

    /**
     * Set the value of The role for that should be required to see the menu item
     *
     * @param string addWhenGranted
     *
     * @return self
     */
    public function setAddWhenGranted($addWhenGranted)
    {
        $this->addWhenGranted = $addWhenGranted;

        return $this;
    }

    /**
     * Get the value of The role for that should be required to see the menu item
     *
     * @return string
     */
    public function getRemoveWhenGranted()
    {
        return $this->removeWhenGranted;
    }

    /**
     * Set the value of The role for that should be required to see the menu item
     *
     * @param string removeWhenGranted
     *
     * @return self
     */
    public function setRemoveWhenGranted($removeWhenGranted)
    {
        $this->removeWhenGranted = $removeWhenGranted;

        return $this;
    }

}
