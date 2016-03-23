<?php
/**
 * This file is part of the SuperCruExtendedCmsBundle
 * @copyright (c) 2015, SuperCru LLC
 */
namespace SuperCru\ExtendedCmsBundle\Listener;

use Knp\Menu\Provider\MenuProviderInterface;
use SuperCru\ExtendedCmsBundle\Document\MenuNode;
use Symfony\Cmf\Bundle\MenuBundle\Event\CreateMenuItemFromNodeEvent;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Listens for menus being rendered and either ignores the node or renders it based on
 * the roles required to see the current node
 *
 *
 */
class MenuNodeListener
{

    /**
     * Menu provider
     * @var MenuProviderInterface
     */
    protected $provider;

    /**
     * Authorization checker to determine current users access
     * @var AuthorizationCheckerInterface
     */
    protected $security;
    
    /**
     * The auth token
     * @var \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface
     */
    private $token;

    /**
     * Basic constructor
     * @param MenuProviderInterface $provider
     * @param AuthorizationCheckerInterface $security
     */
    public function __construct(MenuProviderInterface $provider, AuthorizationCheckerInterface $security, \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface $token)
    {
        $this->provider = $provider;
        $this->security = $security;
        $this->token = $token;
    }

    /**
     * Determines if a node should be skipped from rendering based on the current
     * user's role
     *
     * @param CreateMenuItemFromNodeEvent $event
     */
    public function onCreateMenuItemFromNode(CreateMenuItemFromNodeEvent $event)
    {
        $node = $event->getNode();

        if ($node instanceof MenuNode) {
            $addRole = $node->getAddWhenGranted();
            $removeRole = $node->getRemoveWhenGranted();
            
            //This avoids issue when rendering error pages with menus
            //Defaults all menu items with any role requirements to no be displayed
            if ($this->token->getToken() === null) {
                if ($addRole !== null || $removeRole !== null) {
                    $event->setSkipNode(true);
                }
                return;
            }

            if ($addRole !== null) {
                if (!$this->security->isGranted($addRole)) {
                    $event->setSkipNode(true);
                }
            }

            if ($removeRole !== null) {
                if ($this->security->isGranted($removeRole)) {
                    $event->setSkipNode(true);
                }
            }
        }
    }
}
