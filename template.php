<?php

/**
 * @see hook_html_head_alter()
 */
function dpbootstrap_html_head_alter(&$head_elements)
{
    // modify meta tag for html5
    $head_elements['system_meta_content_type'] = array(
        '#type' => 'html_tag',
        '#tag'  => 'meta',
        '#attributes' => array(
            'charset' => 'utf-8'
        ),
    );

    // add chrome frame
    $head_elements['chrome_frame'] = array(
        '#type'       => 'html_tag',
        '#tag'        => 'meta',
        '#attributes' => array(
            'http-equiv' => 'X-UA-Compatible', 
            'content'    => 'IE=edge,chrome=1'
        ),
    );

    // add viewport meta
    $head_elements['viewport'] = array(
        '#type'       => 'html_tag',
        '#tag'        => 'meta',
        '#attributes' => array(
            'name'     => 'viewport', 
            'content'  => 'width=device-width, initial-scale=1'
        ),
    );

    // remove generator meta
    unset($head_elements['system_meta_generator']);
    // remove favicon
    unset($head_elements['drupal_add_html_head_link:shortcut icon:http://drupal7.dev/misc/favicon.ico']);

}

/**
 * @see hook_form_alter()
 */
function dpbootstrap_form_alter(&$form, &$form_state, $form_id)
{
    // for all forms
    $form['actions']['submit']['#attributes']['class'][] = 'btn btn-default';
    $form[$form_id]['#attributes']['class'][] = 'form-control';

    // search form
    if($form_id == 'search_block_form') {
        $form['#attributes']['class'][] = 'form-inline navbar-form';
    }

    dpm($form);
}