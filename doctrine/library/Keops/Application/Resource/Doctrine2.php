<?php

/**
 * Description of Keops_Application_Resource_Doctrine2
 *
 * @author Costin
 */
class Keops_Application_Resource_Doctrine2
      extends Zend_Application_Resource_ResourceAbstract
{
    public function init()
    {
        $bootstrapOptions = $this->getBootstrap()->getOptions();

        $options = $this->getOptions();
        $memcache = null;

        $doctrineConfig = new \Doctrine\ORM\Configuration();
        if (!empty($options['options']['metadataCache'])) {
            $metaCache = new $options['options']['metadataCache']();
            if ($metaCache instanceof
                    \Doctrine\Common\Cache\MemcacheCache) {
                $memcache = new Memcache();
                $memcache->connect('localhost', 11211);
                $metaCache->setMemcache($memcache);
            }
            $doctrineConfig->setMetadataCacheImpl($metaCache);
        }
        if (!empty($options['options']['queryCache'])) {
            $queryCache = new $options['options']['queryCache']();
            if ($queryCache instanceof
                    \Doctrine\Common\Cache\MemcacheCache) {
                if (is_null($memcache)) {
                    $memcache = new Memcache();
                    $memcache->connect('localhost', 11211);
                }
                $queryCache->setMemcache($memcache);
            }
            $doctrineConfig->setQueryCacheImpl($queryCache);
        }

        $driverImpl =
            $doctrineConfig->newDefaultAnnotationDriver(
                array($options['paths']['entities']));
        $doctrineConfig->setMetadataDriverImpl($driverImpl);
        //$doctrineConfig->setEntityNamespaces(
        //    $options['entitiesNamespaces']);

        $doctrineConfig->setProxyDir($options['paths']['proxies']);
        $doctrineConfig->setProxyNamespace(
            $options['options']['proxiesNamespace']);

        $this->getBootstrap()->em =
            \Doctrine\ORM\EntityManager::create(
                $options['connections']['doctrine'],
                $doctrineConfig);
        return $this->getBootstrap()->em; 
    }
}
