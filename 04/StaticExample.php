<?php

// Listing 4.1
class StaticExample
{
    public static int $aNum = 0;
    public static function sayHello(): void
    {
        self::$aNum++;
        print "Hello, world!" . PHP_EOL;
    }
}

//Example
StaticExample::$aNum++;
StaticExample::sayHello();
