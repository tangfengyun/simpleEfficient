<?php
/**
 * Created by PhpStorm.
 * User: FengYun
 * Date: 2019/1/22
 * Time: 17:05
 */
class CategoryController extends BaseController
{

    public function index(){
        $categoryModel = DB::table('CategoryModel');
        $cateInfo = $categoryModel->select();
        $this->view('index',['cateInfo'=>$cateInfo]);
    }
    
    public function delALL(){

    }

    public function edit()
    {
        
    }

    public function del()
    {
        
    }
}