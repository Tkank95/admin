<?php

namespace App\Http\Services\members\Log;

use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

class LogActionService
{
    public function uniqueLogAction()
    {
        return DB::table('activity_log')->select(['log_name', 'description', 'causer_id']);
    }

    public function uniqueLogName()
    {
        return $this->uniqueLogAction()->select('log_name')->groupBy('log_name')->get();
    }

    public function uniqueDescription()
    {
        return $this->uniqueLogAction()->select('description')->groupBy('description')->get();
    }

    public function uniqueCauserId()
    {
        return $this->uniqueLogAction()->join('users', 'causer_id', '=', 'users.id')
                    ->select('activity_log.causer_id', 'users.username')->groupBy('causer_id')->get();
    }
}
