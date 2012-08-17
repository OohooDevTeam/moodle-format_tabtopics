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
 * @author      N.D.Freear@open.ac.uk, and others. (Original authors)    **
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later **
 * ************************************************************************
 * ********************************************************************** */

/**
 * TabTopics course format.  Display the whole course as "tabtopics" made of modules.
 */
defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/filelib.php');
require_once($CFG->libdir . '/completionlib.php');

if (!$PAGE->user_is_editing() && $course->coursedisplay == COURSE_DISPLAY_SINGLEPAGE) {
    echo "<style type='text/css'>@import url('format/tabtopics/css/jquery-ui-1.8.21.custom.css');</style>";

    $PAGE->requires->js(new moodle_url('format/tabtopics/js/jquery-1.7.1.js'));
    $PAGE->requires->js(new moodle_url('format/tabtopics/js/jquery-ui-1.8.18.custom.min.js'));
    $PAGE->requires->js('/course/format/tabtopics/js/displayTabs.js');
}

// Horrible backwards compatible parameter aliasing..
if ($topic = optional_param('topic', 0, PARAM_INT)) {
    $url = $PAGE->url;
    $url->param('section', $topic);
    debugging('Outdated topic param passed to course/view.php', DEBUG_DEVELOPER);
    redirect($url);
}
// End backwards-compatible aliasing..

$context = context_course::instance($course->id);

if (($marker >= 0) && has_capability('moodle/course:setcurrentsection', $context) && confirm_sesskey()) {
    $course->marker = $marker;
    course_set_marker($course->id, $marker);
}

$renderer = $PAGE->get_renderer('format_tabtopics');

if (!empty($displaysection) && $course->coursedisplay == COURSE_DISPLAY_MULTIPAGE) {
    $renderer->print_single_section_page($course, $sections, $mods, $modnames, $modnamesused, $displaysection);
} else {
    $renderer->print_multiple_section_page($course, $sections, $mods, $modnames, $modnamesused);
}

// Include course format js module
$PAGE->requires->js('/course/format/tabtopics/format.js');
