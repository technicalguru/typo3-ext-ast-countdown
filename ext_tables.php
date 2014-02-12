<?php
	if (!defined ('TYPO3_MODE')) die ('Access denied.');
	 
	t3lib_div::loadTCA('tt_content');
	$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1'] = 'layout,pages,select_key';
	
	t3lib_extMgm::addPlugin(Array('LLL:EXT:ast_countdown/locallang_db.php:tt_content.list_type_pi1', $_EXTKEY.'_pi1'), 'list_type');
	t3lib_extMgm::addStaticFile($_EXTKEY, 'pi1/static/', 'Countdown');
?>
