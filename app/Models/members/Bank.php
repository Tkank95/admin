<?php

namespace App\Models\members;

use App\Traits\ConvertDate;
use App\Traits\Devices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;

class Bank extends Model
{
    use HasFactory, LogsActivity, Devices, ConvertDate;

    //Tên nhật ký
    protected static $logName = 'bank';

    //Tùy chỉnh mô tả
    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} ";
    }

    //Ghi nhật ký khoá ngoại liên quan
    protected static $logAttributes = ['*', 'bankUser.email', 'bankUser.username'];

    protected $table = 'banks';

    protected $fillable = ['user_id', 'name', 'account', 'bank_name', 'branch'];

    protected $casts = [
        'user_id' => 'integer',
        'name' => 'string',
        'account' => 'integer',
        'bank_name' => 'string',
        'branch' => 'string'
    ];

    public function bankUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
