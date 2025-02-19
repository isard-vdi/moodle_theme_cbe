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
 * @package   theme_cbe
 * @copyright 2021 Tresipunt
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use theme_cbe\admin_settingspage_tabs;

defined('MOODLE_INTERNAL') || die();

global $ADMIN;

if ($ADMIN->fulltree) {

    $settings = new theme_boost_admin_settingspage_tabs(
        'themesettingcbe', get_string('configtitle', 'theme_cbe'));

    $page = new admin_settingpage('theme_cbe_general',
        get_string('generalsettings', 'theme_cbe'));

    $setting = (new admin_setting_configtext(
        'theme_cbe/host',
        get_string('host', 'theme_cbe'),
        get_string('host_desc', 'theme_cbe'),
        false
    ));

    $page->add($setting);
    $setting = (new admin_setting_configtext(
        'theme_cbe/logourl',
        get_string('logourl', 'theme_cbe'),
        get_string('logourl_desc', 'theme_cbe'),
        false
    ));

    $page->add($setting);

    $setting = (new admin_setting_configcheckbox(
        'theme_cbe/header_api',
        get_string('header_api', 'theme_cbe'),
        get_string('header_api_desc', 'theme_cbe'),
        false
    ));

    $page->add($setting);


    $settings->add($page);

    // Funcionality settings.
    $page = new admin_settingpage('theme_cbe_funcionalities', get_string('funcionalitiesssettings', 'theme_cbe'));


    $setting = (new admin_setting_configcheckbox(
        'theme_cbe/vclasses_direct',
        get_string('vclasses_direct', 'theme_cbe'),
        get_string('vclasses_direct_desc', 'theme_cbe'),
        false
    ));

    $page->add($setting);

    $setting = (new admin_setting_configcheckbox(
        'theme_cbe/uniquenamecourse',
        get_string('uniquenamecourse_setting', 'theme_cbe'),
        get_string('uniquenamecourse_setting_desc', 'theme_cbe'),
        false
    ));
    $page->add($setting);
    $settings->add($page);

    // Advanced settings.
    $page = new admin_settingpage('theme_cbe_colours', get_string('colourssettings', 'theme_cbe'));

    $name = 'theme_cbe/brandcolor';
    $title = get_string('brandcolor', 'theme_boost');
    $description = get_string('brandcolor_desc', 'theme_boost');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '#d5045c');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_cbe/secondarycolor';
    $title = get_string('secondarycolor', 'theme_cbe');
    $description = '';
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '#FFFFFF');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_cbe/backboardcolor';
    $title = get_string('backboardcolor', 'theme_cbe');
    $description = '';
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '#F0F0F0');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $setting = (new admin_setting_configcheckbox(
        'theme_cbe/flipcolor',
        get_string('flipcolor', 'theme_cbe'),
        '',
        false
    ));
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    $settings->add($page);

    // Advanced settings.
    $page = new admin_settingpage('theme_cbe_advanced', get_string('advancedsettings', 'theme_boost'));

    // Raw SCSS to include before the content.
    $setting = new admin_setting_scsscode('theme_cbe/scsspre',
        get_string('rawscsspre', 'theme_boost'), get_string('rawscsspre_desc', 'theme_boost'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Raw SCSS to include after the content.
    $setting = new admin_setting_scsscode('theme_cbe/scss', get_string('rawscss', 'theme_boost'),
        get_string('rawscss_desc', 'theme_boost'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);
}
