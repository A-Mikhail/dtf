<?php

class Table_Controller extends Base_Controller {
    public $restful = true;

    public function get_index() {
        $clients = Client::order_by('id', 'desc')->get(array('id', 'name', 'chat_id', 'current_status', 'updated_at'));

        foreach ($clients as $client) {
            $client->current_status = $client->rustatus();
        }

        return View::make("dtf.table")
            ->with('clients', $clients);
    }
}