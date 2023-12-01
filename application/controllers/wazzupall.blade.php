<?php

class Wazzupall_Controller extends Base_Controller {
    public $restful = true;

    public function get_all() {
		$body = (object)array(
			"user"=> array(
				"id"=> (string)Auth::user()->id,
				"name"=> Auth::user()->username
			),
			"scope"=> "global"
		);
        
        $iframe_link = Wazzup::send('iframe', json_encode($body), 'POST');

        if (property_exists($iframe_link, 'url')) {
            return View::make('dtf.wazzupall')
                ->with('iframeurl', $iframe_link->url);
        } else {
            return Response::json('Error while generating contact link', 404);
        }
    }
}