<?php 

/*
 * 
 *  _____           _                  ____            _            _   _             
 * |  ___|_ _ _ __ | |_ __ _ ___ _   _|  _ \ _ __ ___ | |_ ___  ___| |_(_) ___  _ __  
 * | |_ / _` | '_ \| __/ _` / __| | | | |_) | '__/ _ \| __/ _ \/ __| __| |/ _ \| '_ \ 
 * |  _| (_| | | | | || (_| \__ \ |_| |  __/| | | (_) | ||  __/ (__| |_| | (_) | | | |
 * |_|  \__,_|_| |_|\__\__,_|___/\__, |_|   |_|  \___/ \__\___|\___|\__|_|\___/|_| |_|
 *                               |___/                                                
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 *
 * @author Enrick Fortier
 * 
 * Github: https://github.com/Enrick3344
 * Version: v2.0
 *
*/ 

namespace FantasyProtection;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\player\PlayerExhaustEvent;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
//Plugin File
use FantasyProtection\ProtectionCommand;


class Main extends PluginBase implements Listener {
	
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
		$this->loadCommand();
		if(!file_exists($this->getDataFolder() . "config.yml")){
     			 @mkdir($this->getDataFolder());
     			 file_put_contents($this->getDataFolder()."config.yml", $this->getResource("config.yml"));
   		 }
		$this->getLogger()->notice("FantasyProtection Enabled!");;
	}
	
	public function onDisable(){
		$this->getLogger()->notice("FantasyProtection Disabled!");
	}
	
	public function loadCommand(){
		$commands = [
		"protection" => new ProtectionCommand($this)
		];
		foreach($commands as $name => $class){
			$this->getServer()->getCommandMap()->register($name, $class);
		}
	}
	
	public function translateColors($string){
		$msg = str_replace("&1",TextFormat::DARK_BLUE,$string);
		$msg = str_replace("&2",TextFormat::DARK_GREEN,$msg);
		$msg = str_replace("&3",TextFormat::DARK_AQUA,$msg);
		$msg = str_replace("&4",TextFormat::DARK_RED,$msg);
		$msg = str_replace("&5",TextFormat::DARK_PURPLE,$msg);
		$msg = str_replace("&6",TextFormat::GOLD,$msg);
		$msg = str_replace("&7",TextFormat::GRAY,$msg);
		$msg = str_replace("&8",TextFormat::DARK_GRAY,$msg);
		$msg = str_replace("&9",TextFormat::BLUE,$msg);
		$msg = str_replace("&0",TextFormat::BLACK,$msg);
		$msg = str_replace("&a",TextFormat::GREEN,$msg);
		$msg = str_replace("&b",TextFormat::AQUA,$msg);
		$msg = str_replace("&c",TextFormat::RED,$msg);
		$msg = str_replace("&d",TextFormat::LIGHT_PURPLE,$msg);
		$msg = str_replace("&e",TextFormat::YELLOW,$msg);
		$msg = str_replace("&f",TextFormat::WHITE,$msg);
		$msg = str_replace("&o",TextFormat::ITALIC,$msg);
		$msg = str_replace("&l",TextFormat::BOLD,$msg);
		$msg = str_replace("&r",TextFormat::RESET,$msg);
		return $msg;
	}
	
	
	//PROTECTION EVENTS.
	
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
		$lockmessage = $this->getConfig()->get("Lock-Message");
		$player = $event->getPlayer();
		$world = $player->getLevel()->getName();
		$break = $this->getConfig()->get("Break");
		$lock = $this->getConfig()->get("Lock");
		if(in_array($world, $lock)){
			$event->setCancelled(true);
			$player->sendMessage($this->translateColors($prefix . " " . $lockmessage));
		}elseif(in_array($world, $break)){
			if($player->hasPermission("fantasyplus.break.bypass")){
				return true;
			}else{
			$event->setCancelled();
			$player->sendMessage($this->translateColors($prefix . " " . $message));
			}
		}
	}
	
	public function onPlace(BlockPlaceEvent $event){
		$prefix = $this->getConfig()->get("Prefix");
		$message = $this->getConfig()->get("Place-Message");
		$lockmessage = $this->getConfig()->get("Lock-Message");
		$player = $event->getPlayer();
		$world = $player->getLevel()->getName();
		$place = $this->getConfig()->get("Place");
		$lock = $this->getConfig()->get("Lock");
		if(in_array($world, $lock)){
			$event->setCancelled(true);
			$player->sendMessage($this->translateColors($prefix . " " . $lockmessage));
		}elseif(in_array($world, $break)){
			if($player->hasPermission("fantasyprotection.place.bypass")){
				return true;
			}else{
			$event->setCancelled();
			$player->sendMessage($this->translateColors($prefix . " " . $message));
			}
		}
	}
	
	public function onDrop(PlayerDropItemEvent $event){
		$prefix = $this->getConfig()->get("Prefix");
		$message = $this->getConfig()->get("Drop-Message");
		$player = $event->getPlayer();
		$world = $player->getLevel()->getName();
		$drop = $this->getConfig()->get("Drop");
		
		if(in_array($world, $drop)){
			if($player->hasPermission("fantasyprotection.drop.bypass")){
				return true;
			}else{
			$event->setCancelled();
			$player->sendMessage($this->translateColors($prefix . " " . $message));
			}
		}
	}
	
	public function onHurt(EntityDamageEvent $event){
		$world = $player->getLevel()->getName();
		$god = $this->getConfig()->get("God");
		if(in_array($world, $god)){
			$event->setCancelled();
		}
		if($event->getEntity() instanceof Player && $event instanceof EntityDamageByEntityEvent) {
			if($event->getDamager() instanceof Player){
				$prefix = $this->getConfig()->get("Prefix");
				$message = $this->getConfig()->get("PVP-Message");
				$pvp = $this->getConfig()->get("PVP");
				$player = $event->getDamager();
				if(in_array($world, $pvp)){
					$event->getDamager()->sendMessage($this->translateColors($prefix . " " . $message));
					$event->setCancelled();
				}
			}
		}
	}
}
