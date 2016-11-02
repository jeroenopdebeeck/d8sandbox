<?php

namespace Drupal\bulletin_board\Plugin\views\field;

use Drupal\views\Plugin\views\display\DisplayPluginBase;
use Drupal\views\Plugin\views\field\FieldPluginBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\views\ResultRow;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\views\ViewExecutable;


/**
 * Field handler to flag the node type.
 *
 * @ingroup views_field_handlers
 *
 * @ViewsField("node_comment_link_with_counter")
 */
class NodeCommentLinkWithCounter extends FieldPluginBase
{

  /**
   * {@inheritdoc}
   */
  public function init(ViewExecutable $view, DisplayPluginBase $display, array &$options = NULL) {
    parent::init($view, $display, $options);
    $this->additional_fields['entity_id'] = 'nid';
    $this->additional_fields['comment_count'] = array('table' => 'comment_entity_statistics', 'field' => 'comment_count');
  }


  /**
   * @{inheritdoc}
   */
  public function query() {
    $this->ensureMyTable();
    $this->addAdditionalFields();
  }

  /**
   * Define the available options
   * @return array
   */
  protected function defineOptions() {
    $options = parent::defineOptions();
    return $options;
  }

  /**
   * Provide the options form.
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);
  }



  /**
   * @{inheritdoc}
   */
  public function render(ResultRow $values) {
    $nid = $this->getValue($values, 'nid');
    $comment_count = $this->getValue($values, 'comment_count');
    $url = Url::fromUserInput('/node/' . $nid . '#comment-form');
    if ($comment_count > 0) {
      $comment_link = Link::fromTextAndUrl(t('Reacties') . ' (' . $comment_count . ') >', $url);
    } else {
      $comment_link = Link::fromTextAndUrl(t('Reageer'). ' >', $url);
    }
    return $comment_link->toString();
  }
}