<?php
/**
 * This file is part of the SuperCruExtendedCmsBundle
 * @copyright (c) 2015, SuperCru LLC
 */
namespace SuperCru\ExtendedCmsBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Controller for Site document
 *
 * @author Kaelin Jacobson <kaelin@supercru.com>
 * @since 1.0
 * @Route("/_cms")
 */
class SiteController extends Controller
{

    /**
     * Sets the given document as the homepage
     * @Route("/homepage/{id}", requirements={"id": ".+"})
     * @param string $id
     * @return RedirectResponse
     * @throws NotFoundHttpException
     */
    public function makeHomepageAction($id)
    {
        $manager = $this->get("doctrine_phpcr")->getManager();

        $site = $manager->find(null, "/cms/content/site");

        if ($site === null) {
            throw $this->createNotFoundException("Site was unavailable");
        }

        $page = $manager->find(null, $id);

        $site->setHomepage($page);

        $manager->persist($site);
        $manager->flush();

        $this->addFlash("success", "Page was made the homepage");

        return $this->redirectToRoute("admin_gam_cms_sitepage_edit", [ 'id' => $page->getId()]);
    }
}
