<?php 
	require_once 'application/Config.php';
	require_once 'application/Globals.php';
	require_once 'application/Extras.php';
	
	// Debugging status
	if (DEBUG) 
	{
		// Report all errors, warnings, interoperability and compatibility
		error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
		// Show errors with output
		ini_set("display_errors", "on");
	}
	else 
	{
		error_reporting(0);
		ini_set("display_errors", "off");
	}

	require_once '../application/DB_Connect.php';
 
    require_once '../models/Restaurant.php';
    require_once '../models/Category.php';
    require_once '../models/Photo.php';

    require_once '../controllers/ControllerRest.php';
?>