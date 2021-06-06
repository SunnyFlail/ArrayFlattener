<?php

namespace SunnyFlail\ArrayFlattener\Tests;

use PHPUnit\Framework\TestCase;
use ReflectionObject;
use SunnyFlail\ArrayFlattener\ArrayFlattener;

final class FlattenerTest extends TestCase
{

    public function arrayProvider(): array
    {
        return [
            "Simple array" => ["First",],
            "Simple dictonary" => ["First" => "Value"],
            "Nested simple array" => [["Inner"]],
            "Nested simple dictonary" => [
                "Outer" => ["Inner" => "Value"]
            ],
            "Simple Array with multiple values" => [
                "First Value",
                "Second Value"
            ],
            "Simple Dictionary with multiple values" => [
                "First" => "Value",
                "Second" => "Value"
            ],
            "Nested Dictionary with multiple values" => [
                "First Outer" => ["First Inner" => "Value", "Second Inner" => "Value"],
                "Second Outer" => ["Third Inner" => "Value", "Fourth Inner" => "Value"]
            ],
        ];
    }

    public function arrayFlattenerProvider(): array
    {
        return [
            "Simple array" => [
                $this->arrayProvider()["Simple array"],
                '["First"]'
            ],
            "Simple dictonary" => [
                $this->arrayProvider()["Simple dictonary"],
                '["First"=>"Value"]'
            ],
            "Nested simple array" => [
                $this->arrayProvider()["Nested simple array"],
                '[["Inner"]]'
            ],
            "Nested simple dictonary" => [
                $this->arrayProvider()["Nested simple dictonary"],
                '["Outer"=>["Inner"=>"Value"]]'
            ],
            "Simple Array with multiple values" => [
                $this->arrayProvider()["Simple Array with multiple values"],
                '["First Value","Second Value"]'
            ],
            "Simple Dictionary with multiple values" => [
                $this->arrayProvider()["Simple Dictionary with multiple values"],
                '["First"=>"Value","Second"=>"Value"]'
            ],
            "Nested Dictionary with multiple values" => [
                $this->arrayProvider()["Simple Dictionary with multiple values"],
                '["First"=>"Value","Second"=>"Value"]',
                '["First Outer" => ["First Inner"=>"Value","Second Inner"=>"Value"],"Second Outer"=>["Third Inner"=>"Value","Fourth Inner"=>"Value"]]'
            ]
        ];
    }

    public function getMock(): object
    {
        return $this->getMockForTrait(ArrayFlattener::class);
    }

    /**
     * @dataProvider arrayFlattenerProvider
     */
    public function testArrayFlattener(array $array, string $expected)
    {
        $mock = $this->getMock();
        $reflection = new ReflectionObject($mock);
        $flattener = $reflection->getMethod("flattenArrayToString");
        $flattener->setAccessible(true);
        $result = $flattener->invoke($mock, $array);

        $this->assertEquals($expected, $result);
    }

}