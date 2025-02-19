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
 * @package theme_cbe
 * @author  2021 3iPunt <https://www.tresipunt.com/>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/* eslint-disable no-unused-vars */
/* eslint-disable no-console */

define([
        'jquery',
        'core/str',
        'core/ajax',
        'core/templates'
    ], function ($, Str, Ajax, Templates) {
        "use strict";

        /**
         *
         */
        let ACTION = {
            EXPAND_BUTTON: '[data-action="expand"]',
            CONTRACT_BUTTON: '[data-action="contract"]',
        };

        /**
         * @constructor
         * @param {String} region
         */
        function Comments(region) {
            this.node = $(region);
            this.node.find(ACTION.EXPAND_BUTTON).on('click', this.onExpandButtonClick.bind(this));
            this.node.find(ACTION.CONTRACT_BUTTON).on('click', this.onContractButtonClick.bind(this));
        }

        Comments.prototype.onExpandButtonClick = function (e) {
            const cmid = $(e.currentTarget).data('comment');
            const comment = this.node.find('.comments[data-comment="' + cmid + '"]');
            const button_contract = this.node.find('.contract-comments[data-comment="' + cmid + '"]');
            $(e.currentTarget).hide();
            $(button_contract).show();
            $(comment).show();
        };

        Comments.prototype.onContractButtonClick = function (e) {
            const cmid = $(e.currentTarget).data('comment');
            const comment = this.node.find('.comments[data-comment="' + cmid + '"]');
            const button_expand = this.node.find('.expand-comments[data-comment="' + cmid + '"]');
            $(e.currentTarget).hide();
            $(button_expand).show();
            $(comment).hide();
        };

        /** @type {jQuery} The jQuery node for the region. */
        Comments.prototype.node = null;

        return {
            /**
             * @param {String} region
             * @return {Comments}
             */
            initComments: function (region) {
                return new Comments(region);
            }
        };
    }
);