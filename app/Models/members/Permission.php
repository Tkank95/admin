<?php

namespace App\Models\members;

use App\Traits\ConvertDate;
use App\Traits\Devices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Permission extends Model
{
    use LogsActivity, Devices, HasFactory, Notifiable, ConvertDate;

    //Tên nhật ký
    protected static $logName = 'permission';

    //Tùy chỉnh mô tả
    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} ";
    }

    protected $table = 'permissions';

    protected $fillable = ['name','display_name', 'parent_id','key_code'];

    public function permissionChild(): HasMany
    {
        return $this->hasMany(Permission::class,'parent_id');
    }

    protected static function booted()
    {
        static::deleting(function ($model) {
            $insertOldDel = $model->replicate();
            $insertOldDel->setTable('permissions_del');
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
