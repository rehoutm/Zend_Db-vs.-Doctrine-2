<?php

class IndexController extends Zend_Controller_Action
{

    /**
     * StoresTable model
     * 
     * @var StoresTable
     */
	protected $table;

	/**
	* Initializates the entity manager
	* 
	*/
    public function init() {
        require APPLICATION_PATH . '/models/StoresTable.php';
        $this->table = new StoresTable;

        // configure caching backend strategy
        $oBackend = new Zend_Cache_Backend_Memcached(
            array(
                'servers' => array( array(
                    'host' => '127.0.0.1',
                    'port' => '11211'
                ) ),
                'compression' => true
        ) );

        // configure caching logger
        $oCacheLog =  new Zend_Log();
        $oCacheLog->addWriter( new Zend_Log_Writer_Stream( 'C:\memcache.log' ) );

        // configure caching frontend strategy
        $oFrontend = new Zend_Cache_Core(
            array(
                'caching' => true,
                'cache_id_prefix' => 'myApp',
                'logging' => true,
                'logger'  => $oCacheLog,
                'write_control' => true,
                'automatic_serialization' => true,
                'ignore_user_abort' => true
            ) );

        // build a caching object
        $oCache = Zend_Cache::factory( $oFrontend, $oBackend );
        Zend_Db_Table_Abstract::setDefaultMetadataCache($oCache);

	}

	/**
	* Index action, used for whole application benchmarking purposes
	* 
	* @return void
	*/
    public function indexAction() {
    	$store = $this->newStore();
        echo $this->_helper->json(array('success' => true, 'newRecordId' => $store->id));
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
    * @return stdClass
    */
    protected function newStore() {
        $store = new stdClass;
        $store->name = 'Paris';
        $store->status = 'A';
        $store->create_ts = Zend_Date::now()->get(Zend_Date::ISO_8601);
        $store->id = $this->table->insert((array) $store);
        return $store;
    }
    
    /**
     * Selects a store from db
     * 
     */
    protected function getStore() {
        $id = rand(1, 500);
        return $this->table->find($id)->current();
        //return $this->table->fetchRow(array('store_id' => $id));
    }
}

