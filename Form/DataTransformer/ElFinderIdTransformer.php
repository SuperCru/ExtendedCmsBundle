<?php
/**
 * This file is part of the SuperCruExtendedCmsBundle
 * @copyright (c) 2015, SuperCru LLC
 */
namespace SuperCru\ExtendedCmsBundle\Form\DataTransformer;

use Doctrine\ODM\PHPCR\DocumentManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Translates a phpcr repository id to the object
 *
 * @author Kaelin Jacobson <kaelin@supercru.com>
 * @since 1.0
 */
class ElFinderIdTransformer implements DataTransformerInterface
{

    /**
     * The document manager
     * 
     * @var DocumentManager
     */
    private $manager;

    /**
     * Basic constructor
     * 
     * @param DocumentManager $manager
     */
    public function __construct(DocumentManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($id)
    {
        if ($id === null) {
            return;
        }

        $document = $this->manager->find(null, $id);

        if ($document === null) {
            throw new TransformationFailedException(sprintf("An document with id: %s does not exist", $id));
        }
        
        return $document;
    }

    /**
     * {@inheritdoc}
     */
    public function transform($document)
    {        
        if ($document === null) {
            return;
        }

        return $document->getId();
    }
}
