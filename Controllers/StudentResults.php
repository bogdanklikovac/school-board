<?php


class StudentResults
{
    const CSM = 'CSM';
    const CSMB = 'CSMB';

    public function getStudentResult($id) {
        $student = Student::find($id);

        $numOfStudentGrades = $student->grade()->count();


        $studentBoard = $this->getSchoolBoard($id);
        $studentInfo = Student::select('name','id')->where('id', $id)->get()->toArray();
        $averageGrade = $this->getAverageGrades($id);

        if($numOfStudentGrades >= 1 && $numOfStudentGrades <=4) {

            if($studentBoard == self::CSM) {
                $grades = $this->getGrades($id);
                $studentInfo[0]['averageGrade'] = $averageGrade;
                $studentInfo[0]['grades'] = $grades;
                $studentInfo[0]['status'] = ($averageGrade >= 7) ? 'PASS' : 'FAIL';
                $result = json_encode($studentInfo);
            }

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

                $result = $studentInfo[0];

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


}