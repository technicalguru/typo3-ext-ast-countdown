<?php
	/***************************************************************
	*  Copyright notice
	*
	*  (c) 2004 Andre Steiling (steiling@pilotprojekt.com)
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
		*/
		function main($content, $conf) {
			$this->conf = $conf;
			$this->pi_setPiVarDefaults();
			$this->pi_loadLL();
			
			// Conf
			$cDate     = $this->conf['cDate']!=''?$this->conf['cDate']:time();
			if ($this->datePassed($cDate)) return '';

			$imgPath   = $this->conf['imgPath']!=''?$this->conf['imgPath']:t3lib_extMgm::siteRelPath('ast_countdown').'pi1/digits/';
			$imgWidth  = $this->conf['imgWidth']!=''?$this->conf['imgWidth']:16;
			$imgHeight = $this->conf['imgHeight']!=''?$this->conf['imgHeight']:22;
			$imgExt    = $this->conf['imgExt']!=''?$this->conf['imgExt']:'gif';
			$doText    = $this->conf['doText']!=''?$this->conf['doText']:0;

			$graphCounter = "
				counter  = '<'+'img name=\"b0\" src=\"".$imgPath."c0.".$imgExt."\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += '<'+'img name=\"b1\" src=\"".$imgPath."c0.".$imgExt."\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += '<'+'img name=\"b2\" src=\"".$imgPath."c0.".$imgExt."\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += '<'+'img src=\"".$imgPath."ct.".$imgExt."\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += '<'+'img name=\"b3\" src=\"".$imgPath."c0.".$imgExt."\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += '<'+'img name=\"b4\" src=\"".$imgPath."c0.".$imgExt."\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += '<'+'img src=\"".$imgPath."ct.".$imgExt."\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += '<'+'img name=\"b5\" src=\"".$imgPath."c0.".$imgExt."\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += '<'+'img name=\"b6\" src=\"".$imgPath."c0.".$imgExt."\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += '<'+'img src=\"".$imgPath."ct.".$imgExt."\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += '<'+'img name=\"b7\" src=\"".$imgPath."c0.".$imgExt."\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += '<'+'img name=\"b8\" src=\"".$imgPath."c0.".$imgExt."\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
			";

			$textCounter = "
				counter  = '<img name=\"b0\" src=\"".$imgPath."c0.".$imgExt."\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += '<img name=\"b1\" src=\"".$imgPath."c0.".$imgExt."\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += '<img name=\"b2\" src=\"".$imgPath."c0.".$imgExt."\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += ' d ';
				counter += '<img name=\"b3\" src=\"".$imgPath."c0.".$imgExt."\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += '<img name=\"b4\" src=\"".$imgPath."c0.".$imgExt."\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += ' h ';
				counter += '<img name=\"b5\" src=\"".$imgPath."c0.".$imgExt."\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += '<img name=\"b6\" src=\"".$imgPath."c0.".$imgExt."\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += ' min ';
				counter += '<img name=\"b7\" src=\"".$imgPath."c0.".$imgExt."\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" />';
				counter += '<img name=\"b8\" src=\"".$imgPath."c0.".$imgExt."\" width=\"'+vWidth+'\" height=\"'+vHeight+'\" alt=\"\" /> sec';
			";
			$GLOBALS['TSFE']->additionalHeaderData['tx_astcountdown_pi1']  = "
				<script type=\"text/javascript\">
					/*<![CDATA[*/
				<!--
				var locDate = new Date();
				var evtDate = new Date(locDate.getTime() + ".(($cDate-time())*1000-1000).");
				var vWidth  = ".$imgWidth.";
				var vHeight = ".$imgHeight.";
				var imgPath = '".$imgPath."';
				var imgExt = '".$imgExt."';
				".($doText ? $textCounter : $graphCounter)."
				// -->
					/*]]>*/
			</script>";
			$GLOBALS['TSFE']->additionalHeaderData['tx_astcountdown_pi1'] .= '<script type="text/javascript" src="'.t3lib_extMgm::siteRelPath('ast_countdown').'pi1/tx_astcountdown_pi1.js"></script>'.chr(10);

			$content = '
				'.$this->conf['cHead'].'
				<script type="text/javascript">
					/*<![CDATA[*/
				<!--
				document.write(counter);
				countDown();
				// -->
					/*]]>*/
				</script>
				'.$this->conf['cFoot'].'
			';
			return $this->pi_wrapInBaseClass($content);
		}

		function datePassed($datum) {
			if ($datum <= time()) return true;
			return false;
		}
	}
	
	
	if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/ast_countdown/pi1/class.tx_astcountdown_pi1.php']) {
		include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/ast_countdown/pi1/class.tx_astcountdown_pi1.php']);
	} 
?>
