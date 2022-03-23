<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
// use Laravel\Cashier\Billable;
use DB;

if ($_SERVER['HTTP_HOST'] == 'localhost') {
    define('IMAGEPATHS', asset(''));
} else {
    define('IMAGEPATHS', asset('') . 'public/');
}
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    const ROLES = [
        'USER' => 'USER',
        'ENG' => 'ENG',
        'SUPERADMIN'    => 'SUPERADMIN',
        'ADMIN'    => 'ADMIN',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'full_name', 'first_name', 'last_name', 'mobile_no', 'role', 'status', 'profile_pic','created_by', 'updated_by', 'remember_token', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
 
    public function addUser($request)
    {
        $mobile_no =  str_pad(mt_rand(1, 99999999), 5, '0', STR_PAD_LEFT);
        $objUser = new User();
        $objUser->first_name = $request->input('first_name');
        $objUser->last_name = $request->input('last_name');
        $objUser->email = $request->input('email');
        $objUser->mobile_no = $mobile_no;
        $objUser->password   = Hash::make($request->input('password'));
        $objUser->country_code = "+766";
        $objUser->role = 'USER';
        $objUser->status = 'ACTIVE';
        $objUser->profile_pic = '';
        $objUser->created_by = $request->input('created_by');
        $objUser->updated_by = $request->input('updated_by');
        $objUser->save();
        return $objUser->id;
    }
 

    public function editUser($request)
    {
        $objUser = User::find($request->input('user_id'));
        $objUser->full_name = $request->input('first_name');
        $objUser->first_name = $request->input('first_name');
        $objUser->last_name = $request->input('last_name');
        $objUser->email = $request->input('email');
        $objUser->status = 'ACTIVE';
        $objUser->save();
        return $objUser->id;
    }

}
