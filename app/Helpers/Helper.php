<?php

namespace App\Helpers;
use Webpatser\Uuid\Uuid;
use Auth;

class Helper {

    public static function auth($need) {
        if($need == 'admin') {
            return Auth::guard('admin')->user();
        }else if($need == 'teacher') {
            return Auth::guard('teacher')->user();
        }else {
            return Auth::user();
        }
    }

    public static function getUuid() {
        return Uuid::generate(4);
    }

}
