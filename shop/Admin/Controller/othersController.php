<?php
class othersController extends Controller{
    public function __construct()
    {
        parent::__construct();
        $this->others = new othersModel;
    }
	//导入账号和密码
    public function import(){
        include './View/others/import.html';
    }
    public function doAdd()
    {
        $res = $this->others->doAdd();
        // var_dump($res); die;
        if($res){
            notice('导入成功');
        }
        
        notice('导入失败');
    }
}
