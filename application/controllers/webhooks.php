<?php

class Webhooks_Controller extends Base_Controller {
    public $restful = true;

    public function post_getall() {
        $tz = new DateTimeZone('Asia/Almaty');

        $payload=file_get_contents("php://input");
		
		file_put_contents(path('public').'all.txt', $payload);
        
        $response = json_decode($payload);

        if (error_get_last() != JSON_ERROR_NONE) {
            if (property_exists($response, 'messages')) {
                $messageArr = $response->messages[0];

                $message = new Message();
                $message->message_id = $messageArr->messageId;
                $message->channel_id = $messageArr->channelId;
                $message->chat_type = $messageArr->chatType;
                $message->chat_id = $messageArr->chatId;
                $message->type = $messageArr->type;
                $message->is_echo = $messageArr->isEcho ? 1 : 0;
                $message->contact_name = $messageArr->contact->name;

                if (property_exists($messageArr->contact, 'avatarUri')) {
                    $message->contact_avatar = $messageArr->contact->avatarUri;
                } else {
                    $message->contact_avatar = null;
                }
                
                if (property_exists($messageArr->contact, 'contentUri')) {
                    $message->content_uri = $messageArr->contact->contentUri;
                } else {
                    $message->content_uri = null;
                }

                if (property_exists($messageArr, 'text')) {
                    $message->text = $messageArr->text;
                } else {
                    $message->text = null;
                }

                if (property_exists($messageArr, 'quotedMessage')) {
                    $message->quoted_message = serialize($messageArr->quotedMessage);
                } else {
                    $message->quoted_message = null;
                }

                if ($message->status == 'sent') {
                    $message->status = 1;
                } else if ($message->status == 'delivered') {
                    $message->status = 2;
                } else if ($message->status == 'read') {
                    $message->status = 3;
                } else if ($message->status == 'inbound') {
                    $message->status = 4;
                } else if ($message->status == 'error') {
                    $message->status = 0;
                } else {
                    $message->status = 5;
                }

                if ($messageArr->isEcho) {
                    $message->author_name = $messageArr->authorName;
                } else {
                    $message->author_name = null;
                }

                if (property_exists($messageArr, 'authorId')) { 
                    $message->author_id = $messageArr->authorId;
                }

                $date = new DateTime($messageArr->dateTime);
                $date->setTimezone($tz);

                $message->date_time = $date;
                
                if (property_exists($messageArr,'error_type')) {
                    $message->error_type = $messageArr->error->error;
                } else {
                    $message->error_type = null;
                }

                $message->save();

                self::create_client($messageArr);
            }
        }

        // We should return 200 ok
        return Response::json(array('status'=>'ok'));
    }

    private function create_client ($data) {
        $client = Client::where('chat_id', '=', '77075093172')->first();
        
        if (is_null($client)) {
            var_dump('make new client');

            $client = new Client();
    
            // By default 1, we don't have another users in Wazzup
            $client->user_id = 1;
            $client->name = $data->contact->name;
            $client->chat_type = $data->chatType;
            $client->chat_id = $data->chatId;
            // Source is hardcoded, because I don't use Wazzup create deal functional
            $client->source = 'self';
            $client->current_status = 'new';
    
            $client->save();
        }

        var_dump('nope old');
    }
}