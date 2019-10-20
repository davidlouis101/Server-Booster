<?php

declare(strict_types=1);

namespace ceepkev77;

use pocketmine\block\BlockFactory;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\entity\Entity;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntitySpawnEvent;
use pocketmine\event\Listener;
use pocketmine\Item\Item;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\StringTag;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use jojoe77777\FormAPI;
use DateTime;

class Main extends PluginBase implements Listener {

    public $bsek = 840;
    public $fsek = 840;
    public $sek = 0;
    public $bba = false;
    public $fba = false;
    public $prefix = "§4Booster§c >>§b ";
    /** @var string */
    public $noperm = TextFormat::RED . "Du benötigst einen Rang um den Booster zu aktivieren!";
    public $helpHeader =
        TextFormat::AQUA . "--- " .
        TextFormat::AQUA . "[" . TextFormat::RED . "Server Booster" . TextFormat::AQUA . "] " .
        TextFormat::AQUA . "---";
    /** @var string[] */
    public $mainArgs = [
        "help: /booster help",
        "feed: /booster feed",
        "heal: /booster heal",
        "fly: /booster fly",
        "break: /booster break",
        "version: /booster version",
    ];

    /**
     * @return void
     */
    public function onEnable(): void {
        $this->getLogger()->info("Booster wurde aktiviert");
    }   
	
        
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        switch (strtolower($command->getName())) {
            case "booster":
                if ($sender instanceof Player) {
                    if (!isset($args[0])) {
                        if (!$sender->hasPermission("booster.command")) {
                            $sender->sendMessage($this->noperm);
                            return true;
                        } else {
                            $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 0:
                    $sender->addTitle("§bBooster", "§cvon ceepkev77");
                        break;
                    case 1:
                    $command = "booster help";
								$this->getServer()->getCommandMap()->dispatch($sender, $command);
						break;
						           case 2:
                    $command = "booster feed";
								$this->getServer()->getCommandMap()->dispatch($sender, $command);
                        break;
                                   case 3:
                    $command = "booster heal";
								$this->getServer()->getCommandMap()->dispatch($sender, $command);
                        break;
                                     case 4:
                    $command = "booster fly";
								$this->getServer()->getCommandMap()->dispatch($sender, $command);
                        break;
                                     case 5:
                    $command = "booster break";
								$this->getServer()->getCommandMap()->dispatch($sender, $command);
                        break;
                            }
             });
        $form->setTitle("§l§b Booster");
        $form->setContent("§6Hier kannst du §1Booster den Booster aktivieren!");
        $form->addButton("§4Abbruch", 0);
        $form->addButton("§dHelp", 1);
        $form->addButton("§dFeed", 2);
        $form->addButton("§dHeal", 3);
        $form->addButton("§dFly", 4);
        $form->addButton("§dBreak", 5);
        $form->sendToPlayer($sender);
        }
        return true;
                    }
                    $arg = array_shift($args);
                    switch ($arg) {
                        case "version":
                            if (!$sender->hasPermission("booster.version")) {
                                $sender->sendMessage($this->noperm);
                                return true;
                            }
                            $sender->sendMessage($this->prefix . "§r" . TextFormat::BLUE . "Booster Version 1.0.0 von ceepkev77");
                            return true;
                        case "help":
                        case "?":
                            $sender->sendMessage($this->helpHeader);
                            foreach ($this->mainArgs as $msgArg) {
                                $sender->sendMessage(TextFormat::AQUA . " - " . $msgArg . "\n");
                            }
                            return true;
                            break;
                        case "feed":
                            if (!$sender->hasPermission("booster.feed")) {
                                 $sender->sendMessage($this->noperm);
                                return true;
                            }
                            foreach ($this->getServer()->getOnlinePlayers() as $p) {
                                 $player = $sender->getName();
                                 $p->setFood(20);
                            }
                                  $this->getServer()->broadcastMessage($this->prefix . "$player hat den Feed-Booster aktiviert");
                               return true;
                        case "heal":
                            if (!$sender->hasPermission("booster.heal")) {
                                 $sender->sendMessage($this->noperm);
                                return true;
                            }
                            foreach ($this->getServer()->getOnlinePlayers() as $p) {
                                  $player = $sender->getName();
                                  $p->setHealth(20);                            
                            }
                                  $this->getServer()->broadcastMessage($this->prefix . "$player hat den Heal-Booster aktiviert");

                                return true;
                        case "fly":
                            if (!$sender->hasPermission("booster.fly")) {
                                 $sender->sendMessage($this->noperm);
                                return true;
                            }
                            foreach ($this->getServer()->getOnlinePlayers() as $p) {
                                 $player = $sender->getName();
                                 $p->setAllowFlight(TRUE);
                            $this->getScheduler()->scheduleRepeatingTask(new FlyBooster($this), 30);
                            }
                               $this->getServer()->broadcastMessage($this->prefix . "$player hat den Fly-Booster aktiviert");
                              return true;

                        case "break":
                            if (!$sender->hasPermission("booster.break")) {
                                 $sender->sendMessage($this->noperm);
                            return true;
                            }
                            foreach ($this->getServer()->getOnlinePlayers() as $p) {
                                            $player = $sender->getName();
                                            $effect = new EffectInstance(Effect::getEffect(3), 999999999, 3, false);
                                            $p->addEffect($effect);
                                            $this->getScheduler()->scheduleRepeatingTask(new BreakBooster($this), 30);
                                              }
                                              $this->getServer()->broadcastMessage($this->prefix . "$player hat den Break-Booster aktiviert");    
                             return true;

    } 
   }
  }
  return true;
 }
}
