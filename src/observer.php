<?php

class Program
{
  public function __construct()
  {
    $subject = new Subject();
    $subject->add(new Observer1());
    $subject->add(new Observer1());
    $subject->add(new Observer2());
    $subject->add(new Observer1());

    while (true)
    {
      $line = readline('add a message : ');
      $subject->msg($line);
      if ($line === 'quit')
      {
        die("end\n");
      }

    }
  }
}

$p = new Program();

/**
* the subject observed
*/
class Subject
{
  private $observers = [];

  public function msg($s)
  {
    echo $s . "\n";
    self::notifyAll($s);
  }

  public function add(Observer $observer)
  {
    echo "add " . get_class($observer) .  "\n";
    $this->observers [] = $observer;
  }

  public function notifyAll($msg)
  {

    foreach ($this->observers as $observer)
    {
      $observer->notify($msg);
    }
  }
}

/**
* The observer abstract
*/
abstract class Observer
{
  public function notify($msg){}
}

/**
* a concrete observer
*/
class Observer1 extends Observer
{
  public function notify($msg)
  {
    echo "Observer1 notified with message '{$msg}' ! \n";
  }
}

/**
* an other concrete observer
*/
class Observer2 extends Observer
{
  public function notify($msg)
  {
    echo "Observer2 notified with message '{$msg}' ! \n";
  }
}
