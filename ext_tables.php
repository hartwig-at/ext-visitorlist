<?php
if( !defined( 'TYPO3_MODE' ) ) {
	die( 'Access denied.' );
}
t3lib_extMgm::addStaticFile('user_visitorlist', 'Configuration/TypoScript/list', 'Visitor List');
if( TYPO3_MODE == 'BE' ) {  $TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['uservisitorlist_list_wizicon'] =    t3lib_extMgm::extPath('user_visitorlist') . 'Resources/Private/Php/class.uservisitorlist_list_wizicon.php';}
Tx_Extbase_Utility_Extension::registerPlugin(
  'user_visitorlist',
  'List',
  'LLL:EXT:user_visitorlist/Resources/Private/Language/locallang_be.xml:list_title'
);
$TCA['tt_content']['types']['list']['subtypes_addlist']['uservisitorlist_list'] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue('uservisitorlist_list', 'FILE:EXT:user_visitorlist/Configuration/FlexForms/flexform_list.xml');

t3lib_extMgm::addStaticFile('user_visitorlist', 'Configuration/TypoScript', 'Visitor List Base');
?>