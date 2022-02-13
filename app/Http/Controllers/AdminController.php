<?php

namespace App\Http\Controllers;


use App\Models\members\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.home', [
            'title' => 'Tribe Admin',
        ]);
    }

    // Hiển thị ứng dụng thuộc Category
    public function loadCate(Request $request): JsonResponse
    {
        $app = DB::table('applications')->select('id', 'name')->where('cate_id', $request->id)->get();

        return response()->json($app);
    }

    // Lấy thông tin user theo id để hiển thị lên form
    public function loadUser(Request $request): JsonResponse
    {
        $user = DB::table('users')->select('name', 'username', DB::raw('(CASE
                                    WHEN users.position = "1" THEN "Admin"
                                    WHEN users.position = "2" THEN "Smod"
                                    WHEN users.position = "3" THEN "Mod"
                                    WHEN users.position = "4" THEN "Agency"
                                    ELSE "User" END) AS position'))->where('id', $request->id)->get();

        return response()->json($user);
    }

    public function getApp()
    {
        return DB::table('applications')->select('id', 'name')->where('cate_id', '<>', 0)->get();
    }

    public function getUser()
    {
        return DB::table('users')->select('id', 'username')->get();
    }

    public function selectSearchUserName(Request $request): JsonResponse
    {
        $users = [];

        if ($request->has('q')) {
            $users = DB::table('users')->select('id', 'username', 'avatar')
                ->where('username', 'LIKE', "%$request->q%")
                ->get();
        }
        return response()->json($users);
    }

    public function getSelectUser(User $id): JsonResponse
    {
        $users = DB::table('users')->select('id', 'username', 'avatar')
            ->where('id', $id->id)
            ->get();

        return response()->json($users);
    }
}
