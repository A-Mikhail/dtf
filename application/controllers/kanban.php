<?php

class Kanban_Controller extends Base_Controller {
    public $restful = true;

    public function get_index() {
        $clients = Client::where("current_status","!=","reject")->get('name', 'chat_id', 'current_status', 'updated_at');
        $statuses = Client::where('current_status','!=','reject')->get('current_status');

        return View::make("dtf.kanban")
            ->with('clients', $clients)
            ->with('statuses', $statuses);
    }
}