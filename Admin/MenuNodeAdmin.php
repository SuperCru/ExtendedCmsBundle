<?php
/**
 * This file is part of the SuperCruExtendedCmsBundle
 * @copyright (c) 2015, SuperCru LLC
 */
namespace SuperCru\ExtendedCmsBundle\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Cmf\Bundle\MenuBundle\Admin\MenuNodeAdmin as BaseMenuNodeAdmin;

/**
 * Sonata admin class for menu nodes
 * 
 * @author Kaelin Jacobson <kaelin@supercru.com>
 * @since 1.0
 */
class MenuNodeAdmin extends BaseMenuNodeAdmin
{

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);

        $roles = [
            "ROLE_SUPER_ADMIN" => "Super Admin",
            "ROLE_ADMIN" => "Admin",
            "ROLE_USER" => "User",
            "IS_AUTHENTICATED_FULLY" => "Authenticated Fully",
            "IS_AUTHENTICATED_REMEMBERED" => "Authenticated Remembered",
            "IS_AUTHENTICATED_ANONYMOUSLY" => "Authenticated Anonymously",
        ];

        $formMapper
            ->with('Roles')
            ->add('addWhenGranted', "choice", array(
                "label" => "Show when role is available",
                "placeholder" => "Please select a role",
                "choices" => $roles,
                "required" => false,
            ))
            ->add('removeWhenGranted', "choice", array(
                "label" => "Remove when role is available",
                "placeholder" => "Please select a role",
                "choices" => $roles,
                "required" => false,
            ))
            ->end()
        ;
    }
}
