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

namespace theme_serlo\output;

use theme_boost\output\core_renderer as base_core_render;

defined('MOODLE_INTERNAL') || die;

/**
 * Renderers to align Moodle's HTML with that expected by Bootstrap
 *
 * @package    theme_boost
 * @copyright  2012 Bas Brands, www.basbrands.nl
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_renderer extends base_core_render
{
    public function firstview_fakeblocks(): bool
    {
        $first_view = parent::firstview_fakeblocks();
        global $COURSE;
        $this->course_activitychooser($COURSE->id);
        return $first_view;
    }

    /**
     * Build the HTML for the module chooser javascript popup.
     *
     * @param int $courseid The course id to fetch modules for.
     * @return string
     */
    public function course_activitychooser($courseid)
    {
        if (!$this->page->requires->should_create_one_time_item_now('core_course_modchooser')) {
            return '';
        }

        // Build an object of config settings that we can then hook into in the Activity Chooser.
        $chooserconfig = (object) [
            'tabmode' => get_config('core', 'activitychoosertabmode'),
        ];
        $this->page->requires->js_call_amd('theme_serlo/activitychooser', 'init', [$courseid, $chooserconfig]);

        return '';
    }
}
