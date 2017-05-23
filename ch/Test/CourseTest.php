<?php

namespace ch\Test;

use \ch\Course;

class CourseTest extends \PHPUnit_Framework_TestCase
{

    public function testParseValid()
    {
        $course = new Course('CS111 2016 Fall');
        $this->assertEquals($course->semester, 'Fall');
        $this->assertEquals($course->year, '2016');
        $this->assertEquals($course->department, 'CS');
        $this->assertEquals($course->course_number, '111');
        
        $course = new Course('MATH 123 2015 Spring');
        $this->assertEquals($course->semester, 'Spring');
        $this->assertEquals($course->year, '2015');
        $this->assertEquals($course->department, 'MATH');
        $this->assertEquals($course->course_number, '123');

    }

    
    public function testParseInvalid()
    {
        // $course = new Course();
        // $this->expectException(\Exception::class);
        // $course->parse('CS1112016 Fall');

        // $course->parse('MATH 123 2015 Spring');

    }
    
}