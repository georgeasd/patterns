<?php

interface IMath {

    function Add($x, $y);

    function Sub($x, $y);

    function Mul($x, $y);

    function Div($x, $y);
}

class Math implements IMath {

    public function __construct() {
        print ("Create object Math. Wait...");
        sleep(5);
    }

    public function Add($x, $y) {
        return $x + $y;
    }

    public function Sub($x, $y) {
        return $x - $y;
    }

    public function Mul($x, $y) {
        return $x * $y;
    }

    public function Div($x, $y) {
        return $x / $y;
    }

}


class MathProxy implements IMath {

    protected $math;

    public function __construct() {
        $this->math = null;
    }

    /// Быстрая операция - не требует реального субъекта
    public function Add($x, $y) {
        return $x + $y;
    }

    public function Sub($x, $y) {
        return $x - $y;
    }

    /// Медленная операция - требует создания реального субъекта
    public function Mul($x, $y) {
        if ($this->math == null)
            $this->math = new Math();
        return $this->math->Mul($x, $y);
    }

    public function Div($x, $y) {
        if ($this->math == null)
            $this->math = new Math();
        return $this->math->Div($x, $y);
    }

}

$p = new MathProxy;

// Do the math
print("4 + 2 = " . $p->Add(4, 2));
print("4 - 2 = " . $p->Sub(4, 2));
print("4 * 2 = " . $p->Mul(4, 2));
print("4 / 2 = " . $p->Div(4, 2));
?>