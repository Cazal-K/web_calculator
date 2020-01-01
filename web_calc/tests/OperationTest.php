<?php

require_once(__DIR__ . "/../src/Operation.php");

use PHPUnit\Framework\TestCase;

class OperationTest extends testCase
{
    public function testCanAddTwoNumbers()
    {
        $this->assertEquals(
            Operation::add("39", "3"),
            42
        );
    }

    public function testCanSubstractTwoNumbers()
    {
        $this->assertEquals(
            Operation::sub("50", "8"),
            42
        );
    }

    public function testCanMultiplyTwoNumbers()
    {
        $this->assertEquals(
            Operation::mul("21", "2"),
            42
        );
    }

    public function testCanDivideTwoNumbers()
    {
        $this->assertEquals(
            Operation::div("42", "10"),
            4.2
        );
        $this->assertEquals(
            Operation::div("42", "0"),
            "Error"
        );
    }

    public function testCanGetModulusOfTwoNumbers()
    {
        $this->assertEquals(
            Operation::mod("42", "2"),
            0
        );
        $this->assertEquals(
            Operation::mod("42", "0"),
            "Error"
        );
    }

    public function testCanGetTheResultOfAnOperation()
    {
        $this->assertEquals(
            Operation::do_op("42", "+", "1"),
            "42+1=43"
        );
        $this->assertEquals(
            Operation::do_op("42", "-", "1"),
            "42-1=41"
        );
        $this->assertEquals(
            Operation::do_op("42", "*" ,"1"),
            "42*1=42"
        );
        $this->assertEquals(
            Operation::do_op("42", "/", "1"),
            "42/1=42"
        );
        $this->assertEquals(
            Operation::do_op("42", "/", "0"),
            "42/0=Error"
        );
        $this->assertEquals(
            Operation::do_op("42", "%", "1"),
            "42%1=0"
        );
        $this->assertEquals(
            Operation::do_op("42", "%", "0"),
            "42%0=Error"
        );
        $this->assertEquals(
            Operation::do_op("42", "^", "0"),
            "Unknown operator"
        );
    }
}
