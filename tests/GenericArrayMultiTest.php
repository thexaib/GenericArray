<?php
/**
 * Created by IntelliJ IDEA.
 * User: thexaib
 * Date: 8/20/19
 * Time: 6:15 PM
 */

namespace tests;

use PHPUnit\Framework\TestCase;
use thexaib\model\GenericArrayMulti;

class GenericArrayMultiTest extends TestCase
{

    public function testIsCountable()
    {

        $fixture = new GenericArrayMulti();
        $fixture->data=1;
        $fixture['list']=[
            "one" => 1,
            "two" => 2,
            "three" =>
                [
                    1,
                    2,
                    3,
                    4
                ],
        ];
        $this->assertEquals(2,sizeof($fixture));
        $this->assertEquals(2,$fixture->count());
        $this->assertEquals(3,sizeof($fixture->list));
        $this->assertEquals(3,$fixture->list->count());
        $this->assertEquals(4,$fixture->list->three->count());
    }
    public function testLoadFromArray()
    {
        $arr = [
            "data" => "1",
            "list" =>
                [
                    "one" => 1,
                    "two" => 2,
                    "three" =>
                        [
                            1,
                            2,
                            3
                        ],
                ]
        ];
        $fixture = new GenericArrayMulti($arr);

        $this->assertArrayHasKey("data",$fixture);
        $this->assertArrayHasKey("list",$fixture);
        $this->assertEquals("1",$fixture->data);
        $this->assertEquals("1",$fixture['data']);
        $this->assertEquals(1,$fixture->list->one);
        $this->assertEquals(2,$fixture->list['two']);
        $this->assertEquals([1,2,3],$fixture->list->three->toArray());

        $this->assertEquals($arr,$fixture->toArray());
    }
    public function testToJSON()
    {
        $arr=["one"=>1,2,4];
        $fixture=new GenericArrayMulti($arr);
        $expectation=json_encode($arr,JSON_PRETTY_PRINT);
        $json=json_decode($fixture->toJSON());

        $this->assertEquals($expectation,$fixture->toJSON());
//        $this->assertEquals(new \stdClass(),$json);
        $this->assertEquals(1,$json->one);

    }
}
