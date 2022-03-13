<?php

namespace App\Helpers;

use Config;
use Auth;
use DateTime;
use Session;
use Stripe;
use AWS;
use App\Models\Permission;

class Helper
{


	public static function removeSpecialCharacter($fileName)
	{
		$fileName = str_replace(' ', '-', $fileName); // Replaces all spaces with hyphens.
		return preg_replace('/[^A-Za-z0-9.\-]/', '', $fileName); // Removes special chars.
	}

	public static function getPermission($moduleName, $fieldName)
	{
		if (Auth::guard('admin')->user()->role == 'SUPERADMIN') {
			$res = Permission::select('superadmin_permission as permission', 'field_name')
				->where('module_name', $moduleName)
				->where('field_name', $fieldName)
				->first();
		} elseif (Auth::guard('admin')->user()->role == 'ADMIN') {
			$res = Permission::select('admin_permission as permission', 'field_name')
				->where('module_name', $moduleName)
				->where('field_name', $fieldName)
				->first();
		} else {
			$res = Permission::select('user_permission as permission', 'field_name')
				->where('module_name', $moduleName)
				->where('field_name', $fieldName)
				->first();
		}
		return (!empty($res)) ? $res->permission : 'No';
	}
}
