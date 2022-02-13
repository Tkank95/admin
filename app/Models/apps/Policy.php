<?php

namespace App\Models\apps;

use App\Traits\ConvertDate;
use App\Traits\Devices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;

class Policy extends Model
{
    use HasFactory, LogsActivity, Devices, ConvertDate;

    //Tên nhật ký
    protected static $logName = 'policy';

    //Tùy chỉnh mô tả
    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} ";
    }

    //Ghi nhật ký khoá ngoại liên quan
//    protected static $logAttributes = ['*', 'bankUser.email', 'bankUser.username'];

    protected $table = 'policy';

    protected $fillable = ['app_id', 'policy_idol', 'policy_agency', 'active_day', 'status'];

    protected $casts = [
        'app_id' => 'integer',
        'policy_idol' => 'string',
        'policy_agency' => 'string',
        'active_day' => 'date',
        'status' => 'integer'
    ];

    public function policyApp(): BelongsTo
    {
        return $this->belongsTo(Application::class,'app_id','id');
    }
}
