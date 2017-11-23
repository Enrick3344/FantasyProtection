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
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
//Plugin File
use FantasyProtection\ProtectionCommand;


class Main extends PluginBase{
	
	public function onEnable(){
		@mkdir($this->getDataFolder());
        	$this->saveDefaultConfig();
		$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
		$this->loadCommand();
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
}
