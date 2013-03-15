<?php
require_once("FrontendUserRepository.php");
class VisitorlistFrontendUserRepositoryImplementation extends Tx_Visitorlist_Domain_Repository_FrontendUserRepository {

  private $repository = NULL;

  public function __construct( $repository ) {
    $this->repository = $repository;
  }

  public function getRecentVisitors() {
    $query = $this->repository->createQuery();
    return $query
      ->matching( $query->logicalNot( $query->equals( 'lastlogin', 0 ) ) )
      ->setOrderings( array( 'is_online' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING ) )
      ->execute();

    //$this->repository->findAll();
    return $this->repository->findAll();
    return null;
  }
}