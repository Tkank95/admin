<?php

namespace App\Models\news;

use App\Traits\ConvertDate;
use App\Traits\Devices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;

class New_Tutorial extends Model
{
    use HasFactory, LogsActivity, Devices, ConvertDate;

    //Tên nhật ký
    protected static $logName = 'new_tutorial';

    //Tùy chỉnh mô tả
    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} ";
    }

    protected $casts = [
        'agent' => 'array'
    ];

    protected $table = 'new_tutorials';

    protected $fillable = ['user_id', 'app_id', 'title', 'content', 'image', 'top'];

    public function newsUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function newsApp(): BelongsTo
    {
        return $this->belongsTo(Application::class, 'app_id' ,'id');
    }

    // Thêm tên user và tên ứng dụng vào truy vấn
    public function scopeUserApp($query)
    {
        $query->addSelect(['user_id' => User::select('username')
            ->whereColumn('user_id', 'users.id')
        ])->addSelect(['app_id' => Application::select('name')
            ->whereColumn('app_id', 'applications.id')
        ]);
    }

    protected static function booted()
    {
        static::deleting(function ($model) {
            $insertOldDel = $model->replicate();
            $insertOldDel->setTable('new_tutorials_del');
            $insertOldDel->old_id = $model->id;  //
            $insertOldDel->user_id_del = auth()->id();
            $insertOldDel->created_at = $model->created_at;
            $insertOldDel->updated_at = $model->updated_at;
            $insertOldDel->create_time = now();
            $insertOldDel->timestamps = false;
            $insertOldDel->save();
        });
    }
}
