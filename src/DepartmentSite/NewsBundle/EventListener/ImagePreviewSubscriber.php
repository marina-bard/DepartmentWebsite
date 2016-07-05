<?php
namespace DepartmentSite\NewsBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use DepartmentSite\NewsBundle\Entity\News;
use ITM\ImagePreviewBundle\Resolver\PathResolver;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class ImagePreviewSubscriber implements EventSubscriber
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function getSubscribedEvents()
    {
        return array(
            'postPersist',
        );
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $this->index($args);
    }

    public function index(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof News) {
            return;
        }

        $resolver = new PathResolver($this->container);
        $entity->setPhotoUrl($resolver->getUrl($entity, $entity->getPhoto()));
        $em = $args->getEntityManager();
        $em->persist($entity);
        $em->flush();
    }
}