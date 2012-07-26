<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  numero2 - Agentur für Internetdienstleistungen <www.numero2.de>
 * @author     Benny Born <benny.born@numero2.de>
 * @license    LGPL
 * @filesource
 */


/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_page']['palettes']['regular'] = str_replace(',noSearch;', ',noSearch;{taxonmyid_legend:hide},taxonomyid;', $GLOBALS['TL_DCA']['tl_page']['palettes']['regular']);


/**
 * Fields
 */

$GLOBALS['TL_DCA']['tl_page']['fields']['taxonomyid'] = array (
	'label'				=> &$GLOBALS['TL_LANG']['tl_page']['taxonomyid']
,	'exclude'			=> true
,	'inputType'			=> 'checkbox'
,	'options_callback'	=> array('tl_page_taxonomyid', 'tl_page_taxonomyid')
,	'reference'			=> &$GLOBALS['TL_LANG']['MSC']['sitemap_changefreq']
,	'eval'				=> array( 'includeBlankOption'=>true, 'multiple'=>true )
);


class tl_page_taxonomyid extends Backend {


	public function tl_page_taxonomyid() {

		$this->import('Database');
		$objTaxonomy = $this->Database->execute("SELECT * FROM tl_taxonomy ORDER BY sorting");

		if( $objTaxonomy->numRows < 1 ) {
			return array();
		}

		$return = array();

		while( $objTaxonomy->next() ) {
			$return[$objTaxonomy->id] = $objTaxonomy->name.' ('.$objTaxonomy->alias.')';
		}

		return $return;
	}
}

?>