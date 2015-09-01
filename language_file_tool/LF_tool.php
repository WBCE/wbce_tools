<?
/*
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

/**
 * WB Language File Tool 
 * 
 * @license         http://www.gnu.org/licenses/gpl.html
 * @copyright       2012 Norbert Heimsath
 * @author          Norbert Heimsath , heimsath.org
 * @link            my-baker.net
 * @requirements    PHP 5 at least i guess so
 * @version         0.5.1
 * @lastmodified    $Date: 2012-08-07
 * 
 * DA and CS are old iso standard, but google uses this one 
 * so idecided to use em , as they are needed for automatic translation.

THIS IS THE NON UTF-8 VERSION!!!!!

*/




// This language file is used as a basis for all other (for translation and for adding new language vars )
$sDefaultLanguage = "EN";

// Language Files to create and Process
$sLanguages ="BG,CA,CS,DA,DE,ES,ET,FI,FR,HR,HU,IT,LV,NL,NO,PL,PT,RU,SE,TR,SK";

//debugging
//$sLanguages ="CZ,DK,DE";

// there are multiple arrays that need to be processed 
// when using a module language file i guess you need to deactivate some.
$sTypes ="MENU,TEXT,HEADING,MESSAGE,OVERVIEW";

mb_internal_encoding("UTF-8");
ini_set('default_charset', 'utf-8');
//header('content-type: text/html; charset: utf-8');
//mysql_query('SET NAMES utf8'); 

ini_set('display_errors', '1');
error_reporting  (E_ALL );


//create Arrays
$aLanguages = explode(",", $sLanguages);
$aTypes = explode(",", $sTypes);


//Main loop 
foreach ($aLanguages as $sLang) {
	$sFile = $sLang.".php";
	echo $sLang.", ";
	//combining both files allows it to keep already translated stuff
	include ($sDefaultLanguage.".php");

	if (!isset($_GET['overwrite']) AND !isset($_GET['trans'])) @include ($sFile);

	// Set the language information
	
	$language_code = $sLang;
	$language_name = get_country_name ($sLang);

	//get new Language Variables from Array
	$sLangVars = "\n\n\n";
	foreach ($aTypes as $value) {

		foreach ($$value as  $key => $subvalue) {
			$sLangVars .= '$'.$value.'[\''.$key.'\'] = \''.maketext($subvalue).'\''.";\n";

		}
		$sLangVars .= "\n\n\n";
	}

/*	echo "<pre>";
	echo $sLangVars;
	echo "</pre>";
*/	

	


	//compose File
	$sFileContent ='<?php
/**
 * WebsiteBaker Community Edition (WBCE)
 * More Baking. Less Struggling.
 * Visit http://wbce.org to learn more and to join the community.
 *
 * @copyright Ryan Djurovich (2004-2009)
 * @copyright WebsiteBaker Org. e.V. (2009-2015)
 * @copyright WBCE Project (2015-)
 * @license GNU GPL2 (or any later version)
 * 
 * Made whith help of Automated Language File tool Copyright heimsath.org 
 */
	';

	$sFileContent .='
//no direct file access
if(count(get_included_files()) ==1){$z="HTTP/1.0 404 Not Found";header($z);die($z);}
	';

	$sFileContent .='
// Set the language information
$language_code = \''.$language_code.'\';
$language_name = \''.$language_name.'\';
$language_version = \''.$language_version.'\';
$language_platform = \''.$language_platform.'\';
$language_author = \''.$language_author.'\';
$language_license = \''.$language_license.'\';

	';

$sFileContent .= $sLangVars;


/*	echo "<pre>";
	echo $sFileContent;
	echo "</pre>";
*/
	//maybe some file conversion needed later on 
	//$sFileContent = iconv('ISO-8859-1','CP437//TRANSLIT',$sCsvContent);
	//$sFileContent = iconv('ISO-8859-1','ASCII//TRANSLIT',$sCsvContent);

	//echo $sFileContent;
	$hHandler = fopen($sFile , "w");
	fWrite($hHandler , $sFileContent);
	fClose($hHandler); // Datei schließen
	$old = umask(0);
	chmod($sFile, 0777);
	umask($old);

}



function myslash ($text){
	return str_replace("'", "\'", $text);
}

function maketext ($text){
	//$text = preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); }, $text); 
	//$text = html_entity_decode  ( $text,ENT_QUOTES, "UTF-8");
    $text =  superentities($text);
	$text = myslash ($text);
	/*if (isset($_GET['trans']) AND  get_country_name(strtoupper( $_GET['trans']))) {
		$source = 'en';
		$target = strtolower($_GET['trans']);
		$translator = new LanguageTranslator($yourApiKey);
		$text = $translator->translate($text, $target,$source);

	}*/
	return $text;
}



function get_country_name ($code){
	$countries = get_country_list();
	if (isset($countries[$code])) return $countries[$code];
	else return false;
}


/**
 * Public Domain list of countries and country codes.
 * 
 *  DA and CS are old iso standard, but google uses this ones 
 *  so idecided to use em , as they are needed for automatic translation.
 *
*/
function get_country_list() {
 

  $countries = array(
    'AD' => 'Andorra', 
    'AE' => 'United Arab Emirates', 
    'AF' => 'Afghanistan', 
    'AG' => 'Antigua and Barbuda', 
    'AI' => 'Anguilla', 
    'AL' => 'Albania', 
    'AM' => 'Armenia', 
    'AN' => 'Netherlands Antilles', 
    'AO' => 'Angola', 
    'AQ' => 'Antarctica', 
    'AR' => 'Argentina', 
    'AS' => 'American Samoa', 
    'AT' => 'Austria', 
    'AU' => 'Australia', 
    'AW' => 'Aruba', 
    'AX' => 'Aland Islands', 
    'AZ' => 'Azerbaijan', 
    'BA' => 'Bosnia and Herzegovina', 
    'BB' => 'Barbados', 
    'BD' => 'Bangladesh', 
    'BE' => 'Belgium', 
    'BF' => 'Burkina Faso', 
    'BG' => 'Bulgaria', 
    'BH' => 'Bahrain', 
    'BI' => 'Burundi', 
    'BJ' => 'Benin', 
    'BL' => 'Saint Barthélemy', 
    'BM' => 'Bermuda', 
    'BN' => 'Brunei', 
    'BO' => 'Bolivia', 
    'BR' => 'Brazil', 
    'BS' => 'Bahamas', 
    'BT' => 'Bhutan', 
    'BV' => 'Bouvet Island', 
    'BW' => 'Botswana', 
    'BY' => 'Belarus', 
    'BZ' => 'Belize', 
    'CA' => 'Canada', 
    'CC' => 'Cocos (Keeling) Islands', 
    'CD' => 'Congo (Kinshasa)', 
    'CF' => 'Central African Republic', 
    'CG' => 'Congo (Brazzaville)', 
    'CH' => 'Switzerland', 
    'CI' => 'Ivory Coast', 
    'CK' => 'Cook Islands', 
    'CL' => 'Chile', 
    'CM' => 'Cameroon', 
    'CN' => 'China', 
    'CO' => 'Colombia', 
    'CR' => 'Costa Rica', 
    'CU' => 'Cuba', 
    'CW' => 'Curaçao', 
    'CV' => 'Cape Verde', 
    'CX' => 'Christmas Island', 
    'CY' => 'Cyprus', 
    'CS' => 'čeština', 
    'DE' => 'Germany', 
    'DJ' => 'Djibouti', 
    'DA' => 'Dansk', 
    'DM' => 'Dominica', 
    'DO' => 'Dominican Republic', 
    'DZ' => 'Algeria', 
    'EC' => 'Ecuador', 
    'EE' => 'Estonia', 
    'EG' => 'Egypt', 
    'EH' => 'Western Sahara', 
    'ER' => 'Eritrea', 
    'ES' => 'Spain', 
    'ET' => 'Ethiopia', 
    'EN' => 'English',
    'FI' => 'Finland', 
    'FJ' => 'Fiji', 
    'FK' => 'Falkland Islands', 
    'FM' => 'Micronesia', 
    'FO' => 'Faroe Islands', 
    'FR' => 'France', 
    'GA' => 'Gabon', 
    'GB' => 'United Kingdom', 
    'GD' => 'Grenada', 
    'GE' => 'Georgia', 
    'GF' => 'French Guiana', 
    'GG' => 'Guernsey', 
    'GH' => 'Ghana', 
    'GI' => 'Gibraltar', 
    'GL' => 'Greenland', 
    'GM' => 'Gambia', 
    'GN' => 'Guinea', 
    'GP' => 'Guadeloupe', 
    'GQ' => 'Equatorial Guinea', 
    'GR' => 'Greece', 
    'GS' => 'South Georgia and the South Sandwich Islands', 
    'GT' => 'Guatemala', 
    'GU' => 'Guam', 
    'GW' => 'Guinea-Bissau', 
    'GY' => 'Guyana', 
    'HK' => 'Hong Kong S.A.R., China', 
    'HM' => 'Heard Island and McDonald Islands', 
    'HN' => 'Honduras', 
    'HR' => 'Croatia', 
    'HT' => 'Haiti', 
    'HU' => 'Hungary', 
    'ID' => 'Indonesia', 
    'IE' => 'Ireland', 
    'IL' => 'Israel', 
    'IM' => 'Isle of Man', 
    'IN' => 'India', 
    'IO' => 'British Indian Ocean Territory', 
    'IQ' => 'Iraq', 
    'IR' => 'Iran', 
    'IS' => 'Iceland', 
    'IT' => 'Italy', 
    'JE' => 'Jersey', 
    'JM' => 'Jamaica', 
    'JO' => 'Jordan', 
    'JP' => 'Japan', 
    'KE' => 'Kenya', 
    'KG' => 'Kyrgyzstan', 
    'KH' => 'Cambodia', 
    'KI' => 'Kiribati', 
    'KM' => 'Comoros', 
    'KN' => 'Saint Kitts and Nevis', 
    'KP' => 'North Korea', 
    'KR' => 'South Korea', 
    'KW' => 'Kuwait', 
    'KY' => 'Cayman Islands', 
    'KZ' => 'Kazakhstan', 
    'LA' => 'Laos', 
    'LB' => 'Lebanon', 
    'LC' => 'Saint Lucia', 
    'LI' => 'Liechtenstein', 
    'LK' => 'Sri Lanka', 
    'LR' => 'Liberia', 
    'LS' => 'Lesotho', 
    'LT' => 'Lithuania', 
    'LU' => 'Luxembourg', 
    'LV' => 'Latvia', 
    'LY' => 'Libya', 
    'MA' => 'Morocco', 
    'MC' => 'Monaco', 
    'MD' => 'Moldova', 
    'ME' => 'Montenegro', 
    'MF' => 'Saint Martin (French part)', 
    'MG' => 'Madagascar', 
    'MH' => 'Marshall Islands', 
    'MK' => 'Macedonia', 
    'ML' => 'Mali', 
    'MM' => 'Myanmar', 
    'MN' => 'Mongolia', 
    'MO' => 'Macao S.A.R., China', 
    'MP' => 'Northern Mariana Islands', 
    'MQ' => 'Martinique', 
    'MR' => 'Mauritania', 
    'MS' => 'Montserrat', 
    'MT' => 'Malta', 
    'MU' => 'Mauritius', 
    'MV' => 'Maldives', 
    'MW' => 'Malawi', 
    'MX' => 'Mexico', 
    'MY' => 'Malaysia', 
    'MZ' => 'Mozambique', 
    'NA' => 'Namibia', 
    'NC' => 'New Caledonia', 
    'NE' => 'Niger', 
    'NF' => 'Norfolk Island', 
    'NG' => 'Nigeria', 
    'NI' => 'Nicaragua', 
    'NL' => 'Netherlands', 
    'NO' => 'Norway', 
    'NP' => 'Nepal', 
    'NR' => 'Nauru', 
    'NU' => 'Niue', 
    'NZ' => 'New Zealand', 
    'OM' => 'Oman', 
    'PA' => 'Panama', 
    'PE' => 'Peru', 
    'PF' => 'French Polynesia', 
    'PG' => 'Papua New Guinea', 
    'PH' => 'Philippines', 
    'PK' => 'Pakistan', 
    'PL' => 'Poland', 
    'PM' => 'Saint Pierre and Miquelon', 
    'PN' => 'Pitcairn', 
    'PR' => 'Puerto Rico', 
    'PS' => 'Palestinian Territory', 
    'PT' => 'Portugal', 
    'PW' => 'Palau', 
    'PY' => 'Paraguay', 
    'QA' => 'Qatar', 
    'RE' => 'Reunion', 
    'RO' => 'Romania', 
    'RS' => 'Serbia', 
    'RU' => 'Russia', 
    'RW' => 'Rwanda', 
    'SA' => 'Saudi Arabia', 
    'SB' => 'Solomon Islands', 
    'SC' => 'Seychelles', 
    'SD' => 'Sudan', 
    'SE' => 'Sweden', 
    'SG' => 'Singapore', 
    'SH' => 'Saint Helena', 
    'SI' => 'Slovenia', 
    'SJ' => 'Svalbard and Jan Mayen', 
    'SK' => 'Slovakia', 
    'SL' => 'Sierra Leone', 
    'SM' => 'San Marino', 
    'SN' => 'Senegal', 
    'SO' => 'Somalia', 
    'SR' => 'Suriname', 
    'ST' => 'Sao Tome and Principe', 
    'SV' => 'El Salvador', 
    'SY' => 'Syria', 
    'SZ' => 'Swaziland', 
    'TC' => 'Turks and Caicos Islands', 
    'TD' => 'Chad', 
    'TF' => 'French Southern Territories', 
    'TG' => 'Togo', 
    'TH' => 'Thailand', 
    'TJ' => 'Tajikistan', 
    'TK' => 'Tokelau', 
    'TL' => 'Timor-Leste', 
    'TM' => 'Turkmenistan', 
    'TN' => 'Tunisia', 
    'TO' => 'Tonga', 
    'TR' => 'Turkey', 
    'TT' => 'Trinidad and Tobago', 
    'TV' => 'Tuvalu', 
    'TW' => 'Taiwan', 
    'TZ' => 'Tanzania', 
    'UA' => 'Ukraine', 
    'UG' => 'Uganda', 
    'UM' => 'United States Minor Outlying Islands', 
    'US' => 'United States', 
    'UY' => 'Uruguay', 
    'UZ' => 'Uzbekistan', 
    'VA' => 'Vatican', 
    'VC' => 'Saint Vincent and the Grenadines', 
    'VE' => 'Venezuela', 
    'VG' => 'British Virgin Islands', 
    'VI' => 'U.S. Virgin Islands', 
    'VN' => 'Vietnam', 
    'VU' => 'Vanuatu', 
    'WF' => 'Wallis and Futuna', 
    'WS' => 'Samoa', 
    'YE' => 'Yemen', 
    'YT' => 'Mayotte', 
    'ZA' => 'South Africa', 
    'ZM' => 'Zambia', 
    'ZW' => 'Zimbabwe'
  );

  // Sort the list.
  natcasesort($countries);

  return $countries;
}

// Unicode-proof htmlentities. 
// Returns 'normal' chars as chars and weirdos as numeric html entites.
function superentities( $orgstr ){
    // get rid of existing entities else double-escape
    $str = html_entity_decode(stripslashes($orgstr),ENT_QUOTES,'UTF-8'); 
    $ar = preg_split('/(?<!^)(?!$)/u', $str );  // return array of every multi-byte character
    $str2="";
    foreach ($ar as $c){
        $o = ord($c);
        if ( (strlen($c) > 1) /*|| // multi-byte [unicode]
            ($o <32 || $o > 126) || // <- control / latin weirdos -> 
            ($o >33 && $o < 40) ||  // quotes + ambersand 
            ($o >59 && $o < 63) */    // html 
        ) {
            // convert to numeric entity
            $c = mb_encode_numericentity($c,array (0x0, 0xffff, 0, 0xffff), 'UTF-8');
        }
        $str2 .= $c;
    }
    return $str2;
}

function is_ascii( $string = '' ) {
    return ( bool ) ! preg_match( '/[\\x80-\\xff]+/' , $string );
}
