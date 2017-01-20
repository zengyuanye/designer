<?php
/**
 * Created by PhpStorm.
 * User: wy
 * Date: 2017-01-20
 * Time: 16:02:02
 */

/*
 *   访问者模式表示一个作用于某对象结构中的各元素的操作。
 *   它使你可以在不改变各元素类的前提下定义作用于这些元素的新操作。
 *       1.抽象访问者(State):为该对象结构中具体元素角色声明一个访问操作接口。
 *          该操作接口的名字和参数标识了发送访问请求给具体访问者的具体元素角色，
 *          这样访问者就可以通过该元素角色的特定接口直接访问它。
        2.具体访问者(Success):实现访问者声明的接口。
        3.抽象元素(Person):定义一个接受访问操作accept()，
            它以一个访问者作为参数。
        4. 具体元素(Man):实现了抽象元素所定义的接受操作接口。
        5.结构对象(ObjectStruct):这是使用访问者模式必备的角色。
            它具备以下特性：能枚举它的元素；可以提供一个高层接口以允许访问者访问它的元素；
            如有需要，可以设计成一个复合对象或者一个聚集（如一个列表或无序集合）。
 */

//抽象状态
abstract class State
{
    protected $state_name;
    //得到男人反应
    public abstract function getManAction(VMan $elementM);
    //得到女人反应
    public abstract function getWomanAction(VWoman $elementW);
}
//抽象人
abstract class  Person
{
    public $type_name;
    public abstract function accept(State $visitor);
}
//成功状态
class Success extends  State
{
    public function  __construct()
    {
        $this->state_name="成功";
    }
    public  function getManAction(VMan $elementM)
    {
        // TODO: Implement getManAction() method.
        echo "{$elementM->type_name}:{$this->state_name}时，背后多半有一个伟大的女人。<br/>";
    }
    public function getWomanAction(VWoman $elementW)
    {
        // TODO: Implement getWomanAction() method.
        echo "{$elementW->type_name}:{$this->state_name}时，背后大多有一个不成功的男人。<br/>";
    }
}

//失败状态
class Failure extends State
{
    public function __construct()
    {
        $this->state_name="失败";
    }

    public  function getManAction(VMan $elementM)
    {
        echo "{$elementM->type_name}:{$this->state_name}时，闷头喝酒，谁也不用劝。<br/>";
    }

    public  function getWomanAction(VWoman $elementW)
    {
        echo "{$elementW->type_name}:{$this->state_name}时，眼泪汪汪，谁也劝不了。<br/>";
    }
}

//恋爱状态
class Amativeness  extends State
{
    public function __construct()
    {
        $this->state_name="恋爱";
    }

    public  function getManAction(VMan $elementM)
    {
        echo "{$elementM->type_name}:{$this->state_name}时，凡事不懂也要装懂。<br/>";
    }

    public  function getWomanAction(VWoman $elementW)
    {
        echo "{$elementW->type_name}:{$this->state_name}时，遇事懂也要装作不懂。<br/>";
    }
}
//男人
class VMan extends Person
{
    function __construct()
    {
        $this->type_name="男人";
    }
    public  function accept(State $visitor)
    {
        // TODO: Implement accept() method.
        $visitor->getManAction($this);
    }
}

//女人
class VWoman extends Person
{
    public function __construct()
    {
        $this->type_name="女人";
    }

    public  function Accept(State $visitor)
    {
        $visitor->getWomanAction($this);
    }
}

//对象结构
class objectStruct
{
    private  $elements=array();
    //增加
    public function  add(Person $element)
    {
        array_push($this->elements,$element);
    }
    //移除
    public function remove(Person $element)
    {
        foreach ($this->elements as $k=>$v) {
            if($v==$element)
            {
                unset($this->elements[$k]);
            }
        }
    }
    public function display(State $visitor)
    {
        foreach ($this->elements as $v)
        {
            $v->accept($visitor);
        }
    }
}


$os=new objectStruct();
$os->add(new VMan());
$os->add(new VWoman());
//成功是反应
$ss=new Success();
$os->display($ss);

//失败是反应
$fs=new Failure();
$os->display($fs);

//恋爱时反应
$ats=new Amativeness();
$os->display($ats);


/*适用场景及优势：
       1) 一个对象结构包含很多类对象，它们有不同的接口，而你想对这些对象实施一些依赖于其具体类的操作。
       2) 需要对一个对象结构中的对象进行很多不同的并且不相关的操作，而你想避免让这些操作“污染”这些对象的类。Visitor模式使得你可以将相关的操作集中起来定义在一个类中。
       3) 当该对象结构被很多应用共享时，用Visitor模式让每个应用仅包含需要用到的操作。
       4) 定义对象结构的类很少改变，但经常需要在此结构上定义新的操作。改变对象结构类需要重定义对所有访问者的接口，这可能需要很大的代价。如果对象结构类经常改变，那么可能还是在这些类中定义这些操作较好。*/





