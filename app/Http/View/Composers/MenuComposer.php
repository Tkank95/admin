<?php

namespace App\Http\View\Composers;

use App\Models\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MenuComposer
{
    public function __construct()
    {
//        $menus = Application::select('id','name','cate_id')
//            ->where([['cate_id','=','0'],['status','=','1']])
//            ->with(['categoryChild:id,name,cate_id'])
//            ->get();

        $menus = DB::table('applications')->select('id','name','cate_id')
            ->where([['cate_id','=','0'],['status','=','1']])->get();

        $this->application = $menus;
    }

    public function compose(View $view)
    {
        $view->with('menus', $this->application);
    }
}
