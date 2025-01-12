<?php
/*
 * Wrapper - an e107 plugin by Tijn Kuyper
 *
 * Copyright (C) 2016-2021 Tijn Kuyper (http://www.tijnkuyper.nl)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 */

if (!defined('e107_INIT'))
{
	require_once("../../class2.php");
}

// Make this page inaccessible when plugin is not installed.
if(!e107::isInstalled('wrapper'))
{
	e107::redirect();
	exit;
}

// Load required files and set initial variables
e107::lan('wrapper', false, true); 
require_once(e_PLUGIN."wrapper/wrapper_class.php");

$caption 	= '';
$error 		= '';
$id 		= '';
$wrap_pass 	= '';
 
// Retrieve query and check for wrap_pass
list($id, $wrap_pass) = explode('&amp;wrap_pass=', e_QUERY, 2);

$id = (int) $id; 

// Initiate the wrapper class; 
$wrapper = new Wrapper($id);
 
// Set caption
$caption 	 = $wrapper->getTitle($id);    
  
define('e_PAGETITLE', $caption); 

// Render the page
require_once(HEADERF);

$text = $wrapper->showWrapper($id, $wrap_pass);
 
e107::getRender()->tablerender($caption, e107::getMessage()->render().$text );

require_once(FOOTERF);
exit;