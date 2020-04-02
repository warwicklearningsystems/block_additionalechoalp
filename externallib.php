<?php

defined('MOODLE_INTERNAL') || die();

require_once("$CFG->libdir/externallib.php");


class block_additionalechoalp_external extends external_api {

  public static function course_update_echo360_block_parameters() {
    return new external_function_parameters(
      array(
        'courseid' => new external_value(PARAM_INT, 'Course ID', VALUE_REQUIRED),
        'blockid' => new external_value(PARAM_INT, 'Course ID', VALUE_REQUIRED),
        'linkname' => new external_value(PARAM_TEXT, 'Link name', VALUE_REQUIRED),
        'explanation' => new external_value(PARAM_TEXT, 'Explanatory text', VALUE_REQUIRED),
      )
    );
  }

  public static function course_update_echo360_block_returns() {
    return new external_value(PARAM_ID, 'Block ID');
  }

  public static function course_update_echo360_block($courseid, $blockid, $linkname, $explanation) {

    global $DB;

    // Parameter validation
    $params = self::validate_parameters(self::course_update_echo360_block_parameters(),
      array('courseid' => $courseid, 'blockid' => $blockid, 'linkname' => $linkname, 'explanation' => $explanation));

    // Find the course
    $course = get_course($params['courseid']);
    $context = context_course::instance($course->id);

    // Check the block exists
    $block = $DB->get_record('block_instances', array('parentcontextid' => $context->id, 'id' => $params['blockid']));

    // If it does, then update HTML
    if($block && $block->blockname == 'additionalechoalp') {
      // Build config
      $config = new stdClass();
      $config->text = $params['linkname'];
      $config->explanation = $params['explanation'];

      $DB->update_record('block_instances', ['id' => $params['blockid'],
        'configdata' => base64_encode(serialize($config)), 'timemodified' => time()]);
      return $block->id;
    }

    return NULL;
  }



}