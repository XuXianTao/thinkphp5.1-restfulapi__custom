<?php

namespace app\api\controller\v1;

use app\api\controller\Api;
use app\api\model\CarData;
use app\api\model\CarImage;
use think\Controller;
use think\db\Query;
use think\Request;

class CarDataRest extends CarRest
{
    /**
     * 显示资源列表get /v1/car
     *
     * @return \think\Response
     */
    public function index()
    {
        //
        //echo 'index';
        parent::index();
        $result = $this->result_get;
        $tmp = CarData::where($this->query_get);
        $tmp_count = clone $tmp;
        $result['total'] = $tmp_count->count();
        $result['list'] = $tmp->limit($result['page_size'])->page($result['page'])->select();
        self::returnMsg(200, 'Get Data Successfully.', $result);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源，处理一维数据post /v1/car
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        if ($request->contentType()!=='application/json') {
            self::returnMsg(406, ' The Content-Type is not application/json');
        }
        $input = json_decode($request->getContent(), true);
        $gid = $input['gid'];
        unset($input['gid']);
        foreach($input as $sid => $sdata) {
            CarData::create([
                'uid' => $this->uid,
                'gid' => $gid,
                'g_sid' => $sid,
                'ccd' => $sdata['ccd'],
                'electric' => $sdata['electric'],
                'acceleration' => $sdata['acceleration'],
                'speed' => $sdata['speed']
            ]);
        }
        self::returnMsg(201, 'Successfully Saved.');
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $type
     * @return \think\Response
     */
    public function read($id)
    {

    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
        if ($id === 'all') {
            db(CarData::getTable())->where('1=1')->delete();
        } else {
            CarData::destroy(['uid' => $id]);
        }
        self::returnMsg(204, 'Delete Successfully.');
    }

    public function imageSave(Request $request)
    {

    }
}
