<?php
/**
 * This file is part of the SuperCruExtendedCmsBundle
 * @copyright (c) 2015, SuperCru LLC
 */
namespace SuperCru\ExtendedCmsBundle\Form\Type;

use Doctrine\ODM\PHPCR\DocumentManager;
use FM\ElfinderBundle\Form\Type\ElFinderType;
use SuperCru\ExtendedCmsBundle\Form\DataTransformer\ElFinderIdTransformer;
use Symfony\Cmf\Bundle\MediaBundle\Doctrine\Phpcr\Image;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class that allows you to select documents from ElFinder and link that document to another
 *
 * @author Kaelin Jacobson <kaelin@supercru.com>
 * @since 1.0
 */
class ElFinderIdType extends ElFinderType
{

    /**
     * The document manager
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
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->setCompound(false);
        $builder->addViewTransformer(new ElFinderIdTransformer($this->manager)); 
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return "form";
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return "elfinder_id";
    }
    
    public function getBlockPrefix()
    {
        return $this->getName();
    }
}
