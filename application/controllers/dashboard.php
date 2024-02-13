<?php

class Dashboard_Controller extends Base_Controller {
    public $restful = true;

    public function get_tasks() {
        if (Auth::user()->alevel != 1) {
            return Response::error(403);
        }

        $now = new DateTime();

        if (Input::has('filter_start_date') && preg_match('|[0-9]{2}\.[0-9]{2}\.[0-9]{4}|', Input::get("filter_start_date"))) {
            $dt = new DateTime(Input::get('filter_start_date'));
            $from_date = $dt->format('Y-m-d');
        } else {
            $from_date = $now->format('Y-m-01');
        }

        if (Input::has('filter_end_date') && preg_match('|[0-9]{2}\.[0-9]{2}\.[0-9]{4}|', Input::get("filter_end_date"))) {
            $dt = new DateTime(Input::get('filter_end_date'));
            $to_date = $dt->format('Y-m-d');
        } else {
            $to_date = $now->format('Y-m-t');
        }

        // For Month by default
        $statbydate = DB::query("select count(current_status) as cnt, current_status, date(created_at) as times 
            from clients where created_at >= '$from_date'
            and created_at <= '$to_date'
            group by current_status, times 
            order by cnt desc");

        // Total


        // By manager

        return View::make('dtf.dashboardtasks')
            ->with('statbydate', $statbydate);
    }
}