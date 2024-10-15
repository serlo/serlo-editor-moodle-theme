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

defined('MOODLE_INTERNAL') || die();

$plugin->version = 2024061200; // YYYYMMDDHH (Year, Month, Day, 24-hr time)!
$plugin->requires = 2022041900;
$plugin->component = 'theme_serlo';
$plugin->release   = '1.0.0';
$plugin->maturity  = MATURITY_STABLE;

$plugin->dependencies = [
    'theme_boost' => 2023100900,
];
