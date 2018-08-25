<?php

namespace app\api\model;

use think\Model;

class CarData extends Model
{
    //
    protected $pk = ['uid', 'gid', 'g_sid'];
    protected $table = 'car_data';
}
