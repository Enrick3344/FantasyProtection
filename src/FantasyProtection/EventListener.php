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
use pocketmine\event\entity\EntityLevelChangeEvent;

class EventListener implements Listener{
	
	/** @var Main */
    	private $plugin;
    	/**
     	* @param Main $plugin
     	*/
    	public function __construct(Main $plugin) {
        	$this->plugin = $plugin;
    	}
	public function onExhaust(PlayerExhaustEvent $event){
		$player = $event->getPlayer();
		$world = $player->getLevel()->getName();
		$hunger = $this->plugin->getConfig()->get("Hunger");
        	if(in_array($world, $hunger)){
             		$event->setCancelled(true);
	      	}
	 }
	
	public function onBreak(BlockBreakEvent $event){
		$prefix = $this->plugin->getConfig()->get("Prefix");
		$message = $this->plugin->getConfig()->get("Break-Message");
		$lockmessage = $this->getConfig()->get("Lock-Message");
		$player = $event->getPlayer();
		$world = $player->getLevel()->getName();
		$break = $this->plugin->getConfig()->get("Break");
		$lock = $this->plugin->getConfig()->get("Lock");
		if(in_array($world, $lock)){
			$event->setCancelled(true);
			$player->sendMessage($this->plugin->translateColors($prefix . " " . $lockmessage));
		}elseif(in_array($world, $break)){
			if($player->hasPermission("fantasyplus.break.bypass")){
				return true;
			}else{
			$event->setCancelled();
			$player->sendMessage($this->plugin->translateColors($prefix . " " . $message));
			}
		}
	}
	
	public function onPlace(BlockPlaceEvent $event){
		$prefix = $this->plugin->getConfig()->get("Prefix");
		$message = $this->plugin->getConfig()->get("Place-Message");
		$lockmessage = $this->plugin->getConfig()->get("Lock-Message");
		$player = $event->getPlayer();
		$world = $player->getLevel()->getName();
		$place = $this->plugin->getConfig()->get("Place");
		$lock = $this->plugin->getConfig()->get("Lock");
		if(in_array($world, $lock)){
			$event->setCancelled(true);
			$player->sendMessage($this->plugin->translateColors($prefix . " " . $lockmessage));
		}elseif(in_array($world, $break)){
			if($player->hasPermission("fantasyprotection.place.bypass")){
				return true;
			}else{
			$event->setCancelled();
			$player->sendMessage($this->plugin->translateColors($prefix . " " . $message));
			}
		}
	}
	
	public function onDrop(PlayerDropItemEvent $event){
		$prefix = $this->plugin->getConfig()->get("Prefix");
		$message = $this->plugin->getConfig()->get("Drop-Message");
		$player = $event->getPlayer();
		$world = $player->getLevel()->getName();
		$drop = $this->plugin->getConfig()->get("Drop");
		
		if(in_array($world, $drop)){
			if($player->hasPermission("fantasyprotection.drop.bypass")){
				return true;
			}else{
			$event->setCancelled();
			$player->sendMessage($this->plugin->translateColors($prefix . " " . $message));
			}
		}
	}
	
	public function onLevelChange(EntityLevelChangeEvent $event){
		$player = $event->getEntity();
		$target = $event->getTarget()->getName();
		$close = $this->plugin->getConfig()->get("Close");
		$message = $this->plugin->getConfig()->get("Close-Message");
		if($player instanceof Player){
			if(in_array($target, $close)){
				if($player->hasPermission("fantasyprotection.close.bypass")){
					return true;	
				}else{
					$event->setCancelled();
					$player->sendMessage($this->plugin->translateColors($prefix . " " . $message));
				}
			}
		}
	}
	
	public function onHurt(EntityDamageEvent $event){
		$world = $player->getLevel()->getName();
		$damage = $this->plugin->getConfig()->get("Damage");
		if(in_array($world, $damage)){
			$event->setCancelled();
		}
		if($event->getEntity() instanceof Player && $event instanceof EntityDamageByEntityEvent) {
			if($event->getDamager() instanceof Player){
				$prefix = $this->plugin->getConfig()->get("Prefix");
				$message = $this->plugin->getConfig()->get("PVP-Message");
				$pvp = $this->plugin->getConfig()->get("PVP");
				$player = $event->getDamager();
				if(in_array($world, $pvp)){
					$event->getDamager()->sendMessage($this->plugin->translateColors($prefix . " " . $message));
					$event->setCancelled();
				}
			}
		}
	}
}
