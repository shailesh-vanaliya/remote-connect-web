<?php

namespace App\Helpers;

use Config;
use Auth;
use DateTime;
use Session;
use DB;
use App\Models\DeviceAliasmap;
use App\Models\Notification;
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

	public static function gerReportParameter($param, $modem_id)
	{

		$deviceList =  DeviceAliasmap::where('modem_id', $modem_id)->first()->toArray();
		$string = "";
		$column = (isset($deviceList['parameter_alias']) && !empty($deviceList['parameter_alias'])) ? json_decode($deviceList['parameter_alias'], TRUE) : "";

		foreach ($param as $key => $val) {
			if (array_key_exists($val, $column)) {
				$string .= $column[$val];
				$string .=  (count($param) != ($key + 1)) ? ', ' : '';
			}
		}
		return $string;
	}
	

	public function getNotificationList(){
		// $notification = Notification::latest()->take(10);
		// print_r($notification);
		// exit;
		$notification = Notification::where('created_by', Auth::guard('admin')->user()->id)->where('viewed', 0)->take(10)->latest('id')->get()->toArray();
		return $notification;
	}
	
}
