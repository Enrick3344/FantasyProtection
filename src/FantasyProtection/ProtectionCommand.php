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
				case "disable":{
                    if(count($args) == 2) {
						if($args[1] == "place") {  //PLACE
							if(!$sender instanceof Player){
								$sender->sendMessage("§5>§c Please run this command in-game.");
								break;
							}
							$world = $sender->getLevel()->getName();
							$place = $this->plugin->getConfig()->get("Place");
							
							if(in_array($world, $place)){
								$sender->sendMessage("§5>§c Block Placing Is Already Disabled On This Level.");
								break;
							}
								$level = $sender->getLevel()->getName();
								$array = $this->plugin->getConfig()->get("Place");
								$config = $array;
								$config[] = $sender->getLevel()->getName();
								$this->plugin->getConfig()->set("Place", $config);
								$this->plugin->getConfig()->save();
								$sender->sendMessage("§5>§d You've sucessfully Disabled Block Placing on Level " . $level);
						///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
						}elseif($args[1] == "break"){  //BREAK
							if(!$sender instanceof Player){
								$sender->sendMessage("§5>§c Please run this command in-game.");
								break;
							}
							$world = $sender->getLevel()->getName();
							$break = $this->plugin->getConfig()->get("Break");
							
							if(in_array($world, $break)){
								$sender->sendMessage("§5>§c Block Breaking Is Already Disabled On This Level.");
								break;
							}
								$level = $sender->getLevel()->getName();
								$array = $this->plugin->getConfig()->get("Break");
								$config = $array;
								$config[] = $sender->getLevel()->getName();
								$this->plugin->getConfig()->set("Break", $config);
								$this->plugin->getConfig()->save();
								$sender->sendMessage("§5>§d You've sucessfully Disabled Block Breaking on Level " . $level);
						///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////			
						}elseif($args[1] == "hunger"){  //HUNGER
							if(!$sender instanceof Player){
								$sender->sendMessage("§5>§c Please run this command in-game.");
								break;
							}
							$world = $sender->getLevel()->getName();
							$hunger = $this->plugin->getConfig()->get("Hunger");
							
							if(in_array($world, $hunger)){
								$sender->sendMessage("§5>§c Hunger Is Already Disabled On This Level.");
								break;
							}
								$level = $sender->getLevel()->getName();
								$array = $this->plugin->getConfig()->get("Hunger");
								$config = $array;
								$config[] = $sender->getLevel()->getName();
								$this->plugin->getConfig()->set("Hunger", $config);
								$this->plugin->getConfig()->save();
								$sender->sendMessage("§5>§d You've sucessfully Disabled Hunger on Level " . $level);
						///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////			
						}elseif($args[1] == "drop"){  //DROP
							if(!$sender instanceof Player){
								$sender->sendMessage("§5>§c Please run this command in-game.");
								break;
							}
							$world = $sender->getLevel()->getName();
							$drop = $this->plugin->getConfig()->get("Drop");
							
							if(in_array($world, $drop)){
								$sender->sendMessage("§5>§c Items Dropping Is Already Disabled On This Level.");
								break;
							}
								$level = $sender->getLevel()->getName();
								$array = $this->plugin->getConfig()->get("Drop");
								$config = $array;
								$config[] = $sender->getLevel()->getName();
								$this->plugin->getConfig()->set("Drop", $config);
								$this->plugin->getConfig()->save();
								$sender->sendMessage("§5>§d You've sucessfully Disabled Drop on Level " . $level);
						///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
						}elseif($args[1] == "lock") {  //LOCK
							if(!$sender instanceof Player){
								$sender->sendMessage("§5>§c Please run this command in-game.");
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
								$sender->sendMessage("§5>§d You've sucessfully Disabled Lock on Level " . $level);
							}else{
								$sender->sendMessage("§5>§c Lock Is Already Disabled On This Level.");
							}
						///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
						}elseif($args[1] == "god") {  //GOD
							if(!$sender instanceof Player){
								$sender->sendMessage("§5>§c Please run this command in-game.");
								break;
							}
							$world = $sender->getLevel()->getName();
							$god = $this->plugin->getConfig()->get("God");
							if(in_array($world, $god)){
								$level = $sender->getLevel()->getName();
								$array = $this->plugin->getConfig()->get("God");
								$rm = $sender->getLevel()->getName();
								$config = [];
								foreach($array as $value) {
									if($value != $rm) {
										$config[] = $value;
									}
								}
								$this->plugin->getConfig()->set("God", $config);
								$this->plugin->getConfig()->save();
								$sender->sendMessage("§5>§d You've sucessfully Disabled God on Level " . $level);
							}else{
								$sender->sendMessage("§5>§c God Is Already Disabled On This Level.");
							}
						///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
						}elseif($args[1] == "pvp") {  //PVP
							if(!$sender instanceof Player){
								$sender->sendMessage("§5>§c Please run this command in-game.");
								break;
							}
							$world = $sender->getLevel()->getName();
							$pvp = $this->plugin->getConfig()->get("PVP");
							
							if(in_array($world, $pvp)){
								$sender->sendMessage("§5>§c PVP Is Already Disabled On This Level.");
								break;
							}
								$level = $sender->getLevel()->getName();
								$array = $this->plugin->getConfig()->get("PVP");
								$config = $array;
								$config[] = $sender->getLevel()->getName();
								$this->plugin->getConfig()->set("PVP", $config);
								$this->plugin->getConfig()->save();
								$sender->sendMessage("§5>§d You've sucessfully Disabled PVP on Level " . $level);
			    
						}else{
							$sender->sendMessage("§l§dUsage§5>§r§b /protect <enable|disable> <drop|god|hunger|place|pvp|break>");
							return false;
						}
					return true;
				}else{
					$sender->sendMessage("§l§dUsage§5>§r§b /protect <enable|disable> <drop|god|hunger|place|pvp|break>");
					return false;
				}
			}
			break;
			///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
			//Enable
				case "enable": {
					if(count($args) == 2) {
						if($args[1] == "place") {  //PLACE
							if(!$sender instanceof Player){
								$sender->sendMessage("§5>§c Please run this command in-game.");
								break;
							}
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
								$sender->sendMessage("§5>§d You've sucessfully Enabled Block Placing on Level " . $level);
							}else{
								$sender->sendMessage("§5>§c Block Placing Is Already Enabled On This Level.");
							}
					///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
					}elseif($args[1] == "break"){  //BREAK
							if(!$sender instanceof Player){
								$sender->sendMessage("§5>§c Please run this command in-game.");
								break;
							}	
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
								$sender->sendMessage("§5>§d You've sucessfully Enabled Block Breaking on Level " . $level);
							}else{
								$sender->sendMessage("§5>§c Block Breaking Is Already Enabled On This Level.");
							}
					///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
					}elseif($args[1] == "hunger"){  //HUNGER 
							if(!$sender instanceof Player){
								$sender->sendMessage("§5>§c Please run this command in-game.");
								break;
							}	
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
								$sender->sendMessage("§5>§d You've sucessfully Enabled Hunger on Level " . $level);
							}else{
								$sender->sendMessage("§5>§c Hunger Is Already Enabled On This Level.");
							}
					///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
					}elseif($args[1] == "drop"){  //DROP
							
							if(!$sender instanceof Player){
								$sender->sendMessage("§5>§c Please run this command in-game.");
								break;
							}	
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
								$sender->sendMessage("§5>§d You've sucessfully Enabled items Dropping on Level " . $level);
							}else{
								$sender->sendMessage("§5>§c Items Dropping Is Already Enabled On This Level.");
							}
					///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
					}elseif($args[1] == "lock"){  //LOCK
							if(!$sender instanceof Player){
								$sender->sendMessage("§5>§c Please run this command in-game.");
								break;
							}
							$world = $sender->getLevel()->getName();
							$lock = $this->plugin->getConfig()->get("Lock");
							if(in_array($world, $lock)){
								$sender->sendMessage("§5>§c Lock Is Already Enabled On This Level.");
								break;
							}
								$level = $sender->getLevel()->getName();
								$array = $this->plugin->getConfig()->get("Lock");
								$config = $array;
								$config[] = $sender->getLevel()->getName();
								$this->plugin->getConfig()->set("Lock", $config);
								$this->plugin->getConfig()->save();
								$sender->sendMessage("§5>§d You've sucessfully Enabled Lock on Level " . $level);
					///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////					
					}elseif($args[1] == "god"){  //GOD
							if(!$sender instanceof Player){
								$sender->sendMessage("§5>§c Please run this command in-game.");
								break;
							}
							$world = $sender->getLevel()->getName();
							$god = $this->plugin->getConfig()->get("God");
							if(in_array($world, $god)){
								$sender->sendMessage("§5>§c God Is Already Enabled On This Level.");
								break;
							}
								$level = $sender->getLevel()->getName();
								$array = $this->plugin->getConfig()->get("God");
								$config = $array;
								$config[] = $sender->getLevel()->getName();
								$this->plugin->getConfig()->set("God", $config);
								$this->plugin->getConfig()->save();
								$sender->sendMessage("§5>§d You've sucessfully Enabled God on Level " . $level);
					///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
					}elseif($args[1] == "pvp"){  //PVP
					
							if(!$sender instanceof Player){
								$sender->sendMessage("§5>§c Please run this command in-game.");
								break;
							}	
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
								$sender->sendMessage("§5>§d You've sucessfully Enabled PVP on Level " . $level);
							}else{
								$sender->sendMessage("§5>§c PVP Is Already Enabled On This Level.");
							}
						}
					}else{
							$sender->sendMessage("§l§dUsage§5>§r§b /protect <enable|disable> <drop|god|hunger|place|lock|pvp|break>");
							return false;
						}
				}
				break;
			}
		}else{
			$sender->sendMessage("§l§dUsage§5>§r§b /protect <enable|disable> <drop|god|hunger|place|lock|pvp|break>");
			return false;
		}
		return true;
	}
}	
