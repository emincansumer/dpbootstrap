<?php

/**
 * @see hook_theme()
 */
function dpbootstrap_theme($existing, $type, $theme, $path)
{
    
    $hooks['user_login_block'] = array(
        'template' => 'templates/user-login-block',
        'render element' => 'form',
    );

   return $hooks;

}

/**
 * @see hook_preprocess_HOOK()
 */
function dpbootstrap_preprocess_user_login_block(&$vars) {

    // modify fields
    $vars['form']['name']['#attributes']['class'] = array('form-control');
    $vars['form']['name']['#attributes']['placeholder'] = array(t('Username'));
    $vars['form']['pass']['#attributes']['class'] = array('form-control');
    $vars['form']['pass']['#attributes']['placeholder'] = array(t('Password'));
    $vars['form']['actions']['submit']['#attributes']['class'] = array('btn-block btn btn-primary');
    unset($vars['form']['name']['#title']);
    unset($vars['form']['pass']['#title']);
    unset($vars['form']['links']);
    unset($vars['form']['actions']['#theme_wrappers']);

    // render fields
    $vars['name'] = render($vars['form']['name']);
    $vars['pass'] = render($vars['form']['pass']);
    $vars['submit'] = render($vars['form']['actions']['submit']);
    $vars['rendered'] = drupal_render_children($vars['form']);
    
}

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
    // comment form
    } elseif($form_id == 'comment_node_article_form') {
        $form['actions']['preview']['#attributes']['class'][] = 'btn btn-default';
        $form['subject']['#attributes']['class'][] = 'form-control';
        $form['author']['name']['#attributes']['class'][] = 'form-control';
        $form['comment_body']['und'][0]['#attributes']['class'][] = 'form-control';
    }

}

/**
 * @see theme_menu_tree()
 */
function dpbootstrap_menu_tree($vars)
{
  return '<ul class="list-unstyled">' . $vars['tree'] . '</ul>';
}

/**
 * @see theme_menu_link()
 */
function dpbootstrap_menu_link($vars)
{

  $element = $vars['element'];
  $sub_menu = '';

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }

  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li class="">' . $output . $sub_menu . "</li>\n";

}

/**
 * Modify navigation tabs (used in page.tpl.php)
 */
function dpbootstrap_render_nav_tabs() 
{
    $output = '';

    if ($primary = menu_primary_local_tasks()) {
        $output .= '<ul class="nav nav-tabs">' . drupal_render($primary) . '</ul>';
    }

    if ($secondary = menu_secondary_local_tasks()) {
        $output .= '<ul class="nav nav-tabs">' . drupal_render($secondary) .'</ul>';
    }

    return $output;
}
