<?php

namespace Drupal\dino_roar\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Drupal\dino_roar\Jurassic\RoarGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

class RoarController extends ControllerBase

{
  private $roarGenerator;
  private $logger;

  public function __construct(RoarGenerator $roarGenerator, LoggerChannelFactoryInterface $loggerFactory)
  {

    $this->roarGenerator = $roarGenerator;
    $this->logger = $loggerFactory;
  }

  public function roar($count)
  {


    $roar = $this->roarGenerator->getRoar($count);
    $this->logger->get('default')->debug($roar);
    
    return [
      '#title' => $roar,
    ];
  }

  public static function create(ContainerInterface $container)
  {
    $roarGenerator = $container->get('dino_roar.roar_generator');
    $loggerFactory = $container->get('logger.factory');

    return new static($roarGenerator, $loggerFactory);
  }
}