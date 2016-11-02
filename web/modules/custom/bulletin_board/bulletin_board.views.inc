<?php

/**
 * Implements hook_views_data_alter().
 */
function bulletin_board_views_data_alter(array &$data)
{
  $data['node']['node_comment_link_with_counter'] = array(
    'title' => t('Comment link with counter'),
    'field' => array(
      'title' => t('Comment link with counter'),
      'help' => t('Prints a comment link with a counter that shows the number of comments'),
      'id' => 'node_comment_link_with_counter',
    )
  );
}