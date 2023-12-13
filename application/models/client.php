<?php

class Client extends Eloquent {
	public static $table = 'clients';

	public function log($type, $comment, $bot = false) {
		if ($bot) {
			$user = User::where('id', '=', 3)->first();
		} else {
			$user = Auth::user();
		}

		$ins = array(
			'author' => $user->id,
			'type' => $type,
			'comment'=> $comment,
			'chat_id' => $this->chat_id,
			'created_at' => new DateTime()
		);

		DB::table('events')->insert($ins);

		return true;
	}

	public function price($price) {
		$setPrice = array(
			'author' =>  Auth::user()->id,
			'chat_id' => $this->chat_id,
			'price' => $price,
			'created_at' => new DateTime()
		);

		DB::table('deals')->insert($setPrice);

		$this->log('price', 'Цена изменена на ' . number_format($price,0,'.',' ') . ' т');

		return true;
	}

	public function getPrice() {
		$price = DB::table('deals')->where('chat_id', '=', $this->chat_id)->order_by('id', 'desc')->first();

		if (!is_null($price)) {
			return $price;
		} else {
			return false;
		}
	}

	public function getlog() {
		$to_return = DB::table('events')->where('chat_id', '=', $this->chat_id)->order_by('id', 'desc')->get();
		
		if (empty($to_return)) {
			$to_return = false;
		} else {
			foreach ($to_return as $k => $v) {
				if ($to_return[$k]->author) {
					$to_return[$k]->author = $this->fio($to_return[$k]->author);
				}
			}
		}
		
		return $to_return;
	}

	private function fio($id) {
		$fio = User::where('id','=', $id)->first('username');

		return $fio->username;
	}

	public function rustatus() {
		$status = $this->current_status;

		$status_arr = array(
			'new'           => 'Новый',
			'dtf'           => 'DTF',
			'uv'            => 'UV',
			'applying'      => 'Нанесение',
			'payment'       => 'Оплата',
			'shipment'      => 'Отправка',
			'printer'       => 'Принтеры',
			'consumables'   => 'Расходники',
			'success'       => 'Завершён',
			'reject'        => 'Забракован'
		);

		if (array_key_exists($status, $status_arr)) {
			$to_return = $status_arr[$status];
		} else {
			$to_return = 'Неизвестный';
		}

		return $to_return;
	}
}