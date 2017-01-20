<?php
/**
 * Created by PhpStorm.
 * User: wy
 * Date: 2017-01-20
 * Time: 15:04:41
 */

//迭代器模式：迭代器模式是遍历集合的成熟模式，
//迭代器模式的关键是将遍历集合的任务
//交给一个叫做迭代器的对象，
//它的工作时遍历并选择序列中的对象，
//而客户端程序员不必知道或关心该集合序列底层的结构。

/*
    Iterator（迭代器）：迭代器定义访问和遍历元素的接口
    ConcreteIterator（具体迭代器）：具体迭代器实现迭代器接口，对该聚合遍历时跟踪当前位置
    Aggregate （聚合）：聚合定义创建相应迭代器对象的接口(可选)
    ConcreteAggregate（具体聚合）：具体聚合实现创建相应迭代器的接口，该操作返回ConcreteIterator的一个适当的实例(可选)
*/
//抽象迭代器
abstract class IIterator
{
    public abstract function First();
    public abstract function Next();
    public abstract function IsDone();
    public abstract function CurrentItem();
}

//具体迭代器
class ConcreteIterator extends  IIterator
{
    private $aggre;
    private $current=0;
    public function __construct(array $_aggre)
    {
        $this->aggre=$_aggre;
    }
    public function First()
    {
        // TODO: Implement First() method.
        return $this->aggre[0];
    }
    public function Next()
    {
        // TODO: Implement Next() method.
        $this->current++;
        if($this->current<count($this->aggre))
            return $this->aggre[$this->current];
        return false;
    }
    public function IsDone()
    {
        // TODO: Implement IsDone() method.
        return $this->current>=count($this->aggre)?true:false;
    }
    public function CurrentItem()
    {
        // TODO: Implement CurrentItem() method.
        return $this->aggre[$this->current];
    }
}

//使用场景：
//         1.访问一个聚合对象的内容而无需暴露它的内部表示
//         2.支持对聚合对象的多种遍历
//         3.为遍历不同的聚合结构提供一个统一的接口

$iterator=new ConcreteIterator(['杨辉','相泉','啊强']);
$item=$iterator->First();
echo $item."<br/>";
while (!$iterator->IsDone())
{
    echo "{$iterator->CurrentItem()};请买票!";
    $iterator->Next();
}

