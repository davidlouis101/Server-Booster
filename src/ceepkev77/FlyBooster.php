<?php

namespace ceepkev77;


use pocketmine\level\sound\PopSound;
use pocketmine\math\Vector3;
use pocketmine\scheduler\Task;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as f;

class FlyBooster extends Task
{

    protected $plugin;

    public function __construct(Main $plugin)
    {
        $this->plugin = $plugin;
    }

    public function onRun(int $currentTick) : void {
            $this->plugin->fsek--;
            if($this->plugin->fsek === 30) {
                foreach ($this->plugin->getServer()->getOnlinePlayers() as $p) {
                         $p->sendMessage(f::RED.f::BOLD."\n\n\nDer ".f::YELLOW."Fly Booster ".f::RED."wird in 30 Sekunden deaktiviert!");
                         }
            }elseif($this->plugin->fsek === 10) {
                foreach ($this->plugin->getServer()->getOnlinePlayers() as $p) {
                         $p->sendMessage(f::RED.f::BOLD."\n\n\nDer ".f::YELLOW."Fly Booster ".f::RED."wird in wenigen Sekunden deaktiviert!");
                         }
            }elseif($this->plugin->fsek === 0) {
                foreach ($this->plugin->getServer()->getOnlinePlayers() as $p) {
                         $p->sendMessage(f::RED.f::BOLD."Der ".f::YELLOW." Fly- Booster ".f::RED." wurde wieder deaktiviert!\n".f::RED."Dein Flugmodus wurde deaktiviert!");
                    if($p->getGamemode() == 0) {
                        $p->setFlying(FALSE);
                        $p->setAllowFlight(FALSE);
                    }
                   }
                }
            }
        }