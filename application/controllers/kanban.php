<?php

class Kanban_Controller extends Base_Controller {
    public $restful = true;

    public function get_index() {
        $exclude_statuses = array('reject', 'success');
        
        $statuses = array(
            'new' => 'primary', 
            'dtf' => 'dark', 
            'uv' => 'dark', 
            'applying' => 'dark', 
            'printer' => 'dark',
            'consumables' => 'dark',
            'payment' => 'warning', 
            'shipment' => 'success');

        $clients = Client::where_not_in('current_status', $exclude_statuses)->order_by('id', 'desc')->get(array('name', 'chat_id', 'current_status', 'updated_at'));

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