<?php

class Table_Controller extends Base_Controller {
    public $restful = true;

    public function get_index() {
        if (Input::has('reporting_date')) {
            list($month, $year) = explode('-', Input::get('reporting_date'));
        } else {
            $month = date('m');
            $year = date('Y');
        }

        $minopermonth = Client::min('created_at');
        $minopermonth = new DateTime($minopermonth);
        $from = new DateTime();
        $to = $minopermonth;
        $rumonths = array('', 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь');
        $months = array();

        while ($from > $to) {
            $months[$from->format('m-Y')] = $rumonths[$from->format('n')] . ', ' . $from->format('Y');
            $from->modify('-1 month');
        }

        // ---------------------------------
        // case when MAX(deals.price <= 0) = 0 then MAX(deals.price) end AS last_price
        // Return price that is zero or less
        // https://stackoverflow.com/questions/19763806/how-consider-null-as-the-max-date-instead-of-ignoring-it-in-mysql
        // ---------------------------------
        $clients = DB::query("select distinct clients.id, clients.name, clients.chat_id, clients.current_status, clients.updated_at, clients.created_at, 
            MAX(messages.date_time) AS new_update, case when MAX(deals.price <= 0) = 0 then MAX(deals.price) end AS last_price,
            case when MAX(supplies.amount <= 0) = 0 then MAX(supplies.amount) end AS last_supply_m
            from clients 
            inner join messages on clients.chat_id = messages.chat_id
            left outer join deals on clients.chat_id = deals.chat_id
            left outer join supplies on clients.chat_id = supplies.chat_id
            where YEAR(clients.created_at) = '".Input::get('date',$year)."' and MONTH(clients.created_at) = '".Input::get('date',$month)."'
            GROUP BY clients.chat_id, clients.name, deals.chat_id, clients.current_status
            ORDER BY new_update DESC;");

        $clientstat_uniq = array();

        $clientClass = new Client;

        foreach ($clients as $client) {
            if (!in_array($clientClass->rustatus($client), $clientstat_uniq)) {
                $clientstat_uniq[] = $clientClass->rustatus($client);
            }   

            $client->current_status = $clientClass->rustatus($client);
            $client->updated_at = date('d.m.Y', strtotime($client->updated_at));
            $client->created_at = date('d.m.Y', strtotime($client->created_at));
        }
        
        return View::make("dtf.table")
            ->with('clients', $clients)
            ->with('uniqueStatuses', $clientstat_uniq)
            ->with('months',$months);
    }
}