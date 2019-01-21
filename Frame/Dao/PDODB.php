<?php
/**
 * Created by PhpStorm.
 * User: FengYun
 * Date: 2019/1/16
 * Time: 11:20
 */
class PDODB implements I_DAO{
    /**
     * 定义相关的属性
     */
    private $host; // 主机地址
    private $port; // 端口号
    private $user; // 用户名
    private $pass; // 用户密码
    private $charset; // 字符集
    private $dbname; // 数据库名
    // 运行的时候需要的属性
    private $dsn; // 数据源名称
    private $pdo; // 存放PDO类的对象
    private static $instance; // 用于保存对象

    public function __construct($arr)
    {
        // 初始化属性
        $this->init($arr);
        // 初始化dsn
        $this->initDSN();
        // 实例化PDO对象
        $this->initPDO();
        // 初始化PDO对象属性
        $this->initAttribute();

    }
    public static function getInstance($config)
    {
        if(! self::$instance instanceof self){
            self::$instance = new self($config);
        }
        var_dump(self::$instance);
        return self::$instance;
    }

    /**
     * 初始化属性
     * @param $arr
     */
    private function init($arr)
    {
        $this->host = isset($arr['host']) ? $arr['host'] : '127.0.0.1';
        $this->port = isset($arr['port']) ? $arr['port'] : '3306';
        $this->user = isset($arr['user']) ? $arr['user'] : 'root';
        $this->pass = isset($arr['pass']) ? $arr['pass'] : ' ';
        $this->charset = isset($arr['charset']) ? $arr['charset'] : 'utf8';
        $this->dbname  = isset($arr['dbname']) ? $arr['dbname'] : ' ';
    }

    /**
     * 初始化dsn
     */
    private function initDSN()
    {
        $this->dsn = "mysql:host=$this->host;port=$this->port;dbname=$this->dbname;charset=$this->charset";
    }

    /**
     * 实例化PDO对象
     */
    private function initPDO()
    {
        // 在实例化PDO对象的时候自动走异常模式(也是唯一走异常模式的地方)
        try{
            $this->pdo = new PDO($this->dsn, $this->user, $this->pass);
        }catch (PDOException $e){
            echo "数据库连接失败！<br />";
            echo '错误的信息为：',$e->getMessage(),'<br />';
            echo '错误的代码为：',$e->getCode(),'<br />';
            echo '错误的脚本为：',$e->getFile(),'<br />';
            echo '错误的行号为：',$e->getLine(),'<br />';
            return false;
        }
    }

    /**
     * 初始化PDO对象属性
     */
    private function initAttribute()
    {
        // 把错误模式修改为异常模式
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    /**
     * 输出异常信息
     * @param $e
     * @return bool
     */
    private function my_error($e)
    {
        echo "SQL语句执行失败！<br />";
        echo '错误的信息为：',$e->getMessage(),'<br />';
        echo '错误的代码为：',$e->getCode(),'<br />';
        echo '错误的脚本为：',$e->getFile(),'<br />';
        echo '错误的行号为：',$e->getLine(),'<br />';
        return false;
    }

    /**
     * 执行一条sql语句
     * @param $sql
     * @return mixed
     */
    public function my_query($sql)
    {
        try{
            $result = $this->pdo->exec($sql);
        }catch (PDOException $e){
            $this->my_error($e);
        }
        return $result;
    }

    /**
     * fetchRow 获取一行多列的信息
     * @param $sql
     * @return mixed
     */
    public function fetchRow($sql)
    {
        try{
            $stmt  = $this->pdo->query($sql);
            var_dump($stmt);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            // 释放资源(关闭光标)
            $stmt->closeCursor();
        }catch (PDOException $e){
            $this->my_error($e);
        }
        return $result;
    }

    /**
     * fetchColumn 获取单行单列的信息(单一值)
     * @param $sql
     * @return mixed
     */
    public function fetchColumn($sql)
    {
        try{
            $stmt = $this->pdo->query($sql);
            $result = $stmt->fetchColumn();
            // 释放资源(关闭光标)
            $stmt->closeCursor();
        }catch (PDOException $e){
            $this->my_error($e);
        }
        return $result;
    }

    /**
     * fetchAll 获取多行多列的信息
     * @param $sql
     * @return mixed
     */
    public function fetchAll($sql)
    {
        try{
            $stmt = $this->pdo->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // 释放资源(关闭光标)
            $stmt->closeCursor();
        } catch (PDOException $e){
            $this->my_error($e);
        }
        return $result ;
    }

    /**
     * 私有化克隆方法
     */
    private function __clone() {

    }
}