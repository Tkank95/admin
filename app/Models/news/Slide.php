<?php

namespace App\Models\news;

use App\Traits\ConvertDate;
use App\Traits\Devices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Slide extends Model
{
    use LogsActivity, Devices, HasFactory, Notifiable, ConvertDate;

    //Tên nhật ký
    protected static $logName = 'slide';

    //Tùy chỉnh mô tả
    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} ";
    }

    protected $table = 'slides';

    protected $fillable = ['name', 'content', 'description', 'link', 'image', 'status', 'created_at', 'updated_at'];

    protected static function booted()
    {
        static::deleting(function ($model) {
            activity()->withoutLogs(function () use ($model) {
                $insertOldDel = $model->replicate();
                $insertOldDel->setTable('slides_del');
                $insertOldDel->old_id = $model->id;
                $insertOldDel->user_id_del = auth()->id();
                $insertOldDel->created_at = $model->created_at;
                $insertOldDel->updated_at = $model->updated_at;
                $insertOldDel->create_time = now();
                $insertOldDel->timestamps = false;
                $insertOldDel->save();
            });
        });
    }
}
