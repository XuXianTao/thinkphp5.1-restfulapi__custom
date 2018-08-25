<?php

namespace app\api\controller\v1;

use app\api\model\Car;
use think\Controller;
use think\Request;
use app\api\controller\Api;

class User extends CarRest
{
    /**
     * 显示资源列表get /v1/user
     *
     * @return \think\Response
     */
    public function index()
    {
        parent::index();
        $result = $this->result_get;
        $tmp = Car::where($this->query_get);
        $tmp_count = clone $tmp;
        $result['total'] = $tmp_count->count();
        $result['list'] = $tmp->limit($result['page_size'])->page($result['page'])->select();
        self::returnMsg(200, 'Get Data Successfully.', $result);
    }

    /**
     * 显示创建资源表单页.get /v1/user/create
     *
     * @return \think\Response
     */
    public function create()
    {
        echo "create";
    }

    /**
     * 保存新建的资源post /v1/user
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        dump($this->uid);
        echo "save";
    }

    /**
     * 显示指定的资源get /v1/user/$id
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        echo "read". $id;
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        echo "edit";
    }

    /**
     * 保存更新的资源put /v1/user/$id
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        echo "update";
    }

    /**
     * 删除指定资源delete /v1/user/$id
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        echo "delete";
    }


    public function address($id)
    {
        echo "address-";
        echo $id;
    }
}
