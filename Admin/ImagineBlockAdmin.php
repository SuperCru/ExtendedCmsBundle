<?php
/**
 * This file is part of the SuperCruExtendedCmsBundle
 * @copyright (c) 2015, SuperCru LLC
 */

namespace SuperCru\ExtendedCmsBundle\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use SuperCru\ExtendedCmsBundle\Form\Type\ElFinderIdType;
use Symfony\Cmf\Bundle\BlockBundle\Admin\Imagine\ImagineBlockAdmin as BaseAdmin;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\DoctrinePHPCRAdminBundle\Form\Type\TreeManagerType;

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
    protected function configureFormFields(FormMapper $formMapper)
    {
        if (null === $this->getParentFieldDescription()) {
            $formMapper
                ->with('form.group_general')
                ->add(
                    'parentDocument', TreeManagerType::class, ['root_node' => $this->getRootPath(), 'choice_list' => [], 'select_root_node' => true]
                )
                ->add('name', TextType::class)
                ->end();
        }

        $fullFilterConfig = $this->getConfigurationPool()->getContainer()->getParameter("supercru.extenedcms.full_image_filters");
        $thumbFilterConfig = $this->getConfigurationPool()->getContainer()->getParameter("supercru.extenedcms.thumb_image_filters");
        $fullFilterChoices = [];
        $thumbFilterChoices = [];
        
        foreach ($fullFilterConfig as $choice) {
            $fullFilterChoices[$choice['name']] = $choice['filter'];
        }
        
        foreach ($thumbFilterConfig as $choice) {
            $thumbFilterChoices[$choice['name']] = $choice['filter'];
        }
        
        $formMapper
            ->with('form.group_general')
            ->add('label', TextType::class, ['required' => false])
            ->add('linkUrl', TextType::class, ['required' => false])
            ->add('thumbFilter', ChoiceType::class, [
                "label" => "Thumbnail filter",
                "required" => false,
                "placeholder" => "No filter",
                "choices_as_values" => true,
                "choices" => $thumbFilterChoices,
            ])
            ->add('fullFilter', ChoiceType::class, [
                "label" => "Full size filter",
                "required" => false,
                "placeholder" => "No filter",
                "choices_as_values" => true,
                "choices" => $fullFilterChoices,
            ])
            ->add('image', ElFinderIdType::class, ["required" => false, "instance" => "form", "enable" => true])
            ->add('position', HiddenType::class, ['mapped' => false])
            ->end();
    }
}
