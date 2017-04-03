<?php

/**
 * Created by PhpStorm.
 * User: cham11ng
 * Date: 9/25/16
 * Time: 3:49 PM
 */
$config['attributes']['rel'] = FALSE;

$config = array(
    'first_link'        => FALSE,
    'last_link'         => FALSE,
    'num_links'         => 5,

    'use_page_numbers'  => TRUE,
    'full_tag_open'     => "<ul class='pager'>",
    'display_pages'     => TRUE,
    'full_tag_close'    => '</ul>',

    'prev_link'         => 'Previous',
    'prev_tag_open'     => "<li class='previous'>",
    'prev_tag_close'    => "</li>",

    'next_link'         => 'Next',
    'next_tag_open'     => "<li class='next'>",
    'next_tag_close'    => "</li>",

    'first_tag_open'    => "<li>",
    'first_tag_close'   => "</li>",

    'last_tag_open'     => "<li>",
    'last_tag_close'    => "</li>",

    'cur_tag_open'      => '<li><a>',
    'cur_tag_close'     => '</a></li>',

    'num_tag_open'      => '<li>',
    'num_tag_close'     => '</li>'
);