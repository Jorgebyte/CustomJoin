<?php

namespace YTJorge14\CustomJoin\Utils;

use pocketmine\player\Player;
use pocketmine\Server;

use pocketmine\world\Position;

use ReflectionClass;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;

class SoundsPM
{
    /**
     * Plays a sound for the specified player at their current position.
     *
     * @param Player $player The player to play the sound for.
     * @param string $sound The name of the sound to play.
     * @param int|float $volume The volume of the sound (default: 1).
     * @param float $pitch The pitch of the sound (default: 1).
     */
    public static function Sound(Player $player, string $sound, int $volume, float $pitch)
    {
        $packet = new PlaySoundPacket();
        $packet->x = $player->getPosition()->getX();
        $packet->y = $player->getPosition()->getY();
        $packet->z = $player->getPosition()->getZ();
        $packet->soundName = $sound;
        $packet->volume = $volume;
        $packet->pitch = $pitch;
        $player->getNetworkSession()->sendDataPacket($packet);
    }
}
