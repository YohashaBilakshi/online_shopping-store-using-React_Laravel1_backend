<?php

namespace App\Http\Controllers\API\User;

use  App\Models\User;
use  App\Models\UserSessionLogs;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Hash;

class AuthController extends BaseController
{
    public function index(){

        $data = [
            'boards' =>"oards",
            'boardsCount' => "boardsCount",
        ];


        return $data;
        // return "work";
    }

    public function signup(Request $request){

        try {

            $validator = Validator::make($request->all(), [
                'username' => ['required', 'unique:users', 'regex:/^[^\s]+$/'],
                'password' => 'required',
                'phoneNumber' => 'required',
                'email' => 'required | email',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Authentication error', $validator->errors());
            }

            User::insert([
                'username' =>  $request->input('username'),
                'password' => Hash::make($request['password']),
                // 'phoneNumber' =>  $request->input('phoneNumber'),
                'email' =>  $request->input('email'),
            ]);

            return $this->sendResponse(null, 'User registered successfully.', 200);


        } catch (\Throwable $th) {

            return $this->sendError('An error occur while registration ', ['error' => $th]);

            // return $th;
        }

    }

    public function login(Request $request){

        try {

            $username =  str_replace(' ', '', $request->username);
            $password =  str_replace(' ', '',  $request->password);

            if ($username == null) {
                return $this->sendError('Username is required');
            }
    
            if ($password == null) {
                return $this->sendError('Password is required');
            }

            if (Auth::attempt(['username' =>  $username, 'password' => $password])) {
                $user = Auth::user();

                $session_token = Session::getId();

                $userSessionLog = new UserSessionLogs();
                $userSessionLog->user_id = $user->id;
                $userSessionLog->device = $request->device;
                $userSessionLog->ip = $request->ip();
                $userSessionLog->session_token = $session_token;
                $userSessionLog->login_time = now();
                $userSessionLog->save();   

                $success['userInfo'] = $user;

                return $this->sendResponse($success, 'Succefully logged', 200);

            }else{
                return $this->sendError('Invalied login information');
            }
        } catch (\Throwable $th) {

            return $this->sendError('n error occur while login ', ['error' => $th]);
            // return $th;
        }
    }
}
