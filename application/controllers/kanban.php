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

        $client = Client::where('chat_id', '=', $chatId)->get();
        $event = new Event();
    
        if (!empty($client)) {
            $client->current_status = Input::get('status');
            $client->save();

            $event->author = Auth::user()->id;
            $event->type = 'status';
            $event->comment = 'Статус изменён на ' . Input::get('status');
            $event->chat_id = $chatId;
            $event->save();

            return Response::json(array('status'=>'ok', 'message'=>'status successfully changed', 'code'=>'0200'));
        } else {
            $event->author = Auth::user()->id;
            $event->type = 'status';
            $event->comment = 'Ошибка смена статуса на '. Input::get('status') . '. Причина: Клиент не найден';
            $event->chat_id = $chatId;
            $event->save();

            return Response::json('Client is empty', 400);
        }
    }
}