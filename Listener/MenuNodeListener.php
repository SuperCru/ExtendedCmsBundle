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
     * Basic constructor
     * @param MenuProviderInterface $provider
     * @param AuthorizationCheckerInterface $security
     */
    public function __construct(MenuProviderInterface $provider, AuthorizationCheckerInterface $security)
    {
        $this->provider = $provider;
        $this->security = $security;
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
