<?php
/*         S E A R C H - D O C U M E N T . P H P
 * BRL-CAD
 *
 * Copyright (c) 1995-2013 United States Government as represented by
 * the U.S. Army Research Laboratory.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public License
 * version 2.1 as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this file; see the file named COPYING for more
 * information.
 */

require_once("config.php");

$dir = glob(brlcad_source.$_POST['catname']."/*", GLOB_ONLYDIR);
foreach ($dir as $language) {
	if(is_dir($language))
	{
		$dir_name = explode("/", $language);
		$length = sizeof($dir_name);
		if($dir_name[$length-1]=="CMakeFiles")
		{

		} else {
			echo "<option value='".$dir_name[$length-1]."'>".$dir_name[$length-1]."</option>";
		}
	}
}
/*
 * Local Variables:
 * mode: PHP
 * tab-width: 8
 * End:
 * ex: shiftwidth=4 tabstop=8
 */
?>