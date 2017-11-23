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

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\Player;
use pocketmine\level\Level;
//Plugins Files.
use FantasyProtection\Main;

class ProtectionCommand extends Command{
	
	/** @var Main */
    private $plugin;
    /**
     * @param Main $plugin
    */
    public function __construct(Main $plugin){
        parent::__construct("protection", "protect world with different feature", null, ["protect"]);
        $this->setPermission("fantasyprotection.command.protection");
        $this->plugin = $plugin;
	}
	
	public function execute(CommandSender $sender, string $label, array $args) : bool{
		if(isset($args[0])){
			switch($args[0]){
				case "placing":{
					if(count($args) == 2) {
						switch($args[1]){
							case "on":{
								$world = $sender->getLevel()->getName();
								$place = $this->plugin->getConfig()->get("Place");
								if(in_array($world, $place)){
									$level = $sender->getLevel()->getName();
									$array = $this->plugin->getConfig()->get("Place");
									$rm = $sender->getLevel()->getName();
									$config = [];
									foreach($array as $value) {
										if($value != $rm) {
											$config[] = $value;
										}
									}
									$this->plugin->getConfig()->set("Place", $config);
									$this->plugin->getConfig()->save();
									$sender->sendMessage("§r§f`•§5>§b You've sucessfully Toggled On Block Placing on Level " . $level);
								}else{
									$sender->sendMessage("§r§f`•§5>§c Block Placing Is Already Toggled On on This Level.");
								}	
							}
							break;
							case "off":{
								$world = $sender->getLevel()->getName();
								$place = $this->plugin->getConfig()->get("Place");
								if(in_array($world, $place)){
									$sender->sendMessage("§r§f`•§5>§c Block Placing Is Already Toggled Off On This Level.");
									break;
								}
								$level = $sender->getLevel()->getName();
								$array = $this->plugin->getConfig()->get("Place");
								$config = $array;
								$config[] = $sender->getLevel()->getName();
								$this->plugin->getConfig()->set("Place", $config);
								$this->plugin->getConfig()->save();
								$sender->sendMessage("§r§f`•§5>§b You've sucessfully Toggled Off Block Placing on Level " . $level);
							}
							break;
						}
						return true;
					}else{
						$sender->sendMessage("§r§f`•§l§dUsage§5>§r§b /protect <breaking|placing|hunger|locked|damage|pvp|dropping> <on|off>");
						return false;
					}
				}
				break;
				case "breaking":{
					if(count($args) == 2) {
						switch($args[1]){
							case "on":{
								$world = $sender->getLevel()->getName();
								$break = $this->plugin->getConfig()->get("Break");
							
								if(in_array($world, $break)){
									$level = $sender->getLevel()->getName();
									$array = $this->plugin->getConfig()->get("Break");
									$rm = $sender->getLevel()->getName();
									$config = [];
									foreach($array as $value) {
										if($value != $rm) {
											$config[] = $value;
										}
									}
									$this->plugin->getConfig()->set("Break", $config);
									$this->plugin->getConfig()->save();
									$sender->sendMessage("§r§f`•§5>§b You've sucessfully Toggled On Block Breaking on Level " . $level);
								}else{
									$sender->sendMessage("§r§f`•§5>§c Block Breaking Is Already Toggled On on This Level.");
								}
							}
							break;
							case "off":{
								$world = $sender->getLevel()->getName();
								$break = $this->plugin->getConfig()->get("Break");
								if(in_array($world, $break)){
									$sender->sendMessage("§r§f`•§5>§c Block Breaking Is Already Toggled Off On This Level.");
									break;
								}
								$level = $sender->getLevel()->getName();
								$array = $this->plugin->getConfig()->get("Break");
								$config = $array;
								$config[] = $sender->getLevel()->getName();
								$this->plugin->getConfig()->set("Break", $config);
								$this->plugin->getConfig()->save();
								$sender->sendMessage("§r§f`•§5>§b You've sucessfully Toggled Off Block Breaking on Level " . $level);
							}
							break;
						}
						return true;
					}else{
						$sender->sendMessage("§r§f`•§l§dUsage§5>§r§b /protect <breaking|placing|hunger|locked|damage|pvp|dropping> <on|off>");
						return false;	
					}
				}
				break;
				case "hunger":{
					if(count($args) == 2) {
						switch($args[1]){
							case "on":{
								$world = $sender->getLevel()->getName();
								$hunger = $this->plugin->getConfig()->get("Hunger");
							
								if(in_array($world, $hunger)){
									$level = $sender->getLevel()->getName();
									$array = $this->plugin->getConfig()->get("Place");
									$rm = $sender->getLevel()->getName();
									$config = [];
									foreach($array as $value) {
										if($value != $rm) {
											$config[] = $value;
										}
									}
									$this->plugin->getConfig()->set("Hunger", $config);
									$this->plugin->getConfig()->save();
									$sender->sendMessage("§r§f`•§5>§b You've sucessfully Toggled On Hunger on Level " . $level);
								}else{
									$sender->sendMessage("§r§f`•§5>§c Hunger Is Already Toggled On on This Level.");
								}
							}
							break;
							case "off":{
								$world = $sender->getLevel()->getName();
								$hunger = $this->plugin->getConfig()->get("Hunger");
								if(in_array($world, $hunger)){
									$sender->sendMessage("§r§f`•§5>§c Hunger Is Already Toggled Off On This Level.");
									break;
								}
								$level = $sender->getLevel()->getName();
								$array = $this->plugin->getConfig()->get("Hunger");
								$config = $array;
								$config[] = $sender->getLevel()->getName();
								$this->plugin->getConfig()->set("Hunger", $config);
								$this->plugin->getConfig()->save();
								$sender->sendMessage("§r§f`•§5>§b You've sucessfully Toggled Off Hunger on Level " . $level);
							}
							break;
						}
						return true;
					}else{
						$sender->sendMessage("§r§f`•§l§dUsage§5>§r§b /protect <breaking|placing|hunger|locked|damage|pvp|dropping> <on|off>");
						return false;
					}
				}
				break;
				case "dropping":{
					if(count($args) == 2) {
						switch($args[1]){
							case "on":{
								$world = $sender->getLevel()->getName();
								$drop = $this->plugin->getConfig()->get("Drop");
							
								if(in_array($world, $drop)){
									$level = $sender->getLevel()->getName();
									$array = $this->plugin->getConfig()->get("Drop");
									$rm = $sender->getLevel()->getName();
									$config = [];
									foreach($array as $value) {
										if($value != $rm) {
											$config[] = $value;
										}
									}
									$this->plugin->getConfig()->set("Drop", $config);
									$this->plugin->getConfig()->save();
									$sender->sendMessage("§r§f`•§5>§b You've sucessfully Toggled On items Dropping on Level " . $level);
								}else{
									$sender->sendMessage("§r§f`•§5>§c Items Dropping Is Already Toggled On on This Level.");
								}
							}
							break;
							case "off":{
								$world = $sender->getLevel()->getName();
								$drop = $this->plugin->getConfig()->get("Drop");
							
								if(in_array($world, $drop)){
									$sender->sendMessage("§r§f`•§5>§c Items Dropping Is Already Toggled Off On This Level.");
									break;
								}
								$level = $sender->getLevel()->getName();
								$array = $this->plugin->getConfig()->get("Drop");
								$config = $array;
								$config[] = $sender->getLevel()->getName();
								$this->plugin->getConfig()->set("Drop", $config);
								$this->plugin->getConfig()->save();
								$sender->sendMessage("§r§f`•§5>§d You've sucessfully Toggled Off Drop on Level " . $level);
							}
							break;
						}
						return true;
					}else{
						$sender->sendMessage("§r§f`•§l§dUsage§5>§r§b /protect <breaking|placing|hunger|locked|damage|pvp|dropping> <on|off>");
						return false;
					}
				}
				break;
				case "locked":{
					if(count($args) == 2) {
						switch($args[1]){
							case "on":{
								$world = $sender->getLevel()->getName();
								$lock = $this->plugin->getConfig()->get("Lock");
								if(in_array($world, $lock)){
									$sender->sendMessage("§r§f`•§5>§c Level ".$level." Is Already Locked!");
									break;
								}
								$level = $sender->getLevel()->getName();
								$array = $this->plugin->getConfig()->get("Lock");
								$config = $array;
								$config[] = $sender->getLevel()->getName();
								$this->plugin->getConfig()->set("Lock", $config);
								$this->plugin->getConfig()->save();
								$sender->sendMessage("§r§f`•§5>§b You've sucessfully Locked Level " . $level);
							}
							break;
							case "off":{
								if(!$sender instanceof Player){
									$sender->sendMessage("§r§f`•§5>§c Please run this command in-game.");
									break;
								}
								$world = $sender->getLevel()->getName();
								$lock = $this->plugin->getConfig()->get("Lock");
								if(in_array($world, $lock)){
									$level = $sender->getLevel()->getName();
									$array = $this->plugin->getConfig()->get("Lock");
									$rm = $sender->getLevel()->getName();
									$config = [];
									foreach($array as $value) {
										if($value != $rm) {
											$config[] = $value;
										}
									}
									$this->plugin->getConfig()->set("Lock", $config);
									$this->plugin->getConfig()->save();
									$sender->sendMessage(§r§f`•"§5>§b You've sucessfully Unlocked Level " . $level);
								}else{
									$sender->sendMessage("§r§f`•§5>§c Level ".$level." Was not Locked!");
								}
							}
							break;
						}
						return true;
					}else{
						$sender->sendMessage("§r§f`•§l§dUsage§5>§r§b /protect <breaking|placing|hunger|locked|damage|pvp|dropping> <on|off>");
						return false;
					}
				}
				break;
				case "pvp":{
					if(count($args) == 2) {
						switch($args[1]){
							case "on":{
								$world = $sender->getLevel()->getName();
								$pvp = $this->plugin->getConfig()->get("PVP");
								if(in_array($world, $pvp)){
									$level = $sender->getLevel()->getName();
									$array = $this->plugin->getConfig()->get("PVP");
									$rm = $sender->getLevel()->getName();
									$config = [];
									foreach($array as $value) {
										if($value != $rm) {
											$config[] = $value;
										}
									}
									$this->plugin->getConfig()->set("PVP", $config);
									$this->plugin->getConfig()->save();
									$sender->sendMessage("§r§f`•§5>§d You've sucessfully Toggled On  PVP on Level " . $level);
								}else{
									$sender->sendMessage("§r§f`•§5>§c PVP Is Already Toggled On on This Level.");
								}
							}
							break;
							case "off":{
								$world = $sender->getLevel()->getName();
								$pvp = $this->plugin->getConfig()->get("PVP");
							
								if(in_array($world, $pvp)){
									$sender->sendMessage("§r§f`•§5>§c PVP Is Already Toggled Off On This Level.");
									break;
								}
								$level = $sender->getLevel()->getName();
								$array = $this->plugin->getConfig()->get("PVP");
								$config = $array;
								$config[] = $sender->getLevel()->getName();
								$this->plugin->getConfig()->set("PVP", $config);
								$this->plugin->getConfig()->save();
								$sender->sendMessage("§r§f`•§5>§d You've sucessfully Toggled Off PVP on Level " . $level);
			    
							}
							break;
						}
						return true;
					}else{
						$sender->sendMessage("§r§f`•§l§dUsage§5>§r§b /protect <breaking|placing|hunger|locked|damage|pvp|dropping> <on|off>");
						return false;
					}
				}
				break;
				case "damage":{
					if(count($args) == 2) {
						switch($args[1]){
							case "on":{
								$world = $sender->getLevel()->getName();
								$god = $this->plugin->getConfig()->get("Damage");
								if(in_array($world, $god)){
									$level = $sender->getLevel()->getName();
									$array = $this->plugin->getConfig()->get("Damage");
									$rm = $sender->getLevel()->getName();
									$config = [];
									foreach($array as $value) {
										if($value != $rm) {
											$config[] = $value;
										}
									}
									$this->plugin->getConfig()->set("Damage", $config);
									$this->plugin->getConfig()->save();
									$sender->sendMessage("§r§f`•§5>§d You've sucessfully Toggled Off Damage on Level " . $level);
								}else{
									$sender->sendMessage("§r§f`•§5>§c Damages Are Already Toggled Off On This Level.");
								}
							}
							break;
							case "off":{
								$world = $sender->getLevel()->getName();
								$god = $this->plugin->getConfig()->get("Damage");
								if(in_array($world, $god)){
									$sender->sendMessage("§r§f`•§5>§c Damages Are Already Toggled On on This Level.");
									break;
								}
								$level = $sender->getLevel()->getName();
								$array = $this->plugin->getConfig()->get("Damage");
								$config = $array;
								$config[] = $sender->getLevel()->getName();
								$this->plugin->getConfig()->set("Damage", $config);
								$this->plugin->getConfig()->save();
								$sender->sendMessage("§r§f`•§5>§d You've sucessfully Toggled On Damage on Level " . $level);
							}
							break;
						}
						return true;
					}else{
						$sender->sendMessage("§r§f`•§l§dUsage§5>§r§b /protect <breaking|placing|hunger|locked|damage|pvp|dropping> <on|off>");
						return false;
					}
				}
				break;
			}
			return true;
		}else{
			$sender->sendMessage("§r§f`•§l§dUsage§5>§r§b /protect <breaking|placing|hunger|locked|damage|pvp|dropping> <on|off>");
			return false;
		}
	}
}			
