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
	 * Article facade
	 * 
	 * @var ArticleFacade
	 */
	protected $facade;

	/**
	* Initializates the entity manager
	* 
	*/
    public function init() {
        $this->em = $this->getInvokeArg('bootstrap')->em;
		$this->facade = new ArticleFacade($this->em);
	}

	/**
	* Here comes the actual application handling of forms or another input data
	* (like REST or SOAP api, or simple post or get data handler)
	* 
	* @return void
	*/
    public function indexAction() {
    	// example:
    	// if we want to create a new Article from get data, we would call:
    	// $this->facade->newArticle($_GET['title'], $_GET['text']);
    	// and so on
    	// the actual use depends heavily on the needs
    	
    	// příklad:
    	// pokud chceme například vytvořit nový článek z get dat, zavoláme:
    	// $this->facade->newArticle($_GET['title'], $_GET['text']);
    	// a tak dále
    	// vlastní použití je velice závislé na konkrétních potřebách
    }

}

