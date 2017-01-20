<?php
/**
 * Created by PhpStorm.
 * User: wy
 * Date: 2017-01-20
 * Time: 15:27:06
 */
 // 模板模式准备一个抽象类，将部分逻辑以具体方法以及具体构造形式实现，
 //然后声明一些抽象方法来迫使子类实现剩余的逻辑。
 //不同的子类可以以不同的方式实现这些抽象方法
 //，从而对剩余的逻辑有不同的实现。
 //先制定一个顶级逻辑框架，而将逻辑的细节留给具体的子类去实现。

/* 抽象模板角色（MakePhone）：抽象模板类，定义了一个具体的算法流程和一些留给子类必须实现的抽象方法。
   具体子类角色（XiaoMi）：实现MakePhone中的抽象方法，子类可以有自己独特的实现形式，但是执行流程受MakePhone控制
*/

//抽象模板类
abstract class MakePhone
{
  protected $name;
  public function __construct($name)
  {
    $this->name=$name;
  }

  public function makeFlow()
  {
    # code...
    $this->makeBattery();
    $this->makeCamera();
    $this->makeScreen();
    echo $this->name."手机生产完毕!<hr/>";
  }
  abstract public function makeBattery();
  abstract function makeScreen();
  abstract function makeCamera();

}
//小米手机
class XiaoMi extends MakePhone
{
   public function __construct($name='小米')
   {
     parent::__construct($name);
     # code...
   }
   public function makeBattery()
   {
     echo "小米电池生产完毕!<br/>";
   }
   public function makeCamera()
   {
     echo "小米相机生成完毕!<br/>";
   }
   public function makeScreen()
   {
     echo "小米屏幕生产完毕!<br/>";
   }
}
$miUi=new XiaoMi();
$miUi->makeFlow();

// 适用场景及优势：
//         1、完成某一细节层次一致的一个过程或一系列步骤，但其个别步骤在更详细的层次上的实现可能不同时。我们通常考虑用模板模式来处理。
//         2、当不变的和可变的行为在方法的子类实现中混合在一起的时候，不变的行为就会在子类中重复出现，我们通过模板模式把这些行为搬移到单一的地方，这样就帮助子类摆脱重复的不变行为的纠缠。
//         3、模板模式通过把不变的行为搬移到超级抽象类，去除子类中的重复代码来体现它的优势。模板模式提供了一个很好的代码复用平台。
