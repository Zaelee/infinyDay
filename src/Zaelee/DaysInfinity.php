<?php

namespace Zaelee;

use pocketmine\event\Listener;
use pocketmine\event\world\WorldLoadEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\world\World;

class DaysInfinity extends PluginBase implements Listener
{
    public function onEnable(): void
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function loadAllWorld()
    {
        foreach (scandir($this->getServer()->getDataPath() . "worlds") as $name){
            if(in_array($name, [".", ".."]))
                continue;
            $this->getServer()->getWorldManager()->loadWorld($name);
            $this->getServer()->getWorldManager()->getWorldByName($name)->setTime(World::TIME_DAY);
            $this->getServer()->getWorldManager()->getWorldByName($name)->stopTime();
        }
    }

    public function onLevelLoad(WorldLoadEvent $event){
        $level = $event->getWorld();
        $level->setTime(World::TIME_DAY);
        $level->stopTime();
    }
}