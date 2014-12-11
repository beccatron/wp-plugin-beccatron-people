# Beccatron People #
- Contributors: beccatron
- Donate link: http://beccatron.com
- Tags: custom post type, profiles, people
- Requires at least: 3.0.1
- Tested up to: 3.4
- Stable tag: 4.3
- License: GPLv2 or later
- License URI: http://www.gnu.org/licenses/gpl-2.0.html

A wordpress plugin that creates a custom post type "Beccatron People" for displaying profiles of people.

## Description ##

Creates a custom post type "Beccatron People" for displaying profiles of people (separate from user accounts).

A 'Beccatron Person' includes the following meta-data. You can incorporate these into your theme using the slug in parentheses and get_post_meta().

### Vital Stats ###

* Email `b_ppl_email`
* Website `b_ppl_website`
* Twitter `b_ppl_twitter`
* Facebook `b_ppl_facebook`
* Institutional Affiliations & Roles (up to 3) `b_ppl_inst1`, `b_ppl_inst2`, `b_ppl_inst3`, `b_ppl_role1`, `b_ppl_role2`, `b_ppl_role3`

### Short Bio ###
Place to enter a short bio for displaying on archive pages & in shortcodes ``b_ppl_shortbio``

### Headshot ###
The featured image box is relabeled as "headshot." ``the_post_thumbnail()``


## Installation ##

This section describes how to install the plugin and get it working.


1. Upload `beccatron-people.zip` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

## Frequently Asked Questions ##

### A question that someone might have ###

An answer to that question.

### What about foo bar? ###

Answer to foo bar dilemma.

## Screenshots ##

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png`
(or jpg, jpeg, gif).
2. This is the second screen shot

## Changelog ##

= 1.0 =
* Initial Commit. Still needs work!

## Credits ##

Based on the [WordPress Plugin Boilerplate](https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate "WordPress Plugin Boilerplate on github") by Tom Mcfarlin 

