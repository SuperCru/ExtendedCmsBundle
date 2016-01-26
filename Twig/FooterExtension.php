<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace SuperCru\ExtendedCmsBundle\Twig;

use Doctrine\ODM\PHPCR\DocumentManagerInterface;
use Twig_Extension;
use Twig_Function_Method;

/**
 * Description of FooterExtension
 *
 * @author Kaelin Jacobson <kaelin@supercru.com>
 * @since 1.0
 */
class FooterExtension extends Twig_Extension
{

    private $dm;
    private $sitePath;

    public function __construct(DocumentManagerInterface $dm, $sitePath)
    {
        $this->dm = $dm;
        $this->sitePath = $sitePath;
    }

    public function getFunctions()
    {
        return [
            "get_footer" => new Twig_Function_Method($this, 'getFooter'),
        ];
    }

    public function getFooter()
    {
        $site = $this->dm->find(\SuperCru\ExtendedCmsBundle\Document\Site::class, $this->sitePath);
        return $site->getFooter();
    }

    public function getName()
    {
        return "supercruextendedcms_footer";
    }
}
