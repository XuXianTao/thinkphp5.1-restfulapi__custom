<?php

namespace app\api\model;

use think\Model;

class CarImage extends Model
{
    //
    protected $pk = ['uid', 'gid', 'g_sid'];
    protected $table = 'car_image';
}
