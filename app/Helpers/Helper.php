<?php

namespace App\Helpers;

use Config;
use Auth;
use DateTime;
use Session;
use DB;
use App\Models\DeviceAliasmap;
use App\Models\Device;
use App\Models\DeviceMap;

class Helper
{


	public static function removeSpecialCharacter($fileName)
	{
		$fileName = str_replace(' ', '-', $fileName); // Replaces all spaces with hyphens.
		return preg_replace('/[^A-Za-z0-9.\-]/', '', $fileName); // Removes special chars.
	}

	public static function filterAddress($location)
	{
		// $fileName = str_replace(' ', '-', $fileName); // Replaces all spaces with hyphens.
		$location  = strtok($location, " ");
		return preg_replace('/[^A-Za-z0-9.\-]/', '', $location); // Removes special chars.
		
	}
	public static function getAliasData($id)
	{
		// DeviceAliasmap
		
		// $deviceObj = new Device();
		// $postData = $deviceObj->deviceDetailById($id);
	 
		// $columnList = DB::connection('mysql2')->getSchemaBuilder()->getColumnListing('datalog');
	 
		// $parameter_alias = [];
		// foreach ($columnList  as $key => $val) {
		// 	if($val != 'id' && $val != 'modem_id' && $val != 'slave_id'){
		// 		$parameter_alias[$val] = $val;
		// 	}
		// }
		// print_r(json_encode($parameter_alias, TRUE));
		// exit;

	}

}
