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
 * Library code for the serlo theme
 *
 * @package   theme_serlo
 * @author    Faisal Kaleem <serlo@adornis.de>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @copyright 2024 Serlo (https://adornis.de)
 */

/**
 * Summary of theme_serlo_get_main_scss_content
 * @param mixed $theme
 * @return string
 */
function theme_serlo_get_main_scss_content($theme) {
    global $CFG;
    $scss = '';
    $filename = !empty($theme->settings->preset) ? $theme->settings->preset : null;
    $fs = get_file_storage();

    $context = context_system::instance();
    if ($filename == 'default.scss') {
        // We still load the default preset files directly from the boost theme. No sense in duplicating them.
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');
    } else if ($filename == 'plain.scss') {
        // We still load the default preset files directly from the boost theme. No sense in duplicating them.
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/plain.scss');
    } else if ($filename && ($presetfile = $fs->get_file($context->id, 'theme_serlo', 'preset', 0, '/', $filename))) {
        // This preset file was fetched from the file area for theme_serlo and not theme_boost (see the line above).
        $scss .= $presetfile->get_content();
    } else {
        // Safety fallback - maybe new installs etc.
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');
    }

    // Pre CSS - this is loaded AFTER any prescss from the setting but before the main scss.
    $pre = file_get_contents($CFG->dirroot . '/theme/serlo/scss/pre.scss');
    // Post CSS - this is loaded AFTER the main scss but before the extra scss from the setting.
    $post = file_get_contents($CFG->dirroot . '/theme/serlo/scss/post.scss');

    // Combine them together.
    return $pre . "\n" . $scss . "\n" . $post;
}

/**
 * Summary of theme_serlo_process_css
 * @param mixed $css
 * @param mixed $theme
 * @return mixed
 */
function theme_serlo_process_css($css, $theme) {
    return $css;
}

/**
 * Summary of theme_serlo_get_pre_scss
 * @param mixed $theme
 * @return string
 */
function theme_serlo_get_pre_scss($theme) {
    // Load the settings from the parent.
    $theme = theme_config::load('boost');
    // Call the parent themes get_pre_scss function.
    return theme_boost_get_pre_scss($theme);
}

/**
 * Function to return the SCSS to append to our main SCSS for this theme.
 * Note the function name starts with the component name because this is a global function and we don't want namespace clashes
 * @param mixed $theme
 * @return string
 */
function theme_serlo_get_extra_scss($theme) {
    // Load the settings from the parent.
    $theme = theme_config::load('boost');
    // Call the parent themes get_extra_scss function.
    return theme_boost_get_extra_scss($theme);
}
