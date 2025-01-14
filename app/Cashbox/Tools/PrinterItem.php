<?php
namespace App\Cashbox\Tools;
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 11.01.21
 * Time: 16:47
 */

class PrinterItem
{
    private $name;
    private $price;

    public function __construct($name = '', $price = '')
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function getAsString($width = 48)
    {
        $rightCols = 10;
        $leftCols = $width - $rightCols;
        $left = str_pad($this->name, $leftCols);

        $right = str_pad($this->price, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$right\n";
    }

    public function __toString()
    {
        return $this->getAsString();
    }
}