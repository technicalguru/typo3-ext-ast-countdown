<?php
	/***************************************************************
	*  Copyright notice
	*
	*  (c) 2005 Andre Steiling (steiling@pilotprojekt.com)
	*  All rights reserved
	*
	*  This script is part of the TYPO3 project. The TYPO3 project is
	*  free software; you can redistribute it and/or modify
	*  it under the terms of the GNU General Public License as published by
	*  the Free Software Foundation; either version 2 of the License, or
	*  (at your option) any later version.
	*
	*  The GNU General Public License can be found at
	*  http://www.gnu.org/copyleft/gpl.html.
	*
	*  This script is distributed in the hope that it will be useful,
	*  but WITHOUT ANY WARRANTY; without even the implied warranty of
	*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	*  GNU General Public License for more details.
	*
	*  This copyright notice MUST APPEAR in all copies of the script!
	***************************************************************/
	/**
	* Plugin 'Countdown' for the 'ast_countdown' extension.
	*
	* @author Andre Steiling <steiling@pilotprojekt.com>
	*/


	require_once(PATH_tslib.'class.tslib_pibase.php');

	class tx_astcountdown_pi1 extends tslib_pibase {
		var $prefixId = 'tx_astcountdown_pi1';
		// Same as class name
		var $scriptRelPath = 'pi1/class.tx_astcountdown_pi1.php'; // Path to this script relative to the extension dir.
		var $extKey = 'ast_countdown'; // The extension key.


		/**
		 * [Put your description here]
		 *
		 * @param	[type]		$content: ...
		 * @param	[type]		$conf: ...
		 * @return	[type]		...
		 */
		function main($content, $conf) {
			$this->conf = $conf;
			$this->pi_setPiVarDefaults();
		##	$this->pi_loadLL();
		##	$this->pi_USER_INT_obj = 1; // Configuring so caching is not expected. This value means that no cHash params are ever set. We do this, because it's a USER_INT object!

			// Parse XML data into php array
			$this->pi_initPIflexForm();
			$fxDateRaw	= $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'cDate', 'sConfig');
			// Some nasty stuff ... quick and dirty
			if ($fxDateRaw) {
				$fxDatePHP = date('Y,M,d,H,i,s', $fxDateRaw);
				$arrDate	= array('Jan' => 0, 'Feb' => 1, 'Mar' => 2, 'Apr' => 3, 'May' => 4, 'Jun' => 5, 'Jul' => 6, 'Aug' => 7, 'Sep' => 8, 'Oct' => 9, 'Nov' => 10, 'Dec' => 11);
				$arrExp		= explode(',', $fxDatePHP);
				$fxDate		= str_replace($arrExp[1], $arrDate[$arrExp[1]] ,$fxDatePHP);
			}

			$fxDayLen	= $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'cDayLen', 'sConfig');
			$fxHead		= $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'cHead', 'sConfig');
			$fxPath		= $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'imgPath', 'sImage');
			$fxWidth	= $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'imgWidth', 'sImage');
			$fxHeight	= $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'imgHeight', 'sImage');

			// Config
			$cDate		= $fxDate?$fxDate:($this->conf['cDate']!=''?$this->conf['cDate']:date('Y,m,d,H,i,s', time()));
			$cDayLen	= $fxDayLen?$fxDayLen:($this->conf['cDayLen']!=''?$this->conf['cDayLen']:2);
			$cHead		= $fxHead?$fxHead:$this->conf['cHead'];
			$imgPath	= $fxPath?$fxPath:($this->conf['imgPath']!=''?$this->conf['imgPath']:t3lib_extMgm::siteRelPath('ast_countdown').'pi1/digits/');
			$imgWidth	= $fxWidth?$fxWidth:($this->conf['imgWidth']!=''?$this->conf['imgWidth']:16);
			$imgHeight	= $fxHeight?$fxHeight:($this->conf['imgHeight']!=''?$this->conf['imgHeight']:22);

			if ($cDayLen == 3) {
				$counter = "counter = '<img name=\"b0\" src=\"".$imgPath."c0.gif\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += '<img name=\"b1\" src=\"".$imgPath."c0.gif\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += '<img name=\"b2\" src=\"".$imgPath."c0.gif\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += '<img src=\"".$imgPath."ctd.gif\" alt=\"\" />';
				counter += '<img name=\"b3\" src=\"".$imgPath."c0.gif\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += '<img name=\"b4\" src=\"".$imgPath."c0.gif\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += '<img src=\"".$imgPath."cth.gif\" alt=\"\" />';
				counter += '<img name=\"b5\" src=\"".$imgPath."c0.gif\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += '<img name=\"b6\" src=\"".$imgPath."c0.gif\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += '<img src=\"".$imgPath."ctm.gif\" alt=\"\" />';
				counter += '<img name=\"b7\" src=\"".$imgPath."c0.gif\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += '<img name=\"b8\" src=\"".$imgPath."c0.gif\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';";
			} else {
				$counter = "counter = '<img name=\"b0\" src=\"".$imgPath."c0.gif\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += '<img name=\"b1\" src=\"".$imgPath."c0.gif\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += '<img src=\"".$imgPath."ctd.gif\" alt=\"\" />';
				counter += '<img name=\"b2\" src=\"".$imgPath."c0.gif\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += '<img name=\"b3\" src=\"".$imgPath."c0.gif\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += '<img src=\"".$imgPath."cth.gif\" alt=\"\" />';
				counter += '<img name=\"b4\" src=\"".$imgPath."c0.gif\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += '<img name=\"b5\" src=\"".$imgPath."c0.gif\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += '<img src=\"".$imgPath."ctm.gif\" alt=\"\" />';
				counter += '<img name=\"b6\" src=\"".$imgPath."c0.gif\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += '<img name=\"b7\" src=\"".$imgPath."c0.gif\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';";
			}

			$GLOBALS['TSFE']->additionalHeaderData['tx_astcountdown_pi1']  = "
			<script type=\"text/javascript\">
				/*<![CDATA[*/
			<!--
				var evtDate = new Date(".$cDate.");
				var vWidth  = ".$imgWidth.";
				var vHeight = ".$imgHeight.";
				var imgPath = '".$imgPath."';
				var vDayLen = ".$cDayLen.";
				counter     = ".$counter.";

			// -->
				/*]]>*/
			</script>";
			$GLOBALS['TSFE']->additionalHeaderData['tx_astcountdown_pi1'] .= '<script type="text/javascript" src="'.t3lib_extMgm::siteRelPath('ast_countdown').'pi1/tx_astcountdown_pi1.js"></script>'.chr(10);

			$content = '
			'.$cHead.'
			<script type="text/javascript">
				/*<![CDATA[*/
			<!--
				document.write(counter);
				countDown();
			// -->
				/*]]>*/
			</script>';
			return $this->pi_wrapInBaseClass($content);
		}
	}


	if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/ast_countdown/pi1/class.tx_astcountdown_pi1.php']) {
		include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/ast_countdown/pi1/class.tx_astcountdown_pi1.php']);
	}
?>