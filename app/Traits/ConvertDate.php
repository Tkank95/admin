<?php

namespace App\Traits;

trait ConvertDate
{
    // Chuyển đổi định dạng date
    public function getUpdatedAtAttribute($value)
    {
        return date('Y-m-d H:i:s', strtotime($value));
    }

    // Chuyển đổi định dạng date
    public function getCreatedAtAttribute($value)
    {
        return date('Y-m-d H:i:s', strtotime($value));
    }

}
