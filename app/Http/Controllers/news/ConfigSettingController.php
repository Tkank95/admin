<?php

namespace App\Http\Controllers\news;

use App\DataTables\ConfigPageDataTable;
use App\Http\Requests\ConfigPage\ConfigPageFormRequest;
use App\Models\Config_Page;
use App\Traits\DeleteMultipleTrait;
use App\Traits\DeleteTrait;
use App\Traits\LogShowTrait;
use App\Traits\LogViewTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;


class ConfigSettingController extends Controller
{
    use DeleteTrait, DeleteMultipleTrait, LogViewTrait, LogShowTrait;

    private Config_Page $config_Page;
    private $name = 'config_page';

    public function __construct(Config_Page $config_Page)
    {
        $this->config = $config_Page;
    }

    public function index(ConfigPageDataTable $dataTable)
    {
        return $dataTable->render('admin.setting', [
            'title' => 'Config Setting Page',
        ]);
    }

    public function store(ConfigPageFormRequest $request): JsonResponse
    {
        try {
            Config_Page::create($request->input());
            return response()->json([
                'code' => 200,
                'key' => $request->config_key,
                'message' => 'success'
            ], 200);

        } catch (Exception $err) {
            Log::error($err->getMessage() . ' Line: ' . $err->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }

    public function show(Config_Page $id): JsonResponse
    {
        return response()->json($id);
    }

    public function update(Config_Page $id, ConfigPageFormRequest $request): JsonResponse
    {
        try {
            $id->fill($request->input());
            $id->save();
            return response()->json([
                'code' => 200,
                'key' => $request->config_key,
                'message' => 'success'
            ], 200);

        } catch (Exception $err) {
            Log::error($err->getMessage() . ' Line: ' . $err->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }

    public function destroy(Config_Page $id): JsonResponse
    {
        return $this->deleteTrait($id);
    }

    // Xoá nhiều bản ghi cùng lúc
    public function deleteMultiple(): JsonResponse
    {
        return $this->deleteMultipleTrait($this->config, $this->name);
    }
}
