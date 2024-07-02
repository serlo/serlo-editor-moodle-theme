<?php
defined('MOODLE_INTERNAL') || die();

$plugin->version = 2024061200; // YYYYMMDDHH (Year, Month, Day, 24-hr time)
$plugin->requires = 2023100400;
$plugin->component = 'theme_serlo';
$plugin->dependencies = [
  'theme_boost' => 2023100900,
];