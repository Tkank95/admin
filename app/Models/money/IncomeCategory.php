<?php

namespace App\Models\money;

use App\Traits\ConvertDate;
use App\Traits\Devices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class IncomeCategory extends Model
{
    use LogsActivity, Devices, HasFactory, Notifiable, ConvertDate;

    //Tên nhật ký
    protected static $logName = 'income_cate';

    //Tùy chỉnh mô tả
    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} ";
    }

    protected $table = 'income_categories';

    protected $fillable = ['name'];

    protected $casts = ['name' => 'string'];
}
