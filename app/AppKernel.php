<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),

            new Sonata\CoreBundle\SonataCoreBundle(),
            new Sonata\BlockBundle\SonataBlockBundle(),
            new Sonata\AdminBundle\SonataAdminBundle(),
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
            new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
            new Sonata\NotificationBundle\SonataNotificationBundle(),

            new FOS\UserBundle\FOSUserBundle(),
            new PUGX\MultiUserBundle\PUGXMultiUserBundle(),

            new FM\ElfinderBundle\FMElfinderBundle(),

            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Knp\DoctrineBehaviors\Bundle\DoctrineBehaviorsBundle(),

            new Ivory\CKEditorBundle\IvoryCKEditorBundle(),

            new JMS\SerializerBundle\JMSSerializerBundle(),

            new A2lix\TranslationFormBundle\A2lixTranslationFormBundle(),

            new Liip\ImagineBundle\LiipImagineBundle(),

            new ITM\FilePreviewBundle\ITMFilePreviewBundle(),
            new ITM\ImagePreviewBundle\ITMImagePreviewBundle(),

            new Application\Sonata\AdminBundle\ApplicationSonataAdminBundle(),
            new Application\FOS\UserBundle\ApplicationFOSUserBundle(),

           
            new DepartmentSite\ProjectBundle\DepartmentSiteProjectBundle(),
            new DepartmentSite\DictionaryBundle\DepartmentSiteDictionaryBundle(),
            new DepartmentSite\NoticeBundle\DepartmentSiteNoticeBundle(),
            new DepartmentSite\DefaultBundle\DepartmentSiteDefaultBundle(),
            new DepartmentSite\GalleryBundle\DepartmentSiteGalleryBundle(),
            new DepartmentSite\MenuBundle\DepartmentSiteMenuBundle(),
            new DepartmentSite\NewsBundle\DepartmentSiteNewsBundle(),
            new DepartmentSite\PageBundle\DepartmentSitePageBundle(),
            new DepartmentSite\SlideShowBundle\DepartmentSiteSlideShowBundle(),

            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }
        
        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
        }


        return $bundles;
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
