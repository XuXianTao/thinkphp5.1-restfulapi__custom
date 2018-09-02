<?php

namespace app\api\controller\v1;

use app\api\controller\Send;
use app\api\model\Car;
use app\api\model\CarData;
use app\api\model\CarDataComputed;
use app\api\model\CarImage;
use think\Controller;

class GetData extends Controller
{
    use Send;

    protected $query_get;

    protected $result_get;

    /**
     * 处理简单的url参数
     */
    protected function baseParam()
    {
        $input = $_GET;
        $result = [
            'total' => 0,
            'page' => 1,
            'page_size' => 10,
            'list' => []
        ];
        $query = [];
        if (isset($input['uid'])) {
            $query += ['uid' => $input['uid']];
        }
        if (isset($input['gid'])) {
            $query += ['gid' => $input['gid']];
        }
        if (isset($input['g_sid'])) {
            $query +=['g_sid' => $input['g_sid']];
        }
        if (isset($input['page'])) {
            $result['page'] = (integer)$input['page'];
        }
        if (isset($input['limit'])) {
            $result['page_size'] = (integer)$input['limit'];
        }
        $this->query_get = $query;
        $this->result_get = $result;
    }

    /**
     * @route('v1/notoken/car/data', 'get')
     */
    public function getData()
    {
        $this->baseParam();
        $result = $this->result_get;
        $tmp = CarData::where($this->query_get);
        $tmp_count = clone $tmp;
        $result['total'] = $tmp_count->count();
        $result['list'] = $tmp->limit($result['page_size'])->page($result['page'])->select();

        self::returnMsg(200, 'Get Data Successfully.', $result);
    }

    /**
     * @route('/v1/notoken/car/image','get')
     */
    public function getImage()
    {
        $this->baseParam();
        $result = $this->result_get;
        $tmp = CarImage::where($this->query_get);
        $tmp_count = clone $tmp;
        $result['total'] = $tmp_count->count();
        $result['list'] = $tmp->limit($result['page_size'])->page($result['page'])->select();
        self::returnMsg(200, 'Get Data Successfully.', $result);
    }

    /**
     * @route('/v1/notoken/car/compute', 'get')
     */
    public function getCompute()
    {
        $this->baseParam();
        $result = $this->result_get;
        $tmp = CarDataComputed::where($this->query_get);
        $tmp_count = clone $tmp;
        $result['total'] = $tmp_count->count();
        $result['list'] = $tmp->limit($result['page_size'])->page($result['page'])->select();
        self::returnMsg(200, 'Get Data Successfully.', $result);
    }

    /**
     * @route('/v1/notoken/car/user', 'get')
     */
    public function getUser()
    {
        $input = $_GET;
        $result = [
            'total' => 0,
            'page' => 1,
            'page_size' => 10,
            'list' => []
        ];
        $query = [];
        if (isset($input['uid'])) {
            $query += ['uid' => $input['uid']];
        }
        if (isset($input['page'])) {
            $result['page'] = (integer)$input['page'];
        }
        if (isset($input['limit'])) {
            $result['page_size'] = (integer)$input['limit'];
        }
        $this->query_get = $query;
        $this->result_get = $result;
        $result = $this->result_get;
        $tmp = Car::where($this->query_get);
        $tmp_count = clone $tmp;
        $result['total'] = $tmp_count->count();
        $result['list'] = $tmp->limit($result['page_size'])->page($result['page'])->select();
        self::returnMsg(200, 'Get Data Successfully.', $result);
    }
}
