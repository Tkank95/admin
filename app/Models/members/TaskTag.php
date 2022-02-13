<?php

namespace App\Model\members;

use App\Traits\ConvertDate;
use App\Traits\Devices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class TaskTag extends Model
{
    use LogsActivity, Devices, HasFactory, Notifiable, ConvertDate;

    //Tên nhật ký
    protected static $logName = 'task_tag';

    //Tùy chỉnh mô tả
    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName}";
    }

    protected $table = 'task_tags';

    protected $fillable = ['name'];

    protected $casts = ['name' => 'string'];
}
