<?php
namespace OnyxLogger;

use OnyxLogger\Model\Log;
use OnyxLogger\Model\LogTable;
use OnyxLogger\Service\Listener;
use Zend\EventManager\EventInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function onBootstrap(EventInterface $e)
    {
        $sm = $e->getTarget()->getServiceManager();
        $eventManager = $e->getTarget()->getEventManager();
        $eventManager->attach(new Listener($sm));
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getServiceConfig()
    {
        return array(
            'factories' => array(                
                'OnyxLogger\Model\LogTable' =>  function($sm) {
                    $tableGateway = $sm->get('LogTableGateway');
                    $table = new LogTable($tableGateway);
                    return $table;
                },
                'LogTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Log());
                    return new TableGateway('onyx_log', $dbAdapter, null, $resultSetPrototype);
                },        
            ),
            
        );
    }
}
