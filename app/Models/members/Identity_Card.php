<?php

namespace App\Models\members;

use App\Traits\ConvertDate;
use App\Traits\Devices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Identity_Card extends Model
{
    use LogsActivity, Devices, HasFactory, Notifiable, ConvertDate;

    //Tên nhật ký
    protected static $logName = 'identity_card';

    //Tùy chỉnh mô tả
    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} ";
    }

    protected $table = 'identity_card';

    protected $fillable = ['apply_id', 'number_cmnd', 'cmnd_mt', 'cmnd_ms', 'selfie_cmnd', 'selfie', 'selfie_team', 'game', 'rank_image', 'video_casting', 'video_proof'];

    public function identityApply(): BelongsTo
    {
        return $this->belongsTo(Apply_Job::class, 'apply_id', 'id');
    }

    protected static function booted()
    {
        static::deleting(function ($model) {
            $insertOldDel = $model->replicate();
            $insertOldDel->setTable('identity_card_del');
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
