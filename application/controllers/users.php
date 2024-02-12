<?php
use Laravel\View;

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

    public function get_register() {
        if (Auth::user()->alevel != 1) {
            return Response::error(403);
        }

        return View::make('dtf.register');
    }

    
    public function post_register() {
        $username = Input::get('login');
        $fio = Input::get('fio');
        $password = Input::get('password');
        $alevel = Input::get('alevel');

        $findUser = User::where('email', '=', $username)->first();

        if(!is_null($findUser)){
            return Response::json(array('status' => 'exist', 'message' => 'User already exists'));
        }

        $user = new User();
        $user->email = $username;
        $user->password = Hash::make($password);
        $user->username = $fio;
        $user->active = 1;
        $user->alevel = intval($alevel);
        $user->save();

        return Response::json(array('status' => 'success', 'message' => 'User is registered'));
    }

    public function get_users() {
        if (Auth::user()->alevel != 1) {
            return Response::error(403);
        }

        $users = User::all();
 
        $statuses = array(1 => 'Активный', 0 => 'Заблокирован');
        $alevels = array(1 => 'Администратор', 2 => 'Менеджер');

        foreach ($users as $user){
            $user->active = $statuses[$user->active];
            $user->alevel = $alevels[$user->alevel];
            $user->created_at = date('d.m.Y', strtotime($user->created_at));
        }

        return View::make('dtf.users')
            ->with('users', $users);
    }

    public function post_block($id) {
        if (Auth::user()->alevel != 1) {
            return Response::error(403);
        }

        $user = User::find($id);

        if (is_null($user)) {
            return Response::json(array('status' => 'not found', 'message' => 'User not found'));
        }

        $user->active = 0;
        $user->save();

        return Response::json(array('status' => 'success', 'message' => 'User is blocked'));
    }

    public function post_unblock($id) {
        if (Auth::user()->alevel != 1) {
            return Response::error(403);
        }

        $user = User::find($id);

        if (is_null($user)) {
            return Response::json(array('status' => 'not found', 'message' => 'User not found'));
        }

        $user->active = 1;
        $user->save();

        return Response::json(array('status' => 'success', 'message' => 'User is unblocked'));
    }
}