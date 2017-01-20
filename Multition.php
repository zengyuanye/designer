<?php
/**
 * Created by PhpStorm.
 * User: wy
 * Date: 2017-01-20
 * Time: 11:22:28
 */
//多例模式和单例模式类似，但可以返回多个实例。
//比如我们有多个数据库连接，MySQL、SQLite、Postgres，
//又或者我们有多个日志记录器，分别用于记录调试信息和错误信息，
//这些都可以使用多例模式实现。
class Multiton
{
    //第一个实例
    const INSTANCE_1='1';
    //第二个实例
    const INSTANCE_2='2';
    //实例数组
    //@var array
    private static $instances=array();
    //构造函数是私有的，不能从外部进行实例化
    private function __construct()
    {

    }
    //通过指定名称返回实例(使用到该实例的时候才会实例化
    //@param string $instanceName
    //@return Multiton
    public static function getInstance($instanceName)
    {
        if(!array_key_exists($instanceName,self::$instances))
        {
            self::$instances[$instanceName]=new self();
        }
        return self::$instances[$instanceName];
    }
    //防止实例被外部克隆
    private function __clone()
    {

    }
    //防止实例从外部反序列化
    private function __wakeup()
    {

    }
}
Multiton::getInstance('first');
$mul2=Multiton::getInstance('second');

var_dump($mul2);
