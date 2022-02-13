<?php

namespace App\Models\money;

use App\Traits\ConvertDate;
use App\Traits\Devices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Income extends Model
{
    use LogsActivity, Devices, HasFactory, Notifiable, ConvertDate;

    //Tên nhật ký
    protected static $logName = 'incomes';

    //Tùy chỉnh mô tả
    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} ";
    }

    public $table = 'incomes';

    protected $fillable = ['received_date', 'income_cate', 'amount_vnd', 'amount_usd', 'rate', 'description'];

    protected $casts = [
        'received_date'=> 'datetime',
        'income_cate'=> 'integer',
        'amount_vnd' => 'integer',
        'amount_usd' => 'float',
        'rate' => 'integer',
        'description'=> 'string'
    ];

    public function income_category(): BelongsTo
    {
        return $this->belongsTo(IncomeCategory::class, 'income_cate');
    }

    // Chuyển đổi định dạng date
    public function getReceivedDateAttribute($value)
    {
        return date('Y-m-d H:i:s', strtotime($value));
    }
}
