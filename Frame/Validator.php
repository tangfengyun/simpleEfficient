<?php
/**
 * 验证规则
 * Created by PhpStorm.
 * User: FengYun
 * Date: 2019/1/18
 * Time: 14:01
 */
class Validator extends Exception {


    private static $instance;

    protected static $msg = array(
        'required'  =>  '必填字段',
        'integer'   =>  '必须是整数',
        'string'    =>  '必须是字符串',
        'bool'      =>  '必须是布尔值',
        'float'     =>  '必须是小数',
    );

    /**
     * Validator constructor.
     * @param string $rules
     * @param array $params
     */
    public function __construct(array $rules,array $params)
    {
        $this->initValidateParams($rules,$params);
    }

    public static function getInstance($rules,$params)
    {
        if(! self::$instance instanceof self){
            self::$instance = new  self($rules,$params);
        }
        return self::$instance;
    }

    protected function initValidateParams(array $rules ,array $params=null)
    {
        if(is_null($params)){
            return self::error(self::$msg['null']);
        }
        foreach ($rules as $key => $rule){
            if(empty($params[$key])){
                return self::error(self::$msg['null']);
            }
            $param_rules = explode('|',$rule);
            foreach ($param_rules as $param_rule){
                $err_info = '';
                if(empty($params[$key]) && $param_rule=='required') {
                    $err_info = $key . self::$msg[$param_rule];
                }
                if(!is_string($params[$key]) && $param_rule=='string') {
                    $err_info = $key . self::$msg[$param_rule];
                }
                if(!is_integer($params[$key]) && $param_rule=='integer'){
                    $err_info = $key . self::$msg[$param_rule];
                }
                if(!is_bool($params[$key]) && $param_rule=='bool'){
                    $err_info = $key . self::$msg[$param_rule];
                }
                if(!is_float($params[$key]) && $param_rule=='float'){
                    $err_info = $key . self::$msg[$param_rule];
                }
                return self::error($err_info);
          }
        }
    }

    /**
     * 成功返回结果
     * @param $msg
     * @param int $code
     * @param bool $status
     * @param string $result
     * @return string
     */
    protected static function success($msg='操作成功',$code=1,$status=true,$result ='')
    {
        return json_encode(['msg'=> $msg,'code'=> $code,'status'=>$status,'result'=>$result ]);
    }

    /**
     * 失败返回结果
     * @param $msg
     * @param int $code
     * @param bool $status
     * @param string $result
     * @return string
     */
    protected static function error($msg='操作失败',$code=0,$status=false,$result ='')
    {
        return json_encode(['msg'=> $msg,'code'=> $code,'status'=>$status,'result'=>$result ]);
    }
}