<?php

namespace app\api\model;

use think\Model;

class CarDataComputed extends Model
{
    //
    protected $pk = ['uid', 'gid'];
    protected $table = 'car_computed_data';
}
