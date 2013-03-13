<?php
if( !defined( 'TYPO3_MODE' ) ) {
	die( 'Access denied.' );
}
Tx_Extbase_Utility_Extension::configurePlugin(  'user_visitorlist',  'List',  array(    'List' => 'list,excel'  ),  array(    'List' => ''  ));
?>