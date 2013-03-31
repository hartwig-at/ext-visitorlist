<?php
/**
 * Copyright (C) 2012, Oliver Salzburg
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * Created: 2013-03-13 15:00
 *
 * @author     Oliver Salzburg <oliver.salzburg@hartwig-at.de>, HARTWIG Communication & Events
 * @copyright  Copyright (C) 2013, Oliver Salzburg
 * @license    http://opensource.org/licenses/GPL-2.0 GPLv2
 * @package    TYPO3
 * @subpackage tx_visitorlist
 */
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
  }
}