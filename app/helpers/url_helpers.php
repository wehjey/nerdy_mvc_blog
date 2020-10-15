<?php

/**
 * All Url helpers go in here
 */

/**
 * Redirect to page
 *
 * @param string $page
 * @return void
 */
function redirect($page)
{
    header('location: ' . URL_ROOT . '/' . $page);
}