<?php

class Kanban_Controller extends Base_Controller {
    public $restful = true;

    public function get_index() {
        $exclude_statuses = array('reject', 'success');

        $clients = Client::where_not_in('current_status', $exclude_statuses)->get(array('name', 'chat_id', 'current_status', 'updated_at'));
        $statuses = Client::where_not_in('current_status', $exclude_statuses)->distinct()->get('current_status');

        return View::make("dtf.kanban")
            ->with('clients', $clients)
            ->with('statuses', $statuses);
    }

    public function post_changestatus() {
        // Write to the log
        $chatId = Input::get('chatId');
        $client = Client::find('chat_id', '=', $chatId)->first();
        
        if (!is_null($client)) {
            $client->current_status = Input::get('status');
            $client->log('status', 'Статус изменён на ' . $client->rustatus());
            $client->save();         

            return Response::json(array('status'=>'ok', 'message'=>'status successfully changed', 'code'=>'0200'));
        } else {
            $client->log('status', 'Ошибка смена статуса на '. $client->rustatus() . '. Причина: Клиент не найден');

            return Response::json('Client is empty', 400);
        }
    }
}