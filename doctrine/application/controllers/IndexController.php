<?php

class IndexController extends Zend_Controller_Action
{

	/**
	* Doctrine entity manager
	* 
	* @var \Doctrine\ORM\EntityManager
	*/
	protected $em;

	/**
	* Initializates the entity manager
	* 
	*/
    public function init() {
        $this->em = $this->getInvokeArg('bootstrap')->em;
	}

	/**
	* Index action, used for whole application benchmarking purposes
	* 
	* @return void
	*/
    public function indexAction() {
    	$store = $this->newStore();
        echo $this->_helper->json(array('success' => true, 'newRecordId' => $store->getId()));
    }
    
    /**
    * Runs a simple inserts benchmark of given number of cycles
    * 
    * @return void
    */
    public function benchmarkInsertsAction() {
    	$stats['memoryStart'] = memory_get_usage() / 1024 . ' KB';
		isset($_GET['cycles']) ? $cycles = $_GET['cycles'] : $cycles = 1000;
		$stats['cycles'] = $cycles;
		$startTime = getTime();
		for ($i = 0; $i < $cycles; $i++) {
			$this->newStore();
		}
		$endTime = getTime();
		$stats['memoryEnd'] = memory_get_usage() / 1024 . ' KB';
		$stats['memoryPeak'] = memory_get_peak_usage() / 1024 . ' KB';
        foreach ($stats as $value) {
            echo $value . ',';
        }
        echo number_format(($endTime - $startTime), 6) . ',' ;
		$this->_helper->viewRenderer->setRender('index');
    }
    
    /**
    * Runs a simple selects benchmark of given number of cycles
    * 
    * @return void
    */
    public function benchmarkSelectsAction() {
        $stats['memoryStart'] = memory_get_usage() / 1024 . ' KB';
        isset($_GET['cycles']) ? $cycles = $_GET['cycles'] : $cycles = 1000;
        $stats['cycles'] = $cycles;
        $startTime = getTime();
        for ($i = 0; $i < $cycles; $i++) {
            $this->getStore();
        }
        $endTime = getTime();
        $stats['memoryEnd'] = memory_get_usage() / 1024 . ' KB';
        $stats['memoryPeak'] = memory_get_peak_usage() / 1024 . ' KB';
        foreach ($stats as $value) {
            echo $value . ',';
        }
        echo number_format(($endTime - $startTime), 6) . ',' ;
        $this->_helper->viewRenderer->setRender('index');
    }
    
    /**
    * Creates a new store and saves it into the database
    * 
    * @return \Entities\Store
    */
    protected function newStore() {
        $store = new \Entities\Store();
        $store->setName('Paris');
        $store->setStatus('A');
        $store->setCreateTs(new DateTime(Zend_Date::now()->get(Zend_Date::ISO_8601)));
        $this->em->persist($store);
        $this->em->flush();
        //$this->em->clear();
        return $store;
    }
    
    /**
     * Selects a store from db
     * 
     */
    protected function getStore() {
        $id = rand(1, 500);
        return $this->em->getRepository('Entities\Store')->find($id);
    }

}

