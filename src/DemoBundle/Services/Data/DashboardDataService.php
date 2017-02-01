<?php

namespace DemoBundle\Services\Data;

use APIBundle\Entity\AppUser;
use Bazookas\AdminBundle\Dashboard\Containers\Container;
use Bazookas\AdminBundle\Dashboard\Containers\RowContainer;
use Bazookas\AdminBundle\Dashboard\Elements\SingleStatisticElement;
use Bazookas\AdminBundle\Dashboard\Elements\StatisticElement;
use Bazookas\AdminBundle\Dashboard\Elements\UserStatisticElement;
use Doctrine\ORM\EntityManagerInterface;

class DashboardDataService
{
  private $entityManager;

  public function __construct(EntityManagerInterface $entityManager) {
    $this->entityManager = $entityManager;
  }
  
  public function getMainDashboard($locale) {
    //get the number of active players
    $activePlayerWidget = $this->getActivePlayerCountWidget();

    //get the number of created teams
    $teamWidget = $this->getCreatedTeamsWidget();

    //get the number of time the current tip of the day has been liked
    $tipLikesWidget = $this->getTipLikesWidget();

    $topRow = new RowContainer([$activePlayerWidget, $tipLikesWidget, $teamWidget]);


    //get the number of games played per game

    //get the number of coins collected overall (and by game).

    return new Container([$topRow]);
  }

  private function getActivePlayerCountWidget() {
    $userRepo = $this->entityManager->getRepository(AppUser::class);
    $count = $userRepo->getActivePlayerCount();

//    return new SingleStatisticElement([], [
//      'value' => $count,
//      'label' => 'some text',
//      'icon' => 'fa fa-user'
//    ]);

    return new UserStatisticElement([], [
      'value' => $count,
      'label' => 'some text'
    ]);

  }

  private function getTipLikesWidget() {
    return new StatisticElement([], [
      'value' => 3,
      'label' => 'some text',
      'icon' => 'fa fa-user'
    ]);
  }

  private function getCreatedTeamsWidget() {
    return new StatisticElement([], [
      'value' => 12,
      'label' => 'some text',
      'icon' => 'fa fa-user'
    ]);
  }

  private function getGameWidget() {



  }

}
