<?php

namespace App\Models\members;

use App\Models\data\Apply_Job;
use App\Models\news\Comment;
use App\Models\news\New_Tutorial;
use App\Traits\ConvertDate;
use App\Traits\Devices;
use App\Traits\InsertDel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use function activity;
use function auth;

class User extends Authenticatable
{
    use LogsActivity, Devices, HasFactory, Notifiable, ConvertDate, InsertDel;

    //Tên nhật ký
    protected static $logName = 'user';

    //Tùy chỉnh mô tả
    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName} ";
    }

    protected $dates = ['banned_until', 'created_at'];
    protected $table = 'users';

    protected $fillable = ['name', 'email', 'username', 'google_id', 'password', 'position', 'avatar', 'status', 'banned_until'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'agent' => 'array',
        'name' => 'string',
        'email' => 'string',
        'username' => 'string',
        'google_id' => 'integer',
        'password' => 'string',
        'position' => 'integer',
        'avatar' => 'string',
        'status' => 'integer',
        'banned_until' => 'datetime'
    ];

    public function userInfo(): HasOne
    {
        return $this->hasOne(Member_Info::class, 'user_id', 'id');
    }

    public function userBank(): HasOne
    {
        return $this->hasOne(Bank::class, 'user_id', 'id');
    }

    public function userApply(): HasMany
    {
        return $this->hasMany(Apply_Job::class, 'user_id', 'id');
    }

    public function userNews(): HasMany
    {
        return $this->hasMany(New_Tutorial::class, 'user_id', 'id');
    }

    public function userComments(): HasMany
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    public function userActivity(): HasMany
    {
        return $this->hasMany(Activity::class, 'causer_id', 'id');
    }


//    public function teamDatas(): HasMany
//    {
//        return $this->hasMany(Data_live::class, 'user_id', 'id');
//    }

    public function checkPermissionAccess($permissionCheck): bool
    {
        // Lấy tất cả quyền của user đang login
        $roles = auth()->user()->roles;
        foreach ($roles as $role) {
            $permissions = $role->permissions;
            // So sánh giá trị của route hiện tại có tồn tại với các quyền lấy được không
            if ($permissions->contains('key_code', $permissionCheck)) {
                return true;
            }
        }
        return false;
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id')->withTimestamps();
    }

    public function isAdmin(): bool
    {
        return $this->position == 1;
    }

    // Chuyển đổi định dạng date
    public function getBannedUntilAttribute($value)
    {
        return date('Y-m-d H:i:s', strtotime($value));
    }

    // Sao lưu bản ghi đã xoá sang bảng lịch sử xoá
    protected static function booted()
    {
        static::deleting(function ($model) {
            DB::transaction(function () use ($model) {
                activity()->withoutLogs(function () use ($model) {
                    $id = $model->id;
                    $column = 'user_id';
                    $table = [
                        'Member_info' => 'member_info_del',
                        'New_Tutorials' => 'New_Tutorials_del',
                        'banks' => 'banks_del',
                        'apply_jobs' => 'apply_jobs_del',
                        'comments' => 'comments_del',
                        'role_user' => 'role_user_del'
                    ];

                    // Copy bản ghi từ các bảng và lưu vào bảng chứa history, sau đó xoá bản ghi
                    foreach ($table as $key => $value) {
                        self::insertDel($id, $column, $key, $value, '');
                    }

                    self::insertDel($id, 'causer_id', 'activity_log', 'activity_log_del', '');

                    // Copy bản ghi xoá và lưu vào bảng chứa history
                    self::addInsertDel($model, 'users_del');
                });
            });
        });
    }

}
