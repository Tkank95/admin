<?php

namespace App\Models\money;

use App\Traits\ConvertDate;
use App\Traits\Devices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Expense extends Model
{
    use LogsActivity, Devices, HasFactory, Notifiable, ConvertDate;

    //Tên nhật ký
    protected static $logName = 'expenses';

    //Tùy chỉnh mô tả
    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} ";
    }

    public $table = 'expenses';

    protected $fillable = ['payment_date', 'expense_cate', 'amount_vnd', 'amount_usd', 'rate', 'description'];

    protected $casts = [
        'payment_date' => 'datetime',
        'expense_cate' => 'integer',
        'amount_vnd' => 'integer',
        'amount_usd' => 'float',
        'rate' => 'integer',
        'description' => 'string'
    ];

    public function expense_category(): BelongsTo
    {
        return $this->belongsTo(ExpenseCategory::class, 'expense_cate', 'id');
    }

    // Chuyển đổi định dạng date
    public function getPaymentDateAttribute($value)
    {
        return date('Y-m-d H:i:s', strtotime($value));
    }

}
