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

        $clientClass = new Client;

        foreach ($clients as $client) {
            if (!in_array($clientClass->rustatus($client), $clientstat_uniq)) {
                $clientstat_uniq[] = $clientClass->rustatus($client);
            }   

            $client->current_status = $clientClass->rustatus($client);
        }
        
        return View::make("dtf.table")
            ->with('clients', $clients)
            ->with('uniqueStatuses', $clientstat_uniq);
    }
}