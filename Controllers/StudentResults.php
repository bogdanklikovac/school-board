<?php


class StudentResults
{
    const CSM = 'CSM';
    const CSMB = 'CSMB';


    /**
     * The function returns student results
     * @param $id
     * @return false|string
     */
    public function getStudentResult($id) {
        $student = Student::find($id);

        $numOfStudentGrades = $student->grade()->count();


        $studentBoard = $this->getSchoolBoard($id);
        $studentInfo = Student::select('name','id')->where('id', $id)->get()->toArray();
        $averageGrade = $this->getAverageGrades($id);

        if($numOfStudentGrades >= 1 && $numOfStudentGrades <=4) {

            //Check criteria for CSM students
            if($studentBoard == self::CSM) {
                $grades = $this->getGrades($id);
                $studentInfo[0]['averageGrade'] = $averageGrade;
                $studentInfo[0]['grades'] = $grades;
                $studentInfo[0]['status'] = ($averageGrade >= 7) ? 'PASS' : 'FAIL';
                $result = json_encode($studentInfo);
            }

            //Check criteria for CSMB students
            if($studentBoard == self::CSMB) {
                $grades = $this->getGrades($id);
                if($numOfStudentGrades > 2) {
                    sort($grades, SORT_NUMERIC);
                    array_shift($grades);
                }
                $biggestGrade = end($grades);

                $studentInfo[0]['averageGrade'] = $averageGrade;
                $studentInfo[0]['grades'] = $grades;
                $studentInfo[0]['status'] = ($biggestGrade > 8) ? 'PASS' : 'FAIL';

                $result = $this->createXML($studentInfo[0]);

            }

            return $result;
        } else {
            return "The student doesn't have the required number of grades.";
        }


    }

    public function getSchoolBoard($student_id){

        $student = Student::find($student_id);
        return $student->board->name;

    }

    public function getAverageGrades($id) {
        $student = Student::find($id);
        return $student->grade()->avg('grade');
    }


    public function getGrades($id) {
        $grades = Grade::select('grade')->where('student_id', $id)->get()->toArray();
        foreach ($grades as $key => $grade) {
            unset($grades[$key]);
            array_push($grades,$grade['grade']);
        }

        return array_values($grades);
    }

    public function createXML($array) {

        $xml = new DOMDocument('1.0');
        $xml->formatOutput = true;
        $schoolBoard = $xml->createElement('schoolBoard');
        $xml->appendChild($schoolBoard);

        $student = $xml->createElement('studentInfo');
        $schoolBoard->appendChild($student);
        foreach ($array as $key=>$val) {
            if(is_array($val)) {
                $grades = $xml->createElement('grades');
                $student->appendChild($grades);
                foreach ($val as $grade) {
                    $grade = $xml->createElement('grade', $grade);
                    $grades->appendChild($grade);
                }
            } else {
                $info = $xml->createElement($key, $val);
                $student->appendChild($info);
            }

        }
        return "<xmp>" . $xml->saveXML(). "</xmp>";
    }

}