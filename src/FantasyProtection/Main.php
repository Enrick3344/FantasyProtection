<?php 

namespace FantasyProtection;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\player\PlayerExhaustEvent;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PLayerInteractEvent;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener {
	
	public function onEnable(){
		if(!is_dir($this->getDataFolder())) mkdir($this->getDataFolder());
		$this->config = new Config($this->getDataFolder()."config.yml", Config::YAML, array(
		'Prefix' => "&7[&dFantasyProtection&7]",
		'Hunger' => array(
		           'world'),
		'Break' => array(
		          'world'),
		'Break-Message' => "&cYou are not aloud to break blocks here!",
		'Place' => array(
		          'world'),
		'Place-Message' => "&cYou are not aloud to place blocks here!",
		'Drop' => array(
			     'world'),
		'Drop-Message' => "&cYou are not aloud to drop items or blocks here!"
		));
		$this->config->save();
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
		$this->getLogger()->notice("FantasyProtection Enabled!");;
	}
	
	public function onExhaust(PlayerExhaustEvent $event){
		$player = $event->getPlayer();
		$world = $player->getLevel()->getName();
		$hunger = $this->getConfig()->get("Hunger");

        if(in_array($world, $hunger)){
             $event->setCancelled(true);
	    }
	}
	
	public function onBreak(BlockBreakEvent $event){
		$prefix = $this->getConfig()->get("Prefix");
		$message = $this->getConfig()->get("Break-Message");
		$player = $event->getPlayer();
		$world = $player->getLevel()->getName();
		$break = $this->getConfig()->get("Break");
		
		if(in_array($world, $break)){
			if($player->hasPermission("fantasyprotection.break.bypass")){
				return true;
			}else{
			$event->setCancelled();
			$player->sendMessage($prefix . " " . $message);
			}
		}
	}
	
	public function onPlace(BlockPlaceEvent $event){
		$prefix = $this->getConfig()->get("Prefix");
		$message = $this->getConfig()->get("Place-Message");
		$player = $event->getPlayer();
		$world = $player->getLevel()->getName();
		$place = $this->getConfig()->get("Place");
		
		if(in_array($world, $place)){
			if($player->hasPermission("fantasyprotection.break.bypass")){
				return true;
			}else{
			$event->setCancelled();
			$player->sendMessage($prefix . " " . $message);
			}
		}
	}
	
	public function onDrop(PlayerDropItemEvent $event){
		$prefix = $this->getConfig()->get("Prefix");
		$message = $this->getConfig()->get("Drop-Message");
		$player = $event->getPlayer();
		$world = $player->getLevel()->getName();
		$place = $this->getConfig()->get("Drop");
		
		if(in_array($world, $place)){
			if($player->hasPermission("fantasyprotection.drop.bypass")){
				return true;
			}else{
			$event->setCancelled();
			$player->sendMessage($prefix . " " . $message);
			}
		}
	}
	
	public function onDisable(){
		$this->getLogger()->notice("FantasyProtection Disabled!");
	}
}
?>
