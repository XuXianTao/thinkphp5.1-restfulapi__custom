<?php

namespace app\api\controller\v1;

use app\api\model\CarImage;
use think\Controller;
use think\Request;

class CarImageRest extends CarRest
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
        parent::index();
        $result = $this->result_get;
        $tmp = CarImage::where($this->query_get);
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
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
        if ($request->contentType()!=='multipart/form-data') {
            return self::returnMsg(406, 'The Content-Type is not multipart/form-data.');
        };
        $images = $_FILES;
        $gid = $_POST['gid'];
        foreach($images as $sid => $sdata) {
            $file_name = $this->uid . '_' . $gid . '_'. $sid . '_' . time();
            $url = '/images_upload/' . $file_name;
            move_uploaded_file($sdata['tmp_name'],DIR_IMAGE. '/' . $file_name);
            CarImage::create([
                'uid' => $this->uid,
                'gid' => $gid,
                'g_sid' => $sid,
                'url' => $url
            ]);
        }
        self::returnMsg(201, 'Successfully Saved.');
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
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
        $files = '';
        if ($id === 'all') {
            $files = glob(DIR_IMAGE . '/'.'*');
            db(CarImage::getTable())->where('1=1')->delete();
        } else {
            $files = glob(DIR_IMAGE.'/'.$id.'_*');
            CarImage::destroy(['uid' => $id]);
        }
        foreach ($files as $f) {
            unlink($f);
        }
        self::returnMsg(204, 'Delete Successfully.');
    }
}
