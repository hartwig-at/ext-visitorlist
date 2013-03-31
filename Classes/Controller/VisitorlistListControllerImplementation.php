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
require_once('ListController.php');
class VisitorlistListControllerImplementation extends Tx_Visitorlist_Controller_ListController {

  /**
   * controller
   * @var Tx_Visitorlist_Controller_ListController
   */
  private $controller = NULL;

  public function __construct( $interface ) {
    $this->controller = $interface;
  }

  public function listAction() {
    $users = $this->controller->frontendUserRepository->getRecentVisitors();
    //$this->controller->view->assign( "debug", $users->getFirst() );
    $this->controller->view->assign( "users", $users );
  }

  /**
   * Exports the list of visitors as Excel CSV
   */
  public function excelAction() {
    $users = $this->controller->frontendUserRepository->getRecentVisitors();

    $this->controller->view->assign( "users", $users );
    $result = $this->controller->view->render();

    $result = utf8_decode( html_entity_decode( $result ) );

    $cType    = 'text/csv';
    $fileName = "Recent Visitors Export " . date( "d.m.Y" ) . ".csv";
    $fileLen  = strlen( $result );
    $headers = array(
      'Pragma'                    => 'public',
      'Expires'                   => 0,
      'Cache-Control'             => 'must-revalidate, post-check=0, pre-check=0',
      'Cache-Control'             => 'public',
      'Content-Description'       => 'File Transfer',
      'Content-Type'              => $cType,
      'Content-Disposition'       => 'attachment; filename="'. $fileName .'"',
      'Content-Transfer-Encoding' => 'binary',
      'Content-Length'            => $fileLen
    );
    foreach( $headers as $header => $data ) {
      $this->controller->response->setHeader( $header, $data );
    }
    $this->controller->response->sendHeaders();

    echo $result;

    exit;
  }
}