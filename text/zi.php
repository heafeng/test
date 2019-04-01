<?php
    header("Content-type:text/html;charset=utf-8");
    $name='maying';
    $socre=70;
    getgrade($name,$socre);
    function getGrade($name='',$socre='',$grade=''){
        if($socre>0&&$socre<59){
            $grade='bujige';
        }
        else if ($socre>59&&$socre<79){
            $grade='lianghao';
        }
        return "my name is {$name},my grade is {$grade}";
    }
    $str=getgrade($name,$socre);
    var_dump($str)