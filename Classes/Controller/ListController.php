<?php
class Tx_Visitorlist_Controller_ListController extends Tx_Extbase_MVC_Controller_ActionController  {private $implementation;private function getImplementation() {  if( null == $this->implementation ) {    $this->implementation = new VisitorlistListControllerImplementation($this);  }  return $this->implementation;}function __construct() {parent::__construct();}
/**
* frontendUserRepository
* @var Tx_Visitorlist_Domain_Repository_FrontendUserRepository
*/
protected $frontendUserRepository;
/**
* injectFrontendUserRepository
* @param Tx_Visitorlist_Domain_Repository_FrontendUserRepository $frontendUserRepository
*/
public function injectFrontendUserRepository(Tx_Visitorlist_Domain_Repository_FrontendUserRepository $frontendUserRepository) {
  $this->frontendUserRepository = $frontendUserRepository;
}
/**
*/
public function listAction() { return $this->getImplementation()->listAction(); }
/**
*/
public function excelAction() { return $this->getImplementation()->excelAction(); }
}require_once('VisitorlistListControllerImplementation.php');
?>