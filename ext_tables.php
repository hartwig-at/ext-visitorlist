<?php
if( !defined( 'TYPO3_MODE' ) ) {
	die( 'Access denied.' );
}
t3lib_extMgm::addStaticFile('visitorlist', 'Configuration/TypoScript/list', 'Visitor List');
if( TYPO3_MODE == 'BE' ) {  $TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['visitorlist_list_wizicon'] =    t3lib_extMgm::extPath('visitorlist') . 'Resources/Private/Php/class.visitorlist_list_wizicon.php';}
Tx_Extbase_Utility_Extension::registerPlugin(
  'visitorlist',
  'List',
  'LLL:EXT:visitorlist/Resources/Private/Language/locallang_be.xml:list_title'
);
$TCA['tt_content']['types']['list']['subtypes_addlist']['visitorlist_list'] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue('visitorlist_list', 'FILE:EXT:visitorlist/Configuration/FlexForms/flexform_list.xml');

t3lib_extMgm::addStaticFile('visitorlist', 'Configuration/TypoScript', 'Visitor List Base');
?>