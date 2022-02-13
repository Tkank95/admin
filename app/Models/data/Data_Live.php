<?php

namespace App\Models\data;

use App\Traits\ConvertDate;
use App\Traits\Devices;
use App\Traits\InsertDel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Data_Live extends Model
{
    use LogsActivity, Devices, HasFactory, Notifiable, ConvertDate, InsertDel;

    //Tên nhật ký
    protected static $logName = 'data_live';

    //Tùy chỉnh mô tả
    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} ";
    }

    protected $table = 'data_live';

    protected $fillable = ['apply_id', 'date', 'valid_time', 'valid_day', 'income', 'new_fan'];

    protected $casts = [
        'apply_id' => 'integer',
        'date' => 'date',
        'valid_time' => 'string',
        'valid_day' => 'boolean',
        'income' => 'integer',
        'new_fan' => 'integer'
    ];

    public function dataLive(): BelongsTo
    {
        return $this->belongsTo(Apply_Job::class, 'apply_id', 'id');
    }

}
