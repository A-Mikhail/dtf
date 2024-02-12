<?php

class Users_Controller extends Base_Controller {
    public $restful = true;

    public function get_login() {
        return View::make('dtf.login');
    }

    public function post_login() {
        $remember = Input::get('remember');
        
        $user = array(
            'username' => Input::get('email'),
            'password' => Input::get('password'),
            'remember' => !empty($remember) ? $remember : null
        );

        if (Auth::attempt($user)) {
            if (Auth::user()->active) {
                return Redirect::to_route('kanban');
            }
            
            return Response::error(403);
        } else {
            return Redirect::to_route('login')->with('error', 'Вы ввели неверную комбинацию логин/пароль!');
        }
    }

    public function get_register() {
        return View::make('dtf.register');
    }

    
    public function post_register() {
        $username = Input::get('login');
        $fio = Input::get('fio');
        $password = Input::get('password');
        $alevel = Input::get('alevel');

        $findUser = User::where('email', '=', $username)->first();

        if(!is_null($findUser)){
            return Response::json(array('status' => 'fail', 'message' => 'User already exists'));
        }

        $user = new User();
        $user->email = $username;
        $user->password = Hash::make($password);
        $user->username = $fio;
        $user->active = 1;
        $user->alevel = intval($alevel);
        $user->save();
        
        return Response::json(array('status' => 'successs', 'message' => 'User is registered'));
    }

    public function get_logout() {
        if (Auth::check()) {
            Auth::logout();

            return Redirect::to_route('login');
        }
    }
}