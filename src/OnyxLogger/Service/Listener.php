<?php
namespace OnyxLogger\Service;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use OnyxLogger\Model\Log;

class Listener implements ListenerAggregateInterface
{
    private $logTable;
    
    /**
     * @var \Zend\ServiceManager\ServiceManager 
     */
    protected $serviceManager;


    /**
     * @var \Zend\Stdlib\CallbackHandler[]
     */
    protected $listeners = array();
    
    public function __construct(\Zend\ServiceManager\ServiceManager $sm) {
        $this->serviceManager = $sm;
    }

    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events)
    {
        $sharedEvents      = $events->getSharedManager();
        $this->listeners[] = $sharedEvents->attach('Onyx\Service\EventManger', 'logError', array($this, 'logError'), 100);
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    public function logError($e)
    {
        $params = $e->getParams();
        $logTable = $this->getlogTable();
        $log = new Log();
        if(isset($params['name'])){
            $log->setEventname($params['name']);
        }else{
            $log->setEventname("Standard Error");
        }
        if(isset($params['message'])){
            $log->setMessage($params['message']);
        }else{
            $log->setMessage("Standard message");
        }
        if(isset($params['data'])){
            $log->setData(json_encode($params['data']));
        }else{
            $log->setData(json_encode(array()));
        }
        if(isset($params['params'])){
            $log->setParams(json_encode($params['params']));
        }else{
            $log->setParams(json_encode(array()));
        }
        $logTable->save($log);
        
    }
    
    private function getlogTable(){
        if (!$this->logTable) {
            $this->logTable = $this->serviceManager->get('OnyxLogger\Model\LogTable');
        }
        return $this->logTable;
    }
}