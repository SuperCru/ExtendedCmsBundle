<?php
/**
 * This file is part of the SuperCruExtendedCmsBundle
 * @copyright (c) 2015, SuperCru LLC
 */
namespace SuperCru\ExtendedCmsBundle\Admin;

use Symfony\Cmf\Bundle\BlockBundle\Admin\Imagine\ImagineBlockAdmin as BaseAdmin;

/**
 * Admin class for ImagineBlock
 *
 * @author Kaelin Jacobson <kaelin@supercru.com>
 * @since 1.0
 */
class ImagineBlockAdmin extends BaseAdmin
{

    /**
     * {@inheritdoc}
     */
    public function preUpdate($object)
    {
        $this->prePersist($object);
    }

    /**
     * {@inheritdoc}
     */
    public function prePersist($object)
    {
        if ($object->getParentDocument() === null) {
            $object->setParentDocument($parent = $this->getModelManager()->find(null, "/cms/content/blocks/imagine"));
        }

        $object->updateName();
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(\Sonata\AdminBundle\Form\FormMapper $formMapper)
    {
        if (null === $this->getParentFieldDescription()) {
            $formMapper
                ->with('form.group_general')
                ->add(
                    'parentDocument', 'doctrine_phpcr_odm_tree', array('root_node' => $this->getRootPath(), 'choice_list' => array(), 'select_root_node' => true)
                )
                ->add('name', 'text')
                ->end();
        }

        $formMapper
            ->with('form.group_general')
            ->add('label', 'text', array('required' => false))
            ->add('linkUrl', 'text', array('required' => false))
            ->add('thumbFilter', 'choice', [
                "label" => "Thumbnail filter",
                "required" => false,
                "placeholder" => "No filter",
                "choices" => [
                    "gallery_thumbnail" => "Gallary Thumbnail",
                ],
            ])
            ->add('fullFilter', 'choice', [
                "label" => "Full size filter",
                "required" => false,
                "placeholder" => "No filter",
                "choices" => [
                    "gallery_full" => "Full size",
                ],
            ])
            ->add('image', 'elfinder_id', ["required" => false, "instance" => "form", "enable" => true])
            ->add('position', 'hidden', array('mapped' => false))
            ->end();
    }
}
