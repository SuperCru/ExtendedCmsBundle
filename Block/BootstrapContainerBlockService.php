<?php
/**
 * This file is part of the SuperCruExtendedCmsBundle.
 *
 * @copyright (c) 2016, SuperCru LLC
 */

namespace SuperCru\ExtendedCmsBundle\Block;

use Symfony\Cmf\Bundle\BlockBundle\Block\ContainerBlockService as BaseContainerBlockService;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Handles rendering of the \SuperCru\ExtendedCmsBundle\Document\BootstrapContainerBlock.
 *
 * @author Kaelin Jacobson <kaelin@supercru.com>
 *
 * @since 1.0
 */
class BootstrapContainerBlockService extends BaseContainerBlockService
{

    public function configureSettings(OptionsResolver $resolver)
    {
        parent::configureSettings($resolver);

        $resolver->setDefaults([
            'full_width' => false,
            'no_padding' => false,
            "per_row" => 1,
        ]);
        
        $resolver->setAllowedTypes("full_width" , ['boolean', 'string']);
        $resolver->setAllowedTypes("no_padding" , ['boolean', 'string']);
        $resolver->setAllowedTypes("per_row" , ['integer', 'string']);
    }
}
