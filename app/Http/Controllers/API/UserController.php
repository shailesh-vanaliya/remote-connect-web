<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User;
use App\Helpers\Helpers; 
use Illuminate\Support\Facades\Auth;
use DateTime;
use Validator;
use Session;
use Stripe;
use Config;
use DB;
use Hash;
class UserController extends Controller 
{
    public $successStatus = 200;/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function __construct()
    {
        
    }

    public function login(Request $request){
        
        $validator = Validator::make($request->all(), [ 
            'mobile_no' => 'required', 
            'password' => 'required', 
        ]);
        if ($validator->fails()) { 
            $error = $validator->messages()->first();
            return response()->json(['status'=>false,'message'=> $error], 200);            
        }
        $checkRecord = User::where('mobile_no', $request->all('mobile_no'))->count();
        if($checkRecord == 0){
            return response()->json(['message'=> "Sorry, your account does't exists",'status' => false], 200);
        }
        if(Auth::attempt(['mobile_no' => request('mobile_no'), 'password' => request('password')])){
            $user = Auth::user(); 
            $userObj = User::find($user['id']);
            $userObj['device_id'] = $request->header('deviceid');
            $userObj->save(); 
            $user['token'] =  $user->createToken('MyApp')->accessToken; 
            return response()->json(['status' => true,'message' => 'Login Successfully done','data' => $user], $this->successStatus); 
        }
        else{ 
            return response()->json(['message'=> 'Sorry, Phone or password are not match','status' => false], 200); 
        } 
    }
    /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
      
        $validator = Validator::make($request->all(), [ 
            'full_name' => 'required', 
            'password' => 'required|min:6', 
            'mobile_no' => 'required|unique:users|max:15|min:5', 
        ]);
        if ($validator->fails()) { 
            $error = $validator->messages()->first();
            return response()->json(['status'=>false,'message'=> $error], 200);            
        }
            
            $input = $request->all(); 
            $otp = Helpers::getOpt(4);
            
                $input['password'] = Hash::make($input['password']); 
                $input['status'] = 'ACTIVE'; 
                $input['role'] = 'CUSTOMER'; 
                $input['is_verified'] = 0;
                $input['referral_code'] = $input['mobile_no'];
                $input['profile_pic'] = '';
                $input['otp'] = $otp; 
                $input['device_id'] = $request->header('deviceid');
                $user = User::create($input); 

                $userRes = User::find($user['id']);
                if(!empty($userRes)){
                    $userRes['token'] =  $user->createToken('MyApp')->accessToken; 
                    return response()->json(['status'=>true,'message'=> 'Register Successfully completed.','data'=>$userRes], $this->successStatus); 
                }else{
                    return response()->json(['status'=>false,'message'=> trans('api.register-failed')], 200); 
                }
    }
    /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details(Request $request) 
    {   
        $user = Auth::user(); 
        return response()->json(['status' => true,'message' => 'User details get Successfully' ,
            'data' => $user], $this->successStatus); 
    }    

    /** 
     * otp verify 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function otpverify(Request $request) 
    {   
        // print_r($request->post('otp'));exit;
        $user = Auth::user(); 
        if($user->otp == $request->post('otp')){
                $userObj = User::find($user->id);
                $userObj->otp = ''; 
                $userObj->is_verified = 1;
                $userObj->device_id = $request->header('deviceid');
                $userObj->save(); 
                $userd = User::find($user->id);
            return response()->json(['data' => $userd,'status' => true,'message' => trans('api.otp-verify-success')], $this->successStatus); 
        }else{
            return response()->json(['message'=> trans('api.otp-verify-failed'),'status'=>false], 200); 
        }
    } 

     /** 
     * Logout api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function logoutApi(Request $request) 
    {   
        $user = Auth::user()->token();
        if(Auth::user()){
            $user->revoke();    
            return response()->json(['status' => true,
                'message' => 'You have Successfully logout',
            ], $this->successStatus); 
        }else{
            return response()->json(['status' => false,'message'=> 'Sorry, logout failed'], 200); 
        }
        
    }   

    /** 
     * Forgot api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function forgot(Request $request) 
    {   
         $responseData = $request->all();

        $user = User::where('role', $request->header('role'))
            ->where('country_code', $request->all('country_code'))
            ->where('mobile_no', $request->all('mobile_no'))->get()->toArray();
            // print_r($user);
            // exit;
             
        if(isset($user) && !empty($user)){
            $otp = Helpers::getOpt(4);
            $userObj = User::find($user[0]['id']);
            $userObj->otp = $otp ; 
            $userObj->device_id = $request->header('deviceid');
            // $userObj->is_verified = 0; 
            $userObj->save();
            Helpers::sendSMS($responseData['country_code'].$responseData['mobile_no'],'Futuristic Technologies verification code is  '.$otp); 
             return response()->json(['data' => $userObj,'message' => 'OTP sent to your phone','status' => true], $this->successStatus); 
        }else{
            return response()->json(['message'=> 'Sorry, Invalid phone number','status'=>false],200); 
        }
    }

    /** 
     * otp verify 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function otpVerifyV2(Request $request) 
    {   
        $user = User::where('role', $request->header('role'))
            ->where('country_code', $request->all('country_code'))
            ->where('mobile_no', $request->all('mobile_no'))->first();
        if($user['otp'] == $request->post('otp')){
                $userObj = User::find($user['id']);
                $userObj->otp = ''; 
                $userObj->is_verified = 1; 
                $userObj->device_id = $request->header('deviceid');
                $userObj->save(); 
            return response()->json(['message'=> 'OTP Successfully verified','status'=> true,'data' => $userObj], $this->successStatus); 
        }else{
            return response()->json(['message'=> 'Please Enter valid OTP.','status'=>false], 200); 
        }
    } 

    /** 
     * Change Password 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function changePassword(Request $request) 
    {   
        $validator = Validator::make($request->all(), [ 
            'password' => 'required|min:6', 
            'c_password' => 'required|same:password', 
            'mobile_no' => 'required',
            'country_code' => 'required',
        ]);
        if ($validator->fails()) { 
            $error = $validator->messages()->first();
            return response()->json(['status'=>false,'message'=> $error], 200);    
        }
        $user = User::where('role', $request->header('role'))->where('country_code', $request->all('country_code'))->where('mobile_no', $request->all('mobile_no'))->first();
        if(!empty($user)){
        // if($user['otp'] == $request->post('otp')){
                $userObj = User::find($user['id']);
                $userObj['password'] = Hash::make($request->post('password')) ;
                $userObj->save(); 
            return response()->json(['status'=> true,'message' => 'Password Successfully changed, please login'], $this->successStatus); 
        }else{
            return response()->json(['message'=> 'Sorry, Password change failed. please try again','status'=> false], 200); 
        }
    } 

    /** 
     * Change Password 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function editProfile(Request $request) 
    {   

        $user = Auth::user(); 
        $validator = Validator::make($request->all(), [ 
            'first_name' => 'required', 
            'last_name' => 'required', 
            // 'profile_pic' => 'required_without_all:user_docs',
            // 'user_docs' => 'required_without_all:profile_pic',
        ]);
        if ($validator->fails()) { 
            $error = $validator->messages()->first();
            return response()->json(['status'=>false,'message'=> $error], 200); 
        }
            $requestData = $request->all();
            $name = $user_docs = '';
            if($files=$request->file('profile_pic')){  
                $name = time().$files->getClientOriginalName();  
                $files->move(public_path() .'/uploads/',$name);  
            }   
            if($files1=$request->file('user_docs')){  
                $user_docs = time().'docs'.$files1->getClientOriginalName();  
                $files1->move(public_path() .'/uploads/',$user_docs);  
            } 
 
                $userObj = User::findOrFail($user->id);
                $userObj->first_name = $requestData['first_name']; 
                $userObj->last_name = $requestData['last_name'];
                $userObj->email = $requestData['email'];
                $userObj->kyc = $requestData['kyc'];
                if($name != ''){
                    $userObj->profile_pic = $name;    
                }
                if($user_docs != ''){
                    $userObj->user_docs = $user_docs;    
                }
                $userObj->save();
                $success =  User::findOrFail($user->id);
                
        return response()->json(['data'=> $success, 'status'=>true, 'message'=> 'Your profile Successfully changed'], $this->successStatus); 

    }

  

    /** 
     * change language 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function changeLanguage(Request $request) 
    {   
       
        $user = Auth::user(); 
        $validator = Validator::make($request->all(), [ 
            'language' => 'required', 
        ]);
        if ($validator->fails()) { 
            $error = $validator->messages()->first();
            return response()->json(['status'=>false,'message'=> $error], 200);
        }
                $requestData = $request->all();
                $user = User::findOrFail($user->id);
                $user->update($requestData);

        if(!empty($user)){
            return response()->json(['status'=> true,'message' => trans('api.language-change-success'), 'data' => $user], $this->successStatus); 
        }else{
            return response()->json(['message'=> trans('api.language-change-failed'),'status'=> false], 200); 
        }
    }

    public function resetOtp(Request $request){   
        $responseData = $request->all();
        $validator = Validator::make($request->all(), [ 
            'country_code' => 'required', 
            'mobile_no' => 'required', 
        ]);
        if ($validator->fails()) { 
            $error = $validator->messages()->first();
            return response()->json(['status'=>false,'message'=> $error], 200); 
        }
        $user = User::where('role', $request->header('role'))
            ->where('country_code', $request->all('country_code'))
            ->where('mobile_no', $request->all('mobile_no'))->get()->toArray();
        if(isset($user) && !empty($user)){
            $otp = Helpers::getOpt(4);
            $phoneNumber = $user[0]['country_code'].$user[0]['mobile_no'];
            $userObj = User::find($user[0]['id']);
            $userObj->otp = $otp ; 
            $userObj->device_id = $request->header('deviceid');
            // $userObj->is_verified = 0; 
            $userObj->save();
             Helpers::sendSMS($phoneNumber,'Futuristic Technologies password reset verification code is '.$otp); 
            return response()->json(['data' => $userObj,'message' => 'OTP Successfully sent to you phone number','status' => true], $this->successStatus); 
        }else{
            return response()->json(['message'=> 'Sorry, Invalid phone number.','status'=>false],200); 
        }
    }

     /** 
     * Change Password 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function resetPassword(Request $request) 
    {   
        $validator = Validator::make($request->all(), [ 
            'password' => 'required', 
         //   'confirm_password' => 'required|same:password', 
            'old_password' => 'required', 
        ]);
        if ($validator->fails()) { 
            $error = $validator->messages()->first();
            return response()->json(['status'=>false,'message'=> $error], 200);    
        }
        $user = Auth::user(); 
        $input = $request->all(); 
        if (Hash::check($input['old_password'], $user['password'])) {
                $userObj = User::find($user['id']);
                $userObj['password'] = Hash::make($input['password']);
                $userObj->save(); 
            return response()->json(['status'=> true,'message' => 'Your password Successfully changed'], $this->successStatus); 
        }else{
            return response()->json(['message'=> 'Sorry, old password and new password does not match.','status'=> false], 200); 
        }
    } 
}   