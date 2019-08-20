<?php
/**
 * Created by IntelliJ IDEA.
 * User: thexaib
 * Date: 8/20/19
 * Time: 5:34 PM
 */

namespace tests;

use PHPUnit\Framework\TestCase;
use thexaib\model\GenericArray;

class GenericArrayTest extends TestCase
{

    public function testIsCountable()
    {
        $arr=["data"=>"1","list"=>[1,2,3]];
        $ga=new GenericArray($arr);

        $this->assertIsIterable($ga);
        $this->assertEquals(2,sizeof($ga));
        $this->assertEquals(3,sizeof($ga->list));
    }
    public function testLoadFromArray()
    {
        $arr=["data"=>"1","list"=>[1,2,3]];
        $ga=new GenericArray();
        $ga->loadFromArray($arr);


        $this->assertArrayHasKey("data",$ga);
        $this->assertEquals("1",$ga['data']);
        $this->assertEquals("1",$ga->data);

    }

    public function testToArray()
    {
        $ga=new GenericArray();
        $ga->data="1";
        $ga["list"]=[1,2,3];

        $this->assertArrayHasKey("data",$ga);
        $this->assertArrayHasKey("list",$ga);
    }
}
