<?php

class Table_Controller extends Base_Controller {
    public $restful = true;

    public function get_index() {
        $clients = DB::query("select distinct clients.id, clients.name, clients.chat_id, clients.current_status, clients.updated_at, 
            MAX(messages.date_time) AS new_update, MAX(deals.price) AS last_price
            from clients 
            inner join messages on clients.chat_id = messages.chat_id
            left outer join deals on clients.chat_id = deals.chat_id
            GROUP BY clients.chat_id, clients.name, deals.chat_id, clients.current_status
            ORDER BY new_update DESC;");

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