<?php

class Kanban_Controller extends Base_Controller {
    public $restful = true;

    public function get_index() {
        $statuses = array(
            'new' => 'primary', 
            'dtf' => 'info',
            'combined' => 'dark',
            'uv' => 'dark', 
            'applying' => 'dark', 
            'printer' => 'secondary',
            'consumables' => 'danger',
            'shipment' => 'success');

        $clients = DB::query("select distinct clients.name, clients.chat_id, clients.current_status, clients.created_at, 
            MAX(messages.date_time) AS new_update, MAX(deals.price) AS last_price
            from clients 
            inner join messages on clients.chat_id = messages.chat_id
            left outer join deals on clients.chat_id = deals.chat_id
            where current_status not in ('success', 'reject') 
            GROUP BY clients.chat_id, clients.name, deals.chat_id, clients.current_status
            ORDER BY new_update DESC;");

        return View::make("dtf.kanban")
            ->with('clients', $clients)
            ->with('statuses', $statuses);
    }

    public function post_changestatus() {
        // Write to the log
        $chatId = Input::get('chatId');
        $client = Client::where('chat_id', '=', $chatId)->first();
        
        if (!is_null($client)) {
            $client->current_status = Input::get('status');
            $client->log('status', 'Статус изменён на ' . $client->rustatus());
            $client->save();         

            return Response::json(array('status'=>'ok', 'message'=>'status successfully changed', 'code'=>'0200'));
        } else {
            return Response::json('Client is empty', 400);
        }
    }
}