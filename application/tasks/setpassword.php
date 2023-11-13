<?php

class Setpassword_Task{
	public function run($elem){
        $user = User::where('email','=',$elem[0])->first();

		if(is_null($user)){
			print 'Пользователь с таким email не найден'.PHP_EOL;
			return false;
		}

		$user->password=Hash::make($elem[1]);
		$user->save();

		print 'Пароль успешно изменен'.PHP_EOL;
	}
}