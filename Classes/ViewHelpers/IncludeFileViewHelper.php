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
 * Created: 2012-11-22 13:11
 *
 * @author     Georg Ringer <typo3@ringerge.org>
 * @author     Oliver Salzburg <oliver.salzburg@hartwig-at.de>, HARTWIG Communication & Events
 * @copyright  Copyright (C) 2010, Georg Ringer
 * @copyright  Copyright (C) 2012, Oliver Salzburg
 * @license    http://opensource.org/licenses/GPL-2.0 GPLv2
 * @package    TYPO3
 * @subpackage tx_visitorlist
 */
class Tx_Visitorlist_ViewHelpers_IncludeFileViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

  /**
   * Include a CSS/JS file
   *
   * @param string $path path to the file
   * @param boolean $compress if file should be compressed
   * @return void
   */
  public function render( $path, $compress = FALSE ) {
    $path = $GLOBALS[ "TSFE" ]->tmpl->getFileName( $path );

    if( $path ) {
      // JS
      if( strtolower( substr( $path, -3 ) ) === ".js" ) {
        $GLOBALS[ "TSFE" ]->getPageRenderer()->addJsFile( $path, NULL, $compress );

        // CSS
      } elseif( strtolower( substr( $path, -4 ) ) === ".css" ) {
        $GLOBALS[ "TSFE" ]->getPageRenderer()->addCssFile( $path, "stylesheet", "all", "", $compress );
      }
    }
  }
}