<?php

namespace App\Models\data;

use App\Traits\ConvertDate;
use App\Traits\Devices;
use App\Traits\InsertDel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class Apply_Job extends Model
{
    use LogsActivity, Devices, HasFactory, Notifiable, ConvertDate, InsertDel;

    //Tên nhật ký
    protected static $logName = 'apply_job';

    //Tùy chỉnh mô tả
    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} ";
    }

    protected $table = 'apply_jobs';

    protected $fillable = ['user_id', 'app_id', 'id_in_app', 'nickname', 'team', 'worked', 'talent', 'experience', 'cast_datetime'];

    protected $casts = [
        'user_id' => 'integer',
        'app_id' => 'integer',
        'id_in_app' => 'string',
        'nickname' => 'string',
        'team' => 'string',
        'worked' => 'string',
        'talent' => 'string',
        'experience' => 'string',
        'cast_datetime' => 'string',
    ];

    public function identityCard(): HasOne
    {
        return $this->hasOne(Identity_Card::class, 'apply_id', 'id');
    }

    public function resultCast(): HasOne
    {
        return $this->hasOne(Result_Cast::class, 'apply_id', 'id');
    }

    public function applyUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function applyApp(): BelongsTo
    {
        return $this->belongsTo(Application::class, 'app_id', 'id');
    }

    protected static function booted()
    {
        static::deleting(function ($model) {
            DB::transaction(function () use ($model) {
                activity()->withoutLogs(function () use ($model) {
                    $id = $model->id;
                    $column = 'apply_id';
                    $table = [
                        'identity_card' => 'identity_card_del',
                    ];

                    // Copy bản ghi từ các bảng và lưu vào bảng chứa history, sau đó xoá bản ghi
                    foreach ($table as $key => $value) {
                        self::insertDel($id, $column, $key, $value, '');
                    }

                    // Copy bản ghi xoá và lưu vào bảng chứa history
                    self::addInsertDel($model, 'apply_jobs_del');
                });
            });
        });
    }
}
