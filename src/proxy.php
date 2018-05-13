<?php
/**
* this proxy show a lazy loading exemple
* The ProcessProxy only make the heavy method on demand
*/
Interface ProcessInterface
{
    public function process();
    public function heavy();
    public function light();
}

class Process implements ProcessInterface
{
    public function __construct()
    {
        self::light();
        self::heavy();
    }
    public function process()
    {

    }
    public function light()
    {
        echo 'light process ' ."\n";
    }
    public function heavy()
    {
        sleep(2);
        echo 'heavy process ' ."\n";
    }
}

class ProcessProxy implements ProcessInterface
{
    private $Process;
    public function __construct()
    {

    }
    public function process()
    {
        if (empty($this->Process))
            $this->Process = new Process();

    }
    public function light()
    {
        $this->Process->light();
    }
    public function heavy()
    {
        $this->Process->heavy();
    }
}

class Timer
{
    private static $started = false  ;
    private static $start;
    private static $end;

    public static function bip()
    {
        if (self::$started === true)
        {
            self::$started = false;
            self::$end = date_create();
            $interval = date_diff(self::$start, self::$end);
            echo $interval->format('%s seconds and %F microsecond') . "\n";
        }
        else
        {
            self::$started = true;
            self::$start = date_create();

        }
    }
}

Timer::bip();
$p1 = new Process();
$p2 = new Process();
$p3 = new Process();
$p1->process();
Timer::bip();

Timer::bip();
$p1 = new ProcessProxy();
$p2 = new ProcessProxy();
$p3 = new ProcessProxy();
$p1->process();
Timer::bip();
