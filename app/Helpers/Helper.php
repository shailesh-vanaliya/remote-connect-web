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

	public static function filterAddress($location)
	{
		// $fileName = str_replace(' ', '-', $fileName); // Replaces all spaces with hyphens.
		$location  = strtok($location, " ");
		return preg_replace('/[^A-Za-z0-9.\-]/', '', $location); // Removes special chars.
		
	}

}
