<?php
namespace app\store\controller;

use think\Request;
use think\Db;
/**
 * 后台首页
 * Class Index
 * @package app\store\controller
 */
class Index extends Controller
{
    public function index()
    {
        return $this->fetch('index');
    }

    public function demolist()
    {
        return $this->fetch('demo-list');
    }
    public function addCon(){
        $module = Request::instance()->module();

        $res = $this->getController($module);
        $result = [];
        foreach($res as $v){

            $result[]['controller'] = $v;
        }
//        dump($result);
        $data = Db::name('auth_rule')->insertAll($result);

        if($data){
            echo 1;
        }else{
            echo 2;
        }
    }
    private function getController($module) {
        if (empty($module)) {
            return null;
        }

        $module_path = APP_PATH . '/' . $module . '/controller/';  //控制器路径
        if (!is_dir($module_path)) {
            return null;
        }

        $module_path .= '/*.php';
        $ary_files = glob($module_path);
        foreach ($ary_files as $file) {
            if (is_dir($file)) {
                continue;
            } else {
                $files[] = basename($file, '.php');
            }
        }
        return $files;
    }

}
