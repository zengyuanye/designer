<?php

//定义一个模块接口。所有的类都必须遵守该规范
interface SuperModuleInterface
{
    //eg.超能力激活方法
    //任何一个超能力都得有一个方法，并拥有一个参数
    //@param array $target 针对目标，可以是一个或多个，自己或他人
    public function activate(array $target);
}
//x-超能力
class XPower implements SuperModuleInterface
{
    public function  activate(array $target)
    {
        // TODO: Implement activate() method.
        echo "获得了x-power".'<br/>';
    }
}

/**
 * 终极炸弹 （就这么俗）
 */
class UltraBomb implements SuperModuleInterface
{
    public function activate(array $target)
    {
        // 这只是个例子。。具体自行脑补
        echo "获得了终极炸弹 （就这么俗）".'<br/>';
    }
}
class SuperMan
{
    protected $module;
    public function __construct(SuperModuleInterface $module)
    {
        $this->module=$module;
    }
    public function action()
    {
        $this->module->activate([]);
    }
}

/*什么叫做依赖注入？
本文从开头到现在提到的一系列依赖，只要不是由内部生产（比如初始化、构造函数 __construct 中通过工厂方法、自行手动 new 的），
而是由外部以参数或其他形式注入的，都属于依赖注入（DI） 。是不是豁然开朗？事实上，就是这么简单。下面就是一个典型的依赖注入：*/
//超能力模组
$xPower=new XPower();
$supermen=new SuperMan($xPower);
//工厂模式的升华 —— IoC 容器。
class Container
{
    protected  $binds;
    protected $instances;
    public function  bind($abstract,$concrete)
    {

        //将闭包函数返回的值放到binds中;$binds是闭包函数数组
        if($concrete instanceof Closure)
        {
            $this->binds[$abstract]=$concrete;
        }else{
            $this->instances[$abstract]=$concrete;
        }
    }
    public function make($abstract,$parameters=[])
    {
        if(isset($this->instances[$abstract]))
        {
            return $this->instances[$abstract];
        }
        array_unshift($parameters,$this);
        //调用相应的模组,触发binds的闭包函数
        return call_user_func_array($this->binds[$abstract],$parameters);
    }
}

// 创建一个容器（后面称作超级工厂）
$container = new Container;

// 向该 超级工厂 添加 超人 的生产脚本
$container->bind('superman', function($container, $moduleName) {
    return new Superman($container->make($moduleName));
});

// 向该 超级工厂 添加 超能力模组 的生产脚本
$container->bind('xpower', function($container) {
    return new XPower;
});

// 同上
$container->bind('ultrabomb', function($container) {
    return new UltraBomb;
});
// ******************  华丽丽的分割线  **********************
// 开始启动生产
$superman_1 = $container->make('superman', ['xpower']);
$superman_2 = $container->make('superman', ['ultrabomb']);
$superman_1->action();



















