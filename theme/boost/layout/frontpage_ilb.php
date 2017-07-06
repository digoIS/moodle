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
 * A one column layout for the boost theme.
 *
 * @package   theme_boost
 * @copyright 2016 Damyon Wiese
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/../config.php');

if (isloggedin()) {
	user_preference_allow_ajax_update('drawer-open-nav', PARAM_ALPHA);
	require_once($CFG->libdir . '/behat/lib.php');

  $navdraweropen = (get_user_preferences('drawer-open-nav', 'true') == 'true');
	$extraclasses = [];
	if ($navdraweropen) {
	    $extraclasses[] = 'drawer-open-left';
	}
//$bodyattributes = $OUTPUT->body_attributes($extraclasses);
	$blockshtml = $OUTPUT->blocks('side-pre');
	$hasblocks = strpos($blockshtml, 'data-block=') !== false;
	$regionmainsettingsmenu = $OUTPUT->region_main_settings_menu();
	$templatecontext = [
	    'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
	    'output' => $OUTPUT,
	   	'sidepreblocks' => $blockshtml,
	 		'hasblocks' => $hasblocks,
	    'bodyattributes' => $bodyattributes,
	  //'navdraweropen' => $navdraweropen,
	  //'regionmainsettingsmenu' => $regionmainsettingsmenu,
	  //'hasregionmainsettingsmenu' => !empty($regionmainsettingsmenu),
         'username' => 'S',
	 'sessKey' => $USER->sesskey,
         'moodle_url' => $CFG->wwwroot
	];

	$templatecontext['flatnavigation'] = $PAGE->flatnav;
	//	echo $OUTPUT->render_from_template('theme_boost/frontpage_ilblogado', $templatecontext);
	//echo $OUTPUT->render_from_template('theme_boost/columns2', $templatecontext);
  echo $OUTPUT->render_from_template('theme_boost/frontpage_ilb', $templatecontext);

} else {
	$bodyattributes = $OUTPUT->body_attributes([]);

	$templatecontext = [
    	'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
	    'output' => $OUTPUT,
	    'bodyattributes' => $bodyattributes,
	    'moodle_url' => $CFG->wwwroot
	];
	echo $OUTPUT->render_from_template('theme_boost/frontpage_ilb', $templatecontext);
}
