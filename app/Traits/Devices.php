<?php

namespace App\Traits;


use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;
use Jenssegers\Agent\Agent;
use Spatie\Activitylog\Models\Activity;

trait Devices
{
    public function device(): array
    {
        $agent = new Agent();

        $robot = $agent->isRobot();
        if ($robot) {
            $agent->robot();
        }

        return [
            'type' => $agent->deviceType(),
            'device' => $agent->device(),
            'browser' => $agent->browser(),
            'platform' => $agent->platform(),
            'browser_version' => $agent->version($agent->browser()),
            'platform_version' => $agent->version($agent->platform()),
            'languages' => $agent->languages(),
            'match' => $agent->match('regexp'),
            'agent' => Request::header('user-agent'),
            'method' => Request::method(),
            'robot' => $robot
        ];
    }

    //Ghi lại các thay đổi đối với tất cả các fillable
    protected static $logFillable = true;


    //Ghi thay đổi các cột cụ thể
    //protected static $logAttributes = ['name', 'text'];

    //Không ghi các cột
    //protected static $ignoreChangedAttributes = ['id'];

    //Ghi nhật ký khoá ngoại liên quan
//    protected static $logAttributes = ['*', 'userInfo.phone'];

    //Tùy chỉnh các sự kiện được ghi lại, mặc định ghi thêm sửa xoá
    //protected static $recordEvents = ['deleted'];

    //Chỉ ghi nhật ký các thuộc tính đã thay đổi
    protected static $logOnlyDirty = true;

    //Không lưu các thuộc tính không thay đổi
    protected static $submitEmptyLogs = false;


    public function tapActivity(Activity $activity)
    {
        $activity->causer_type = class_basename(__CLASS__);
        $activity->subject_type = Request::fullUrl();
        $activity->ip = Request::ip();
        $activity->agent = $this->device();
    }

}
