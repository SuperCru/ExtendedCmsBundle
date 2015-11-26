<?php
/**
 * This file is part of the SuperCruExtendedCmsBundle
 * @copyright (c) 2015, SuperCru LLC
 */
namespace SuperCru\ExtendedCmsBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Controller for ElFinderType
 *
 * @author Kaelin Jacobson <kaelin@supercru.com>
 * @since 1.0
 * @Route("/elfinder")
 */
class ElFinderIdController extends Controller
{

    /**
     * Gets a thumbnail for an given Id. 
     * @Route("/thumbnail/{imageId}", requirements={"imageId": ".+"}, options={"expose"=true})
     * @param type $imageId
     * @return Response
     */
    public function thumbnailAction($imageId)
    {
        $response = new Response();
        $image = $this->get("doctrine_phpcr.odm.document_manager")->find(null, $imageId);
        $response->setContent(json_encode(["url" => $this->get("cmf_media.templating.helper")->displayUrl($image, ["imagine_filter" => "selection_thumbnail"])]));
        return $response;
    }
}
