<?php
/**
 * Created by PhpStorm.
 * User: wy
 * Date: 2017-01-20
 * Time: 11:55:33
 */
//策略模式定义了一系列的算法，并将每一个算法封装起来，而且使它们还可以相互替换。
//策略模式让算法独立于使用它的客户而独立变化，即封装变化的算法。
//    适用场景：
//    1、 多个类只区别在表现行为不同，可以使用Strategy模式，在运行时动态选择具体要执行的行为。
//    2、 需要在不同情况下使用不同的策略(算法)，或者策略还可能在未来用其它方式来实现。
//    3、 对客户隐藏具体策略(算法)的实现细节，彼此完全独立。
//    4、客户端必须知道所有的策略类，并自行决定使用哪一个策略类，策略模式只适用于客户端知道所有的算法或行为的情况。
//    5、 策略模式造成很多的策略类，每个具体策略类都会产生一个新类。
//       有时候可以通过把依赖于环境的状态保存到客户端里面，可以使用享元模式来减少对象的数量。

/**
 * 抽象策略角色
 * Interface RotateItem
 */
interface RotateItem
{
    function inertiaRotate();
    function unInertiaRotate();
}
/**
 * 具体策略角色--x产品
 *
 * */

class XItem implements RotateItem
{
    function inertiaRotate()
    {
        // TODO: Implement inertiaRotate() method.
        echo "我是X产品,我惯性旋转了<br/>";
    }
    function unInertiaRotate()
    {
        // TODO: Implement unInertiaRotate() method.
        echo "我是X产品,我非惯性旋转<br/>";
    }
}
/**
 * 具体策略角色--Y产品
 * class YItem
 *
 * */
class YItem implements RotateItem
{
    function inertiaRotate()
    {
        // TODO: Implement inertiaRotate() method.
        echo "我是Y产品，我<span style='color: #ff0000;'>不能</span>惯性旋转。<br/>";
    }
    function unInertiaRotate()
    {
        // TODO: Implement unInertiaRotate() method.
        echo "我是Y产品，我非惯性旋转了。<br/>";
    }
}
/**具体策略角色——XY产品
 * Class XYItem
 */
class XYItem implements RotateItem
{
    function inertiaRotate()
    {
        echo "我是XY产品，我惯性旋转。<br/>";
    }

    function unInertiaRotate()
    {
        echo "我是XY产品，我非惯性旋转了。<br/>";
    }
}

class contextStrategy
{
    private $item;
    function getItem($item_name)
    {
        try{
            $class=new ReflectionClass($item_name);
            $this->item=$class->newInstance();
        }catch (RangeException $e)
        {
            $this->item='';
        }
    }

    function inertiaRotate()
    {
        $this->item->inertiaRotate();
    }
    function unInertiaRotate()
    {
        $this->item->unInertiaRotate();
    }

}


$strategy=new contextStrategy();
echo "<span style='color:#399bff'>x产品</span><hr/>";
$strategy->getItem('XItem');
$strategy->inertiaRotate();
$strategy->unInertiaRotate();

echo "<span style='color:#ff0000'>Y产品</span><hr/>";
$strategy->getItem('YItem');
$strategy->inertiaRotate();
$strategy->unInertiaRotate();

echo "<span style='color:#c46aff'>XY产品</span><hr/>";
$strategy->getItem('XYItem');
$strategy->inertiaRotate();
$strategy->unInertiaRotate();

//角色分析：
//    抽象策略角色（RotateItem）：策略类，通常由一个接口或者抽象类实现。
//     具体策略角色（ItemX）：包装了相关的算法和行为。
//      环境角色（ItemContext）：持有一个策略类的引用，最终给客户端调用。
