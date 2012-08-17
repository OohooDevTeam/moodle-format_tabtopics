<?php

/* * **********************************************************************
 * *                     TabTopics Course Format                         **
 * ************************************************************************
 * @package     format                                                   **
 * @subpackage  tabtopics                                                **
 * @name        TabTopics                                                **
 * @copyright   oohoo.biz                                                **
 * @link        http://oohoo.biz                                         **
 * @author      Braedan Jongerius <jongeriu@ualberta.ca>                 **
 * @author      Sam Hemelryk (Original author)                           **
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later **
 * ************************************************************************
 * ********************************************************************** */

/**
 * This file contains general functions for the course format Topic
 */

/**
 * Indicates this format uses sections.
 *
 * @return bool Returns true
 */
function callback_tabtopics_uses_sections() {
    return true;
}

/**
 * Used to display the course structure for a course where format=topic
 *
 * This is called automatically by {@link load_course()} if the current course
 * format = weeks.
 *
 * @param array $path An array of keys to the course node in the navigation
 * @param stdClass $modinfo The mod info object for the current course
 * @return bool Returns true
 */
function callback_tabtopics_load_content(&$navigation, $course, $coursenode) {
    return $navigation->load_generic_course_sections($course, $coursenode, 'tabtopics');
}

/**
 * The string that is used to describe a section of the course
 * e.g. Topic, Week...
 *
 * @return string
 */
function callback_tabtopics_definition() {
    return get_string('topic');
}

function callback_tabtopics_get_section_name($course, $section) {
    // We can't add a node without any text
    if ((string) $section->name !== '') {
        return format_string($section->name, true, array('context' => get_context_instance(CONTEXT_COURSE, $course->id)));
    } else if ($section->section == 0) {
        return get_string('section0name', 'format_tabtopics');
    } else {
        return get_string('topic') . ' ' . $section->section;
    }
}

/**
 * Declares support for course AJAX features
 *
 * @see course_format_ajax_support()
 * @return stdClass
 */
function callback_tabtopics_ajax_support() {
    $ajaxsupport = new stdClass();
    $ajaxsupport->capable = true;
    $ajaxsupport->testedbrowsers = array('MSIE' => 6.0, 'Gecko' => 20061111, 'Safari' => 531, 'Chrome' => 6.0);
    return $ajaxsupport;
}

/**
 * Callback function to do some action after section move
 *
 * @param stdClass $course The course entry from DB
 * @return array This will be passed in ajax respose.
 */
function callback_tabtopics_ajax_section_move($course) {
    global $COURSE, $PAGE;

    $titles = array();
    rebuild_course_cache($course->id);
    $modinfo = get_fast_modinfo($COURSE);
    $renderer = $PAGE->get_renderer('format_tabtopics');
    if ($renderer && ($sections = $modinfo->get_section_info_all())) {
        foreach ($sections as $number => $section) {
            $titles[$number] = $renderer->section_title($section, $course);
        }
    }
    return array('sectiontitles' => $titles, 'action' => 'move');
}
