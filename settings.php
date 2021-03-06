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
 * Global settings for plugin.
 * @package   mod_collaborate
 * @copyright Copyright (c) 2015 Moodlerooms Inc. (http://www.moodlerooms.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

use mod_collaborate\logging\constants;
use mod_collaborate\trimmed_configtext;

if ($ADMIN->fulltree) {

    $name = 'collaborate/server';
    $title = new \lang_string('configserver', 'collaborate');
    $description = new \lang_string('configserverdesc', 'collaborate');
    $default = '';
    $setting = new trimmed_configtext($name, $title, $description, $default);
    $settings->add($setting);

    $name = 'collaborate/username';
    $title = new \lang_string('configusername', 'collaborate');
    $description = '';
    $default = '';
    $setting = new trimmed_configtext($name, $title, $description, $default);
    $settings->add($setting);

    $name = 'collaborate/password';
    $title = new \lang_string('configpassword', 'collaborate');
    $description = '';
    $default = '';
    $setting = new \admin_setting_configpasswordunmask($name, $title, $description, $default);
    $settings->add($setting);

    $apitest = '<div>'.get_string('apidiagnosticsavenotice', 'mod_collaborate').'</div>';
    $apitest .= html_writer::link(
        new moodle_url('/mod/collaborate/testapi.php'),
        get_string('testapi', 'mod_collaborate'),
        [
            'class'  => 'btn btn-primary',
            'role'   => 'button',
            'target' => '_blank'
        ]
    );
    $setting = new \admin_setting_heading('apidiagnostics', get_string('apidiagnostics', 'collaborate'), $apitest);
    $settings->add($setting);

    // Add debugging settings.
    $name = 'collaborate/log';
    $setting = new \admin_setting_heading($name, get_string('debugging', 'mod_collaborate'), '');
    $settings->add($setting);

    $name = 'collaborate/wsdebug';
    $title = new lang_string('configwsdebug', 'collaborate');
    $description = new lang_string('configwsdebugdesc', 'collaborate');
    $checked = '1';
    $unchecked = '0';
    $default = $unchecked;
    $setting = new \admin_setting_configcheckbox($name, $title, $description, $default, $checked, $unchecked);
    $settings->add($setting);

    // Add log range.
    $name = 'collaborate/logrange';
    $title = new \lang_string('configlogging', 'collaborate');
    $description = new \lang_string('configloggingdesc', 'collaborate');
    $options = [
        constants::RANGE_NONE => get_string('log:none', 'mod_collaborate'),
        constants::RANGE_LIGHT => get_string('log:light', 'mod_collaborate'),
        constants::RANGE_MEDIUM => get_string('log:medium', 'mod_collaborate'),
        constants::RANGE_ALL => get_string('log:all', 'mod_collaborate'),
    ];
    $setting = new \admin_setting_configselect($name, $title, $description, 0, $options);
    $settings->add($setting);
}
