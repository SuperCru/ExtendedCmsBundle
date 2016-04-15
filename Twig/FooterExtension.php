<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace SuperCru\ExtendedCmsBundle\Twig;

use Doctrine\ODM\PHPCR\DocumentManagerInterface;
use SuperCru\ExtendedCmsBundle\Document\Site;
use Twig_Extension;
use Twig_SimpleFunction;

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
            new Twig_SimpleFunction("get_footer", [$this, 'getFooter']),
        ];
    }

    public function getFooter()
    {
        $site = $this->dm->find(Site::class, $this->sitePath);
        return $site->getFooter();
    }

    public function getName()
    {
        return "supercruextendedcms_footer";
    }
}
