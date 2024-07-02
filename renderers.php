<?php
global $CFG;
include_once $CFG->dirroot . "/course/renderer.php";

class theme_serlo_core_course_renderer extends \core_course_renderer {
  /**
   * Renders HTML for the menus to add activities and resources to the current course
   *
   * Renders the ajax control (the link which when clicked produces the activity chooser modal). No noscript fallback.
   *
   * @param stdClass $course
   * @param int $section relative section number (field course_sections.section)
   * @param int $sectionreturn The section to link back to
   * @param array $displayoptions additional display options, for example blocks add
   *     option 'inblock' => true, suggesting to display controls vertically
   * @return string
   */
  public function course_section_add_cm_control($course, $section, $sectionreturn = null, $displayoptions = array()) {
    // Check to see if user can add menus.
    if (!has_capability('moodle/course:manageactivities', context_course::instance($course->id))
      || !$this->page->user_is_editing()) {
      return '';
    }

    $data = [
      'sectionid' => $section,
      'sectionreturn' => $sectionreturn,
    ];
    $ajaxcontrol = '<div>' . $this->render_from_template('course/activitychooserbutton', $data) . '</div>';

    // Load the JS for the modal.
    $this->course_activitychooser($course->id);

    return $ajaxcontrol;
  }
}