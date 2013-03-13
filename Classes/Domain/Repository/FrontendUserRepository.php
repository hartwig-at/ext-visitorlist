<?php
class Tx_UserVisitorlist_Domain_Repository_FrontendUserRepository extends Tx_Extbase_Domain_Repository_FrontendUserRepository {
private $implementation;
private function getImplementation() {
  if( null == $this->implementation ) {
    $this->implementation = new UserVisitorlistFrontendUserRepositoryImplementation($this);
  }
  return $this->implementation;
}
public function getRecentVisitors() { return $this->getImplementation()->getRecentVisitors(); }

}
require_once('FrontendUserRepositoryImplementation.php');

?>