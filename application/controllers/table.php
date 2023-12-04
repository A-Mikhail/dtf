<?php

class Table_Controller extends Base_Controller {
    public $restful = true;

    public function get_index() {
        $clients = Client::order_by('id', 'desc')->get(array('id', 'name', 'chat_id', 'current_status', 'updated_at'));
        
        $clientstat_uniq = array();

        foreach ($clients as $client) {
            if (!in_array($client->rustatus(), $clientstat_uniq)) {
                $clientstat_uniq[] = $client->rustatus();
            }   

            $client->current_status = $client->rustatus();
        }
        
        return View::make("dtf.table")
            ->with('clients', $clients)
            ->with('uniqueStatuses', $clientstat_uniq);
    }
}