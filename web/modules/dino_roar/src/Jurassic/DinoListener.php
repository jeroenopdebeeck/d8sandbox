<?php

namespace Drupal\dino_roar\Jurassic;

use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class DinoListener implements EventSubscriberInterface
{

  /**
   * @var LoggerChannelFactoryInterface
   */
  private $loggerFactory;

  public function __construct(LoggerChannelFactoryInterface $loggerFactory)
  {

    $this->loggerFactory = $loggerFactory;
  }

  public function onKernelRequest(GetResponseEvent $event)
  {
    $request = $event->getRequest();
    $shouldRoar = $request->query->get('roar');

    if($shouldRoar) {
      $this->loggerFactory->get('default')->debug("Roar logged");
    }
  }

  /**
   * Returns an array of event names this subscriber wants to listen to.
   *
   * The array keys are event names and the value can be:
   *
   *  * The method name to call (priority defaults to 0)
   *  * An array composed of the method name to call and the priority
   *  * An array of arrays composed of the method names to call and respective
   *    priorities, or 0 if unset
   *
   * For instance:
   *
   *  * array('eventName' => 'methodName')
   *  * array('eventName' => array('methodName', $priority))
   *  * array('eventName' => array(array('methodName1', $priority), array('methodName2')))
   *
   * @return array The event names to listen to
   */
  public static function getSubscribedEvents()
  {
    return [
      KernelEvents::REQUEST => 'onKernelRequest',
    ];
  }
}