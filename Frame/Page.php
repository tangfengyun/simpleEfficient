<?php
/**
 * 分页
 * Created by PhpStorm.
 * User: FengYun
 * Date: 2019/1/16
 * Time: 15:07
 */
class Page{
    private $rowsPerPage; //每页显示条数
    private $maxNum; //页面显示最大页码数
    private $rowCount; //总记录数
    private $url; //固定url链接

    /**
     * 构造方法，初始化相关属性
     */
    public function __construct($rowsPerPage,$maxNum,$rowCount,$url)
    {
        $this->rowsPerPage = $rowsPerPage;
        $this->maxNum = $maxNum;
        $this->rowCount = $rowCount;
        $this->url = $url;
    }

    /**
     * 核心方法，返回页码字符串
     */
    public function getStrPage()
    {
         //计算总页数
        $pages = ceil($this->rowCount / $this->rowsPerPage);
        //确定当前选中的页码数
        $pageNum = isset($_GET['pageNum']) ? $_GET['pageNum'] : 1;
        //定义页码字符串
        $strPage = '';
        //拼凑出首页
        $strPage .= "<a href='{$this->url}pageNum=1'>首页</a>";
        //拼凑出上一页
        $prePage = $pageNum - 1;
        if($prePage!=1){
            $strPage .= "<a href='{$this->url}pageNum=$prePage'>上一页</a>";
        }
        //确定显示的初始页$startNum
        if ($prePage <= ceil($this->maxNum)/2){
            $startNum = 1;
            //如果当前页码为ceil（$this->maxNum）页，显示的初始也就是1
        }else{
            $startNum = $pageNum - ceil($this->maxNum/2) + 1;
        }

        //确定显示初始页的最大值
        if($startNum >= $pages - $this->maxNum +1){
            $startNum = $pages -$this->maxNum +1;
        }

        //防止页面出现负数
        if($startNum  <= 1){
            $startNum=1;
        }

        // 确定显示的最后一页$endNum
        $endNum = $startNum + $this->maxNum - 1;
        //防止最后一页越界
        if ($endNum>=$pages){
            $endNum = $pages;
        }

        //拼凑出中间页码
        for ($i=$startNum;$i<=$endNum;$i++){
            //选择页标红显示
            if($i==$pageNum){
                $strPage .= "<a href='{$this->url}pageNum=$i'><font color='red'>$i</font></a>";
            }else{
                $strPage .= "<a href='{$this->url}pageNum=i'>$i</a>";
            }
        }

        //拼凑出下一页
        $nextNum = $pageNum + 1;
        if($pageNum != $pages){
            $strPage .= "<a href='{$this->url}pageNum=$nextNum'>下一页</a>";
        }

        //拼凑出尾页
        $strPage  .= "<a href='{$this->url}pageNum=$pages'>尾页</a>";

        //拼凑出总页码数
        $strPage .= "|总页数:$pages";


        return $strPage;

    }


}