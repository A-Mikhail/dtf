<?php

class Table_Controller extends Base_Controller {
    public $restful = true;

    public function get_index() {
        $clients = Client::order_by('id', 'desc')->get(array('name', 'chat_id', 'current_status', 'updated_at'));

        return View::make("dtf.table")
            ->with('clients', $clients);
    }
}