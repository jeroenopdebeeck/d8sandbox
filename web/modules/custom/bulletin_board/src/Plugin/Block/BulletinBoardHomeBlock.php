<?php

namespace Drupal\bulletin_board\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;

/**
 * Provides a 'Hello' Block
 *
 * @Block(
 *   id = "bulletin_board_home_block",
 *   admin_label = @Translation("Bulletin board home block"),
 * )
 */
class BulletinBoardHomeBlock extends BlockBase implements BlockPluginInterface
{

  /**
   * {@inheritdoc}
   */
  public function build() {
    return array(
      '#theme' => 'bulletin_board',
      '#new_messages' => $this->get_nr_new_messages(),
    );
  }

  private function get_nr_new_messages() {
    $query = \Drupal::entityQuery('node')
      ->condition('type', 'bulletin_message')
      ->condition('changed', strtotime('today midnight'), '>=')
      ->condition('status', 1);

    return $query->count()->execute();
  }
}
