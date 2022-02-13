<?php

namespace App\Models\apps;

use App\Traits\ConvertDate;
use App\Traits\Devices;
use App\Traits\InsertDel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;

class Application extends Model
{
    use LogsActivity, Devices, HasFactory, Notifiable, ConvertDate, InsertDel;

    //Tên nhật ký
    protected static $logName = 'application';

    //Tùy chỉnh mô tả
    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} ";
    }

    protected $table = 'applications';

    protected $fillable = ['cate_id','name','logo', 'link_download', 'top', 'status'];

    public function categoryChild(): HasMany
    {
        return $this->hasMany(Application::class, 'cate_id');
    }

    public  function appNews(): HasMany
    {
        return $this->hasMany(New_Tutorial::class,'app_id', 'id');
    }

    public function appPromotes(): HasOne
    {
        return $this->hasOne(Promote::class,'app_id', 'id');
    }

    protected static function booted()
    {
        static::deleting(function ($model) {
            $insertOldDel = $model->replicate();
            $insertOldDel->setTable('applications_del');
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
