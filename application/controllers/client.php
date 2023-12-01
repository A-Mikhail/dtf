<?php

class Client_Controller extends Base_Controller {
    public $restful = true;

    public function get_index($id) {
        $statuses = array(
            'new' => 'primary', 
            'dtf' => 'dark', 
            'uv' => 'dark', 
            'applying' => 'dark', 
            'printer' => 'dark',
            'consumables' => 'dark',
            'payment' => 'warning', 
            'shipment' => 'success');

        $client = Client::where('chat_id', '=', $id)->first(array('name', 'chat_id', 'current_status', 'updated_at'));

        return View::make("dtf.client")
            ->with('client', $client)
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

    public function get_chatiframe() {
        $chatId = Input::get('chatId');
        $client = Client::where('chat_id', '=', $chatId)->first();

        if (!is_null($client)) {
            $body = (object)array(
                "user" => array(
                    "id" => (string)Auth::user()->id,
                    "name" => Auth::user()->username
                ),
                "scope" => "card",
                "filter" => array(array(
                    "chatType" => "whatsapp",
                    "chatId" => $chatId,
                    "name" => $client->name
                )),
                "options" => array(
                    "useDealsEvents" => true
                )
            );
        } else {
            return Response::json("Can't find requested client", 400);
        }

        $iframe_link = Wazzup::send('iframe', json_encode($body), 'POST');

        if (property_exists($iframe_link, 'url')) {
            return Response::json(array('status'=>'ok', 'message'=>'link generated', 'code'=>'0200', 'iframeurl' => $iframe_link->url));
        } else {
            return Response::json('Error while generating contact link', 400);
        }
    }
}