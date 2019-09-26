<?php

namespace ceepkev77;


use pocketmine\level\sound\PopSound;
use pocketmine\scheduler\Task;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as f;

class BreakBooster extends Task
{
    protected $plugin;

    public function __construct(Main $plugin)
    {
        $this->plugin = $plugin;
    }

    public function onRun(int $currentTick) : void{
        $this->plugin->bsek--;
            if($this->plugin->bsek === 30) {
                foreach ($this->plugin->getServer()->getOnlinePlayers() as $p) {
                         $p->sendMessage(f::RED.f::BOLD."\n\n\nDer ".f::YELLOW."Break- Booster ".f::RED."wird in 30 Sekunden deaktiviert!");
                         }
            }elseif($this->plugin->bsek === 10) {
            foreach ($this->plugin->getServer()->getOnlinePlayers() as $p) {
                         $p->sendMessage(f::RED.f::BOLD."\n\n\nDer ".f::YELLOW."Break- Booster ".f::RED."wird in 10 Sekunden deaktiviert!");
                         }
            }elseif($this->plugin->bsek === 0) {
                foreach ($this->plugin->getServer()->getOnlinePlayers() as $p) {
                         $p->sendMessage(f::RED.f::BOLD."Der ".f::YELLOW." Break- Booster ".f::RED." wurde wieder deaktiviert!\n".f::RED."Du kannst nun wieder ganz normal abbauen.");
                    $p->removeAllEffects();
                    $p->getLevel()->addSound(new PopSound($p));
                }
            }
        }
    }