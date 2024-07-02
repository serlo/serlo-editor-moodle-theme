<?php

defined('MOODLE_INTERNAL') || die();

function theme_serlo_get_main_scss_content($theme) {
  global $CFG;
  $scss = '';
  $parent = theme_config::load('boost');
  $scss .= file_get_contents($parent->dir . '/scss/moodle.scss');
  $scss .= file_get_contents($CFG->dirroot . '/theme/serlo/scss/preset/default.scss');
  return $scss;
}

function theme_serlo_process_css($css, $theme) {
  return $css;
}