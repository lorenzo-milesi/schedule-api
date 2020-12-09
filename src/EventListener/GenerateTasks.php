<?php

namespace App\EventListener;

use App\Entity\Day;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use App\Entity\Task;

class GenerateTasks
{
    private ContainerBagInterface $params;

    public function __construct(ContainerBagInterface $params)
    {
        $this->params = $params;
    }

    public function postPersist(Day $day, LifecycleEventArgs $event): void
    {
        $em = $event->getObjectManager();
        $hours = $this->params->get('hours');
        for ($t = $hours['min']; $t <= $hours['max']; $t++) {
            $task = new Task();
            $task->setName('-');
            $task->setHour($t);
            $task->setDay($day);
            $em->persist($task);
        }
        $em->flush();
    }
}
