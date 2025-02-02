<?php

class Client_Controller extends Base_Controller {
    public $restful = true;

    public function get_index($id) {
        $statuses = array('new', 'dtf', 'combined', 'uv', 'applying', 'printer', 'consumables', 'shipment');

        $client = Client::where('chat_id', '=', $id)->first(array('name', 'chat_id', 'chat_type', 'current_status', 'updated_at'));
        
        if (!is_null($client)) {
            $body = (object)array(
                "user" => array(
                    "id" => (string)Auth::user()->id,
                    "name" => Auth::user()->username
                ),
                "scope" => "card",
                "filter" => array(array(
                    "chatType" => $client->chat_type,
                    "chatId" => $client->chat_id,
                    "name" => $client->name
                )),
                "options" => array(
                    "useDealsEvents" => true
                )
            );

            $clientLog = $client->getlog();
        } else {
            return Response::json("Can't find the client", 400);
        }

        $iframe_link = Wazzup::send('iframe', json_encode($body), 'POST');
        
        return View::make("dtf.client")
            ->with('client', $client)
            ->with('statuses', $statuses)
            ->with('iframelink', $iframe_link->url)
            ->with('clientLog', $clientLog);
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

    public function post_setprice() {
        // Write to the log
        $chatId = Input::get('chatId');
        $price = Input::get('price');

        $client = Client::where('chat_id', '=', $chatId)->first();

        if (!is_null($client)) {
            $client->price($price);

            return Response::json(array('status'=>'ok', 'message'=>'price successfully set', 'code'=>'0201'));
        } else {
            return Response::json('Client is empty', 400);
        }
    }

    public function post_setsupply() {
        // Write to the log
        $chatId = Input::get('chatId');
        $amount = Input::get('amount');

        $client = Client::where('chat_id', '=', $chatId)->first();

        if (!is_null($client)) {
            $client->supply($amount, 'Количество метража принта');

            return Response::json(array('status'=>'ok', 'message'=>'supply successfully set', 'code'=>'0201'));
        } else {
            return Response::json('Client is empty', 400);
        }
    }
    
    public function post_setcomment() {
        // Write to the log
        $chatId = Input::get('chatId');
        $text = Input::get('text');
        $client = Client::where('chat_id', '=', $chatId)->first();
        
        if (!is_null($client)) {
            $client->log('comment', $text);
            $client->save();         

            return Response::json(array('status'=>'ok', 'message'=>'comment is saved', 'code'=>'0203'));
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