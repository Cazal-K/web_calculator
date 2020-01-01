<?php

require_once(__DIR__ . "/../src/Database.php");
use PHPUnit\Framework\TestCase;

class DatabaseTest extends testCase
{
    public function testCan_Get_PDO_Instance()
    {
        $this->assertInstanceOf(PDO::Class,
        Database::getInstance()->db);
    }

    public function testCanConnectAndExecuteQuery()
    {
        $db = Database::getInstance()->db;
        $res = $db->query("SELECT \"Youpi\" AS mytest");
        $res_array = $res->fetch(PDO::FETCH_ASSOC);
        $this->assertEquals(
            $res_array["mytest"],
            "Youpi"
        );
    }
}