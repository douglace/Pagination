<?php

namespace App\Cd\Pagination;

class Pagination {

	/**
	 * Donnée par page
	 * @var integer $perpage
	 */
	private $perpage = 10;

	/**
	 * Donnée page Courante
	 * @var integer $currentPage
	 */
	private $currentPage = 1;

	/**
	 * Donnée à paginé
	 * @var array $data
	 */
	private $data = array();


	/**
	 * url de base des page 
	 * @var string $link
	 */
	private $link = '';

	/**
	 * Geters to match
	 * @var string $matches
	 */
	private $matches = '';

	/**
	 * Retourne les liens valides
	 * 	@var array $pageUrls
	 */
	private $pageUrls = array();


	/**
	 * Donnée à paginé
	 * @var array $currentData
	 */
	private $currentData = array();
	
	/**
	 * @param array $data
	 * @param string $link url de base des page 
	 * @ex http://localhost:8000/pagination
	 */
	public function __construct($data, $link, $matches = '')
	{
		if(!is_array($data))
		{
			throw new \Exception("Invalid data given. data must be an array", 1);
			
		}
		if(!is_string($link) || empty($link))
		{
			throw new \Exception("Invalid link given. link must be an string and not null", 1);
			
		}
		$this->data = $data;
		$this->link = $link;
		$this->matches = $matches;
	}

	//GETTERS

	/**
	 * Renvoi le nombre de donnée par page
	 * @return integer
	 */
	public function getPerpage()
	{
		return $this->perpage ? $this->perpage : 10;
	}

	/**
	 * Retourne le nombre de page
	 * @return integer
	 */
	public function getNumberPage(){
		return ceil((int)count($this->data) / (int)$this->getPerpage());
	}

	/**
	 * Retourne la page courante
	 * @return integer
	 */
	public function getCurrentPage(){
		return (int)$this->currentPage;
	}

	public function next(){
		return $this->getPageLink($this->getCurrentPage() + 1);
	}

	public function prev(){
		return $this->getPageLink($this->getCurrentPage() - 1);
	}


	/**
	 * Retourne les données courante
	 * @return array
	 */
	public function getCurrentData() {
		$this->setCurrentData();
		return $this->currentData;
	}

	/**
	 * retourne l'url de la page demandé
	 * @param integer $page
	 * @return string 
	 */
	public function getPageLink($page){
		if($this->ifPageExist($page)){
			if(is_string($this->matches) && !empty($this->matches)){
				return $this->link.(strpos($this->link, '?') ? '&' :'?').$this->matches.'='.$page;
			}
			return $this->link.(strpos($this->link, '?') ? '&' : '?').'page='.$page;
		}else{
			return false;
		}
	}

	public function getPageUrls(){
		return $this->generateUrls();
	}

	public function getFirstPage(){
		if($this->getNumberPage() <= 1 || $this->getCurrentPage() == 1){
			return false;
		}
		return $this->getPageLink(1);
	}	

	public function getLastPage(){
		if($this->getNumberPage() > 1 && $this->getCurrentPage() != $this->getNumberPage()){
			return $this->getPageLink($this->getNumberPage());
		}
		return false;
	}


	//SETTERS


	/**
	 * Retourne les données courante
	 * @return array
	 */
	private function setCurrentData() {
		$data = array();
		$startAt = ($this->getCurrentPage() * $this->getPerpage()) - $this->getPerpage();
		$endAt = $startAt + $this->getPerpage();
		if($startAt < 0){
			throw new \Exception("Invalide Current Page given");
		}
		for($i=$startAt;$i<=$endAt-1;$i++){
			if(isset($this->data[$i])){
				$data[] = $this->data[$i];
			}else{
				break;
			}
		}

		$this->currentData = $data;
	}

	/**
	 * @var integer $perpage
	 */
	public function setPerpage($perpage){
		$this->perpage = $perpage;
		return $this;
	}

	/**
	 * @var integer $currentPage
	 */
	public function setCurrentPage($currentPage){
		$this->currentPage = $this->ifPageExist($currentPage) ? $currentPage : 1;
		return $this;
	}

	//GENERIC

	/**
	 * @var integer $page
	 * @return boolean
	 */
	public function ifPageExist($page)
	{
		return $this->getNumberPage() >= $page && $page > 0;
	}


	private function generateUrls()
	{
		if(empty($this->pageUrls)){
			$urls = array();
			for($i=1; $i<=$this->getNumberPage(); $i++){
				$urls[] = array(
					'page' => $i,
					'link' => $this->getPageLink($i)
				);
			}
			$this->pageUrls = $urls;
		}

		return $this->pageUrls;
		
	}

    /**
     * @return int
     */
	public function getSize(){
	    return $this->getNumberPage();
    }


}