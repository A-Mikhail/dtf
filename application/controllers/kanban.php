<?php

class Kanban_Controller extends Base_Controller {
    public $restful = true;

    public function get_index() {
        $exclude_statuses = array('reject', 'success');

        $clients = Client::where_not_in('current_status', $exclude_statuses)->get('name', 'chat_id', 'current_status', 'updated_at');
        $statuses = Client::where_not_in('current_status', $exclude_statuses)->distinct()->get('current_status');

        return View::make("dtf.kanban")
            ->with('clients', $clients)
            ->with('statuses', $statuses);
    }
}