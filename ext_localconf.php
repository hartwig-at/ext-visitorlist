<?php
if( !defined( 'TYPO3_MODE' ) ) {
	die( 'Access denied.' );
}
Tx_Extbase_Utility_Extension::configurePlugin(  'visitorlist',  'List',  array(    'List' => ''  ),  array(    'List' => 'list,excel'  ));
?>