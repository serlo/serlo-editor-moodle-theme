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
 * Settings code for the serlo theme
 *
 * @package   theme_serlo
 * @author    Faisal Kaleem <serlo@adornis.de>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @copyright 2024 Serlo (https://adornis.de)
 */

namespace theme_serlo\output;

defined('MOODLE_INTERNAL') || die();

use \format_topics\output\renderer;
use \moodle_url;
use context_course;

/**
 * Renderers format topics
 */
class format_topics_renderer extends renderer
{
    function course_section_add_cm_control($course, $section, $sectionreturn = null, $displayoptions = array())
    {
        // Check to see if user can add menus.
        if (
            !has_capability('moodle/course:manageactivities', context_course::instance($course->id))
            || !$this->page->user_is_editing()
        ) {
            return '';
        }

        $data = [
            'sectionid' => $section,
            'sectionreturn' => $sectionreturn,
            'serlo_empty_editor_url' => new moodle_url('/course/modedit.php', [
                "course" => $course->id,
                "add" => "serlo",
                "return" => 0,
                "type" => "empty",
                "section" => $section,
            ])
        ];
        $ajaxcontrol = $this->render_from_template('core_course/activitychooserbutton', $data);

        // Load the JS for the modal.
        $this->course_activitychooser($course->id);

        return $ajaxcontrol;
    }
}
