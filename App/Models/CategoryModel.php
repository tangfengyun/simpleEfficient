<?php
/**
 * Created by PhpStorm.
 * User: FengYun
 * Date: 2019/1/22
 * Time: 17:40
 */
class CategoryModel extends Model
{
    public function select()
    {
        $sql = "select * from bg_category orderby cate_sort desc";
        $list = $this->dao->fetchAll($sql);
        return $this->getCateTree($list);
    }

    public function getCateTree($list,$pid=0,$level=0)
    {

        static  $cate_list = array();
        foreach ($list as $row){
            if($row['cate_pid']==$pid){
                $row['level'] = $level;
                $cate_list[] = $row;
                $this->getCateTree($list,$row['cate_id'],$level+1);
            }
        }
        return $cate_list;

    }
}