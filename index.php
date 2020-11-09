<?php


require 'vendor/autoload.php';


$student_id = filter_input(INPUT_GET,'student', FILTER_VALIDATE_INT);


print_r($student_id);