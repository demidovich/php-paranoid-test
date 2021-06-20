<?php

require __DIR__ . "/measure.php";

// Тест 1

Measure::start("Тест 1: одна инициализация массива");
test1_0();

Measure::start("Тест 1: 10000 инициализацияй массива");
test1_1();

// Тест 2

Measure::start("Тест 2: одинарные кавычки без подстановок");
test1_1();

Measure::start("Тест 2: двойные кавычки без подстановок");
test1_2();

// Тест 3

Measure::start("Тест 3: одинарные кавычки с подстановками");
test2_1();

Measure::start("Тест 3: двойные кавычки с подстановками");
test2_2();

Measure::start("Тест 3: двойные кавычки с подстановками и фигурными скобками");
test2_3();

echo Measure::resultsAsTable();

function test1_0()
{
    $s = [
        'array_elem_a' => 'text text text text text',
        'array_elem_b' => 'text text text text text text text',
        'array_elem_c' => 'text text text text text text text text text text',
    ];

    for ($i = 0; $i < 10000; $i++) {

        if ($i % 2) {
            $string = $s['array_elem_a'];
        }

        elseif ($i % 5) {
            $string = $s['array_elem_b'];
        }

        else {
            $string = $s['array_elem_c'];
        }
    }
}

function test1_1()
{
    for ($i = 0; $i < 10000; $i++) {

        $s = [
            'array_elem_a' => 'text text text text text',
            'array_elem_b' => 'text text text text text text text',
            'array_elem_c' => 'text text text text text text text text text text',
        ];

        if ($i % 2) {
            $string = $s['array_elem_a'];
        }

        elseif ($i % 5) {
            $string = $s['array_elem_b'];
        }

        else {
            $string = $s['array_elem_c'];
        }
    }
}

function test1_2()
{
    for ($i = 0; $i < 10000; $i++) {

        $s = [
            "array_elem_a" => "text text text text text",
            "array_elem_b" => "text text text text text text text",
            "array_elem_c" => "text text text text text text text text text text",
        ];

        if ($i % 2) {
            $string = $s["array_elem_a"];
        }

        elseif ($i % 5) {
            $string = $s["array_elem_b"];
        }

        else {
            $string = $s["array_elem_c"];
        }
    }
}

function test2_1()
{
    for ($i = 0; $i < 10000; $i++) {

        $a = rand(1, 3);
        $b = rand(1, 3);
        $c = rand(1, 3);
    
        if ($i % 2) {
            $s = 'text text ' . $a . ' text  '. $b . ' text text text ' . $c;
        } else {
            $s = 'text ' . $a . ' text text ' . $b . ' text text text ' . $c;
        }
    }
}

function test2_2()
{
    for ($i = 0; $i < 10000; $i++) {

        $a = rand(1, 3);
        $b = rand(1, 3);
        $c = rand(1, 3);
    
        if ($i % 2) {
            $s = "text text $a text $b text text text $c";
        } else {
            $s = "text $a text text $b text text text $c";
        }
    }
}

function test2_3()
{
    for ($i = 0; $i < 10000; $i++) {

        $a = rand(1, 3);
        $b = rand(1, 3);
        $c = rand(1, 3);
    
        if ($i % 2) {
            $s = "text text {$a} text {$b} text text text {$c}";
        } else {
            $s = "text {$a} text text {$b} text text text {$c}";
        }
    }
}
