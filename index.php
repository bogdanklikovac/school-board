<?php


require 'vendor/autoload.php';


$student_id = filter_input(INPUT_GET,'student', FILTER_VALIDATE_INT);


$results = new StudentResults();
$results->getStudentResult($student_id);

print_r($results->getStudentResult($student_id));

