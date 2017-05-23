<?php

namespace ch;

class Course
{
    public $semester;
    public $year;
    public $department;
    public $course_number;
    
    // Constructor parses input
    public function __construct($input){
        $this->parseCourse($input);
        $exploded_input = explode($this->course_number, $input);
        $sessionInput = $important = $exploded_input[1];
        $this->parseSession($sessionInput);
    }

    
    // meat of the class - parses input
    private function parseCourse($input) {
        $matches = array();
        if ( preg_match('/^([A-Z]+)/i', $input, $matches) ) {
            $this->department = $matches[1];
        } else {
            $this->fail('Problem parsing department');
        }
        $matches = array();
        if ( preg_match('/([0-9]+)/', $input, $matches) ) {
            $this->course_number = $matches[1];
        } else {
            $this->fail('Problem parsing course number');
        }

    }

    
    // takes session info and parses semester and year
    private function parseSession($input) {
        $matches = array();
        if ( preg_match('/([A-Z]+)/i', $input, $matches) ) {
            $semester = $matches[1];
            $this->semester = $this->getSemesterFromInput($semester);
        } else {
            $this->fail('Problem parsing semester');
        }
        $matches = array();
        if ( preg_match('/([0-9]+)/', $input, $matches) ) {
            $year = $matches[1];
            $this->year = $this->getYearFromInput($year);
        } else {
            $this->fail('Problem parsing year');
        }
    }
    
    // used for lookup of valid input
    private $semesterLookup = array
        ('F' => 'Fall',
        'f' => 'Fall',
        'fall' => 'Fall',
        'Fall'  => 'Fall',
        'S' => 'Spring',
        's' => 'Spring',
        'spring' => 'Spring',
        'Spring'  => 'Spring',
        'SU' => 'Summer',
        'su' => 'Summer',
        'Su' => 'Summer',
        'Summer' => 'Summer',
        'SUMMER' => 'Summer',
        'summer'  => 'Summer',
        'W' => 'Winter',
        'w' => 'Winter',
        'winter' => 'Winter',
        'WINTER'  => 'Winter',
        'Winter'  => 'Winter',
        );
    
    // parses semester
    private function getSemesterFromInput($semester){
        $found_semester =  $this->semesterLookup[$semester];
        if (!$found_semester) {
            $this->fail('Problem parsing semester:' .  $semester);
        }
        return $found_semester;
    }

    // parases year
    private function getYearFromInput($year){
        if (strlen($year) != 2 && strlen($year) != 4) {
            $this->fail('Problem parsing year');
        }
        if (strlen($year) == 2) {
            $year = '20' . $year;
        }
        
        return $year;
    }
    
    // used for error cases
    private function fail($message) {
        // TBD
        throw(new \Exception($message));
    }
    
    // output method returns string
    public function normalizedOutput() {
        $output = "Department: $this->department\n";
        $output .= "Course Number: $this->course_number\n";
        $output .= "Year: $this->year\n";
        $output .= "Semester: $this->semester\n";  
        return $output;
    }
}

$c = new Course('CS111 2016 Fall');
echo $c->normalizedOutput();
// $c = new Course('CS111 2016 Fal');
// echo $c->normalizedOutput();
