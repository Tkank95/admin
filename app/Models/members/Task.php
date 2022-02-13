<?php

namespace App\Models\members;

use App\Traits\ConvertDate;
use App\Traits\Devices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Task extends Model
{
    use LogsActivity, Devices, HasFactory, Notifiable, ConvertDate;

    //Tên nhật ký
    protected static $logName = 'task';

    //Tùy chỉnh mô tả
    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName}";
    }

    public $table = 'tasks';

    protected $fillable = ['user_created', 'user_id', 'tag_id', 'name', 'location', 'description', 'status', 'repeat', 'attachment', 'start', 'end'];

    protected $casts = [
        'user_created' => 'integer',
        'user_id' => 'integer',
        'tag' => 'integer',
        'name' => 'string',
        'location' => 'string',
        'description' => 'string',
        'status' => 'integer',
        'repeat' => 'integer',
        'attachment' => 'string',
        'start' => 'datetime',
        'end' => 'datetime'
    ];

    public function tags(): BelongsTo
    {
        return $this->belongsTo(TaskTag::class, 'tag_id', 'id');
    }

    public function assigned_to(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function createByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_created', 'id')->select('id', 'name', 'username', 'avatar');
    }

    // Chuyển đổi định dạng date
    public function getStartAttribute($value)
    {
        return date('Y-m-d H:i:s', strtotime($value));
    }

    public function getEndAttribute($value)
    {
        return date('Y-m-d H:i:s', strtotime($value));
    }
}
