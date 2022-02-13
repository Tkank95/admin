<?php

namespace App\Traits;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

trait GetCountTable
{
    public function getCountTable($table, $col1, $col2, $col3, $search1, $search2, $tableJoin = '',
                                  $fk = '', $operator = '', $pk = ''): Builder
    {
        $to = request('end_date');
        $from = request('start_date');
        $filter1 = request('filter1');
        $filter2 = request('filter2');
        $filter3 = request('filter3');
        $search = request('datatableSearch');

        $news = DB::table($table);

        if (!empty(request()->input())) {
            if ($filter1 != '') {
                $tableJoin == '' ? $news->where($col1, $filter1) : $news->join($tableJoin, $fk, $operator, $pk)->where($col1, $filter1);
            }
            if ($filter2 != '') {
                $news->where($col2, $filter2);
            }
            if ($filter3 != '') {
                $news->where($col3, $filter3);
            }
            if ($search != '' ) {
                $search2 != '' ? $news->where($search1, 'like', "%" . $search . "%")->orwhere($search2, 'like', "%" . $search . "%") : $news->where($search1, 'like', "%" . $search . "%");
            }
            if ($from != '' && $to != '' && $to >= $from) {
                $news->whereBetween($table . '.created_at', [$from . " 00:00:00", $to . " 23:59:59"]);
            }
        }

        return $news;
    }

}
