<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;
use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Mail;
use phpseclib\Crypt\RSA;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'user_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contact_no' => ['required', 'numeric', 'digits:10'],
            'state_id' => ['required'],
            'district_id' => ['required'],
            'present_address' => ['required'],
            'permanent_address' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    // protected function create(array $data)
    // {
    //     $pre = 'ELIB';
    //     $year = date('y');
    //     $count = 0;
    //     return $reg_no = $pre . $year . str_pad($count + 1, 4, '0', STR_PAD_LEFT);
    //      $last_redg = User::latest('id')->value('registration_no');
    //      $numeric_part = substr($last_redg, -4);
    //      $new_numeric_part = str_pad((int)$numeric_part + 1, 4, '0', STR_PAD_LEFT);
    //      $new_reg_no = substr($last_redg, 0, -4) . $new_numeric_part;
         
    //      if ($last_redg != $reg_no) {
    //          $registration_no = $new_reg_no;
    //      }else{
    //         $registration_no = $reg_no;
    //      }
        
    //     return $registration_no;
    //     //return $data;
    //     return User::create([
    //         'first_name' => $data['first_name'],
    //         'last_name' => $data['last_name'],
    //         'user_name' => $data['user_name'],
    //         'email' => $data['email'],
    //         'contact_no' => $data['contact_no'],
    //         'state_id' => $data['state_id'],
    //         'district_id' => $data['district_id'],
    //         'present_address' => $data['present_address'],
    //         'permanent_address' => $data['permanent_address'],
    //         'role' => 'user',
    //         'role_id' => 5,
    //         'status' => 1,
    //         'password' => Hash::make($data['password']),
    //     ]);
    //     return redirect()->route('login')
    //     ->with('success', 'User Registered Successfully');
    // }
    public function userRegister(Request $request){
        $rules = [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'user_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contact_no' => ['required', 'numeric', 'digits:10'],
            'state_id' => ['required'],
            'district_id' => ['required'],
            'present_address' => ['required'],
            'permanent_address' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'profile_photo' => 'required|file|mimes:jpeg,png|max:1024', 
            // 'confirm_password' => ['required', 'string', 'min:8'],
        ];
    
             
    
        $request->validate($rules);
        $unique_no = User::orderBy('id', 'DESC')->pluck('id')->first();
        if ($unique_no == null or $unique_no == "") {
            $unique_no = 1;
        } else {
            $unique_no = $unique_no + 1;
        }
        
        $user = new User();
        if ($file = $request->file('profile_photo')) {
            $data = $request->file('profile_photo');
            $extension = $data->getClientOriginalExtension();
            $filename = time() . 'profile_photo' . $unique_no . '.' . $extension;
            $path = public_path('upload/user_profile_photo/');
            $upload_success = $data->move($path, $filename);
            $profile_photo = '/upload/user_profile_photo/' . $filename;
            $user->profile_photo = $profile_photo;
        }
        //return $profile_photo;
        
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->user_name = $request->input('user_name');
        $user->email = $request->input('email');
        $user->contact_no = $request->input('contact_no');
        $user->state_id = $request->input('state_id');
        $user->district_id = $request->input('district_id');
        $user->present_address = $request->input('present_address');
        $user->permanent_address = $request->input('permanent_address');
        
        $user->role = 'User';
        $user->role_id = 5;
        $user->is_library = '1';
        $user->password = Hash::make($request->input('password'));

        $user->save();

        if($user->save()){
            $user->assignRole('User');

            $email = $request->input('email');
                $mailData = [
                    'username' => $request->input('email'),
                    'msg' => 'you have successfully registered your credentials is',
                    'url' => "URL::to('/login')",
                    'password'=>$request->input('password'),
                     
                ];
                Mail::to($email)->send(new RegisterMail($mailData));
    
            return redirect()->route('login')
            ->with('success', 'User Registered Successfully');
        }else{
            return redirect()->back()
            ->with('error', "Something went's wrong !");
        }
    }
    

    //get all cities based on states
    public function getCity(Request $request)
    {
        $city = DB::table('cities')->where('state_id', $request->state_id)->orderBy('name', 'asc')->get();
        return response()->json(['city' => $city]);
    }

 
    public function reloadCaptcha(){
        return response()->json(['captcha'=> captcha_img()]);
    }

    public function ifmstest()
    { 
        $responseDataDecode = "1";
        $stringUniq = $this->generateRandomString(10);
        $encryptedKey = $this->encrypt($stringUniq,'12345678901234567890123456789012');
        $appkey = $this->getappkey($encryptedKey);
        $responseData = json_decode($this->ifmsAuthentication($appkey));
        print_r($responseData);exit;
        if($responseData->status)
        {
             

        }
        return $responseDataDecode;
    }

    function generateRandomString($length = 10) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
       $charactersLength = strlen($characters);
       $randomString = '';
       for ($i = 0; $i < $length; $i++) {
           $randomString .= $characters[rand(0, $charactersLength - 1)];
       }
       return $randomString;
    }

    function encrypt($data = '', $key = NULL) {
        if($key != NULL && $data != ""){
            $method = "AES-256-ECB";
            $encrypted = openssl_encrypt($data, $method, $key, OPENSSL_RAW_DATA);
            
            $result = base64_encode($encrypted);
            return $result;
        }else{
            return "String to encrypt, Key is required.";
        }
    }
    function getappkey($encrypt_app_key="")
    { 
        // test 
        // $ifms_data = IfmsDetail::where('id', 1)->first();
        $publicKeyVal = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAlyRmB8pYjfAkFVtaHC6r
        EtRveMrEG7VlasM0ygajusyz7ymZhINRmp/eHqrj4FnSQmR/qgbtrRmVnFhuZgL2
        BckSIMtHpaP+DnAzWoYKITYIHKhyD2VbItUu0cfdIl8RQFykSbzQwWQgIujtscNo
        Kgglr86AMPjxvAxuLZi4o3g0wZJabIDdNso6B0d9pfI08KqMsb3DLJJFAkcwwHJj
        5imC4yBjiuRX34O+l3M5G6kpk+qROrTqHeafZmxXiAaFTUvRl0pLqLgYy3mZW6xm
        /LpughJ4z958IOldWhpvN/ltbJo3cqg2NGmsw8FRPb4YrqVoiWusv9afSmcCmOZt
        7wIDAQAB';
        // $ifms_data->public_key;
        // $publicKeyVal = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAlTXDqTaAr18YGhgifAPXr/okvGEpebRPdzp13PAvPX5Cpx7M8sVyZgXgbOJECLwjFo4IHEXXBOzeMMMVTyYHR2p2FMxwwCCrTcyPq791EiRcuVeKHYZKnvbMmycjKP8sbSqH5fqwCmy4C+aFpfd4peI7bhn1laJVsKxMyjtTzMQ1yX4uZ6qVmT41ewyXLJyIOK9tO44FHnYIzPq60BA9ibR6KoawN47qgEkac4vRCkMemn90DSkFBHq0ZZbURoAk4u0TKB3eWURwUNMA+i2aJGKXOJQuUrAIk6+7gG2LiB17yki8XoCEi1klWbx54ZCXXq5S/G0Zga2DF2hMGETunQIDAQAB";
        // orginal 
        // $publicKeyVal=  "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAi21umeAWAamRjyIAlNlLb3KyYz7F3h+EJ4FvRI8+JSKkMeRFHORJKEMsu42wW5zAelv01zY/3/VDOlIMWzzx2Rr5/cltu2NLBtBu9Pf50jRBLZRFA9Q83qWr5rwvS8jveXYgJ5Xy631B9srBj7/bFKi5CMXg4qU/KnOsciWWKgQYv2ISGOSbG5wV28ves2utSe5KOzzZqEsUwgzmTwwX9iCaALFJWRV8E/06Mn54M0WgNXd/7eoGSlP97luka1cuhV97e0XX7914PqupRbbjJhYAXB74NeftY8I0OU0C/4OD/vM7RQyRHX6bgKkDZ/FcEXmSSmuo5hp9b6e1zzBnbwIDAQAB";


         
        
        $rsakey = $this->RSAEncryption($encrypt_app_key,$publicKeyVal);
        return $rsakey; 
    }
    function RSAEncryption($plaintext,$publicKey)
    {
        $rsa = new \Crypt_RSA();
        $rsa->loadKey($publicKey); // public key
        //$plaintext = '...';
        $rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_OAEP);
        //$rsa->setHash('sha256');
        $ciphertext = $rsa->encrypt($plaintext);
          //encrypted string
        return base64_encode($ciphertext);
    }
    public function ifmsAuthentication($appKey)
    {
        $ifms_data = IfmsDetail::where('id', 1)->first();
        // $publicKeyVal = $ifms_data->url;
        // print_r($ifms_data->url);
        // dd($ifms_data->url);
        $url_site = 'https://uat.odishatreasury.gov.in/bdbillreceivingws/0.1/authenticate';
        // $ifms_data->url."authenticate";
        // echo $url_site;exit();

        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url_site,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "{'appKey':'".$appKey."'}",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "clientid: ESIS",
            "clientsecret: Phg7egNQpoKsbNaXsJJPy/DYKJrDKEF+0GcGtglN/IY=",
            "content-type: application/json",
            "postman-token: 94d83067-f350-b5cd-0a5d-b8906b2c7b9d"
          ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
         // echo "cURL Error #:" . $err;
        } else {
          //echo $response;
        }
        return $response;
    }
}
