<?php
/*
 *   FactionsPE: PocketMine-MP Plugin
 *   Copyright (C) 2016  Chris Prime
 *
 *   This program is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   This program is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace factions\command;

use dominate\Command;
use localizer\Localizer;

use factions\manager\Members;
use factions\command\requirement\FactionRequirement;

use pocketmine\command\CommandSender;

class LeaveFaction extends Command {

	public function setup() {
		$this->addRequirement(new FactionRequirement(FactionRequirement::IN_FACTION));
	}

	public function execute(CommandSender $sender, $label, array $args) : bool {
		if(!parent::execute($sender, $label, $args)) return false;

		$member = Members::get($sender);
		$faction = $member->getFaction();
		if($faction->leave($member)) {
			$sender->sendMessage(Localizer::translatable('you-left-faction', [
				"faction" => $faction->getName(),
				]));
		}		

		return true;
	}

}