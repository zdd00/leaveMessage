<?php

namespace app\index\controller;

use think\Controller;
use think\Db;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch('index');
    }

    public function add()
    {
        $request = request()->param();
        $data = [];
        $data['name'] = $request['name'] ? $request['name'] : '--';
        $data['phone'] = $request['phone'];
        $data['source'] = $request['source'];
        $data['time'] = date('Y-m-d H:i:s', time());
        if ($data['phone']) {
            $affected = Db::name('userInfo')->insert($data);
            if ($affected) {
                $this->success('提交成功', 'index', '', '2');
            } else {
                $this->error('提交失败', 'index', '', '2');
            }
        } else {
            $this->error('请输入手机号', 'index', '', '2');
        }
    }
}
