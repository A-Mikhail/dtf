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

    public function get_logout() {
        if (Auth::check()) {
            Auth::logout();

            return Redirect::to_route('login');
        }
    }
}