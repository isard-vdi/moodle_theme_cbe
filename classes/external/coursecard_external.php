<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package     theme_cbe
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @copyright   3iPunt <https://www.tresipunt.com/>
 */

namespace theme_cbe\external;

use coding_exception;
use context_course;
use course_enrolment_manager;
use external_api;
use external_function_parameters;
use external_single_structure;
use external_value;
use invalid_parameter_exception;
use theme_cbe\course;

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->libdir . '/externallib.php');
require_once($CFG->dirroot . '/webservice/lib.php');

class coursecard_external extends external_api {

    /**
     * @return external_function_parameters
     */
    public static function getcourseextra_parameters(): external_function_parameters {
        return new external_function_parameters(
            ['course_id' => new external_value(PARAM_INT, 'Course ID')
            ]
        );
    }

    /**
     * @param string $course_id
     * @return array
     * @throws invalid_parameter_exception
     * @throws coding_exception
     * @throws \dml_exception
     */
    public static function getcourseextra(string $course_id): array {

        global $PAGE, $DB, $CFG;
        require_once($CFG->dirroot . '/enrol/locallib.php');

        $params = self::validate_parameters(
            self::getcourseextra_parameters(), [
                'course_id' => $course_id
            ]
        );

        $coursecontext = context_course::instance($course_id);
        $course = get_course($course_id);

        if (has_capability('moodle/course:update', $coursecontext)) {
            $rolename = 'teacher';
        } else {
            $rolename = 'student';
        }

        $role = $DB->get_record('role', array('shortname' => 'student'));
        $enrolmanager = new course_enrolment_manager($PAGE, $course, $instancefilter = null, $role->id,
            $searchfilter = '', $groupfilter = 0, $statusfilter = -1);
        $students = $enrolmanager->get_users('id');
        return [
            'role' => $rolename,
            'rolename' => get_string($rolename, 'theme_cbe'),
            'students_num' => count($students)
        ];
    }

    /**
     * @return external_single_structure
     */
    public static function getcourseextra_returns() {
        return null;
    }

    /**
     * @return external_function_parameters
     */
    public static function getteachers_parameters(): external_function_parameters {
        return new external_function_parameters(
            ['course_id' => new external_value(PARAM_INT, 'Course ID')]
        );
    }

    /**
     * @param string $course_id
     * @return array
     * @throws invalid_parameter_exception
     */
    public static function getteachers(string $course_id): array {

        $params = self::validate_parameters(
            self::getcourseextra_parameters(), [
                'course_id' => $course_id
            ]
        );

        $course = new course($course_id);

        return [
            'teachers' => [
                [
                    'picture' => 'http://localhost/consorci/pluginfile.php/25/user/icon/cbe/f1?rev=33',
                    'fullname' => 'Maria Antonio Gijmems'
                ]
            ]
        ];
    }

    /**
     * @return external_single_structure
     */
    public static function getteachers_returns() {
        return null;
    }
}