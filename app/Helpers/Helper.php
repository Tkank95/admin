<?php

namespace App\Helpers;


use App\Models\Config_Page;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class Helper
{
    public static function status($status = 0, $id): string
    {
        return $status == 0 ? '<span class="btn btn-danger btn-xs active_status" data-id="' . $id . '">NO</span>'
            : '<span class="btn btn-primary btn-xs deactive_status" data-id="' . $id . '">Active</span>';
    }

    public static function image($img): string
    {
        return '<a data-fancybox="single" href="' . $img . '" target="_blank"><img src="' . $img . '" width="100px" height="100px" alt=""></a>';
    }

    public static function action($url, $id): string
    {
        return '<a class="btn btn-sm btn-white" href="' . $url . '/edit/' . $id . '"><i class="tio-edit"></i> Edit</a>
                <a href="" class="btn btn-outline-danger btn-sm action_delete" data-url="' . $url . '/destroy/' . $id . '" >
                <i class="tio-delete-outlined"></i> Delete</a>';
    }

    public static function checkbox($id): string
    {
        return '<div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input checkbox" name="' . $id . '" id="' . $id . '">
                    <label class="custom-control-label" for="' . $id . '"></label>
                </div>';
    }

    public static function gender($gender = 0): string
    {
        return $gender == 0 ? 'Nữ' : 'Nam';
    }

    public static function worked($worked = 0): string
    {
        return $worked == 0 ? 'Chưa' : 'Đã từng';
    }

    public static function position($position): string
    {
        return $position == 1 ? 'Admin' : ($position == 2 ? 'Smod' : ($position == 3 ? 'Mod' : ($position == 4 ? 'Agency' :  'User')));
    }

//    public static function position($position): string
//    {
//        return $position == 1 ? 'Administrator (Admin)' : ($position == 2 ? 'Supermoderator (Smod)' : ($position == 3 ? 'Moderator (Mod)' : ($position == 4 ? 'Agency' :  'User')));
//    }

    public static function getConfigValueFormSetting($configKey)
    {
        $setting = Config_Page::where('config_key', $configKey)->first();
        return $setting->config_value ?? null;
    }

    public static function getCount($table, $col1, $col2, $col3, $search1, $search2): Builder
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
                $news->where($col1, $filter1);
            }
            if ($filter2 != '') {
                $news->where($col2, $filter2);
            }
            if ($filter3 != '') {
                $news->where($col3, $filter3);
            }
            if ($search != '') {
                $news->where($search1, 'like', "%" . $search . "%")
                    ->orwhere($search2,  'like', "%" . $search . "%");
            }
            if ($from != '' && $to != '' && $to >= $from) {
                $news->whereBetween($table.'.created_at', [$from . " 00:00:00", $to . " 23:59:59"]);
            }
        }

        return $news;
    }
}
