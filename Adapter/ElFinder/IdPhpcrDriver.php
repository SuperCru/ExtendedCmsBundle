<?php
/**
 * This file is part of the SuperCruExtendedCmsBundle
 * @copyright (c) 2015, SuperCru LLC
 */
namespace SuperCru\ExtendedCmsBundle\Adapter\ElFinder;

use Doctrine\ODM\PHPCR\Document\Generic;
use Symfony\Cmf\Bundle\MediaBundle\Adapter\ElFinder\PhpcrDriver;
use Symfony\Cmf\Bundle\MediaBundle\Doctrine\Phpcr\File;
use Symfony\Cmf\Bundle\MediaBundle\HierarchyInterface;

/**
 * Overrides the stat function of the provided phpcr driver. It changes
 * the url field for objects returned from stat to have the url field set to the
 * id of the object.
 * 
 * @author Kaelin Jacobson <kaelin@supercru.com>
 * @since 1.0
 */
class IdPhpcrDriver extends PhpcrDriver
{

    /**
     * {@inheritdoc}
     */
    protected function _stat($path)
    {
        $stat = parent::_stat($path);

        /** @var File $doc */
        $doc = $this->dm->find(null, $path);

        if (!$doc) {
            return false;
        }

        if (!($doc instanceof HierarchyInterface || $doc instanceof Generic)) {
            return false;
        }

        $stat['url'] = $doc->getId();

        return $stat;
    }
}
