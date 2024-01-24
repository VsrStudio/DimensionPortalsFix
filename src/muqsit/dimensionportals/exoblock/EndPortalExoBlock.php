<?php

declare(strict_types=1);

namespace muqsit\dimensionportals\exoblock;

use muqsit\dimensionportals\world\WorldInstance;
use muqsit\dimensionportals\world\WorldManager;
use pocketmine\block\Block;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;
use pocketmine\math\Facing;
use pocketmine\player\Player;

class EndPortalExoBlock extends PortalExoBlock{

	readonly private int $frame_block_id;
	readonly private int $portal_block_id;

	public function __construct(int $teleportation_duration, Block $frame_block, Block $portal_block){
		parent::__construct($teleportation_duration);
		$this->frame_block_id = $frame_block->getTypeId();
		$this->portal_block_id = $portal_block->getTypeId();
	}

	public function getTargetWorldInstance() : WorldInstance{
		return WorldManager::getEnd();
	}

	public function interact(Block $wrapping, Player $player, Item $item, int $face) : bool{
		return false;
	}

	public function update(Block $wrapping) : bool{
		foreach(Facing::HORIZONTAL as $side){
			$type_id = $wrapping->getSide($side)->getTypeId();
			if($type_id !== $this->frame_block_id && $type_id !== $this->portal_block_id){
				$pos = $wrapping->getPosition();
				$pos->getWorld()->setBlock($pos, VanillaBlocks::AIR());
				break;
			}
		}
		return false;
	}
}