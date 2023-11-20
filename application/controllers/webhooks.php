<?php

class Webhooks_Controller extends Base_Controller {
    public $restful = true;

    public function post_getall() {
        $payload=file_get_contents("php://input");
		
		file_put_contents(path('public').'all.txt', $payload);

        // We should return 200 ok
        return Response::json(array('status'=>'ok'));
    }

    public function post_messages() {
        $payload=file_get_contents("php://input");
		
		file_put_contents(path('public').'messages.txt', $payload);

        // We should return 200 ok
        return Response::json(array('status'=>'ok'));
    }

    public function post_contacts() {
        $payload=file_get_contents("php://input");
        $payload=json_decode($payload,true);
		
		file_put_contents(path('public').'contacts.txt', $payload);

        // We should return 200 ok
        return Response::json(array('status'=>'ok'));
    }

    public function post_channelsUpdates() {
        $payload=file_get_contents("php://input");
        $payload=json_decode($payload,true);
		
		file_put_contents(path('public').'channelsUpdates.txt', $payload);

        // We should return 200 ok
        return Response::json(array('status'=>'ok'));
    }
}