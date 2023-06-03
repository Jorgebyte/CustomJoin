<?php

namespace YTJorge14\CustomJoin\Utils;

use pocketmine\Server;
use pocketmine\player\Player;
#---------------------------------

use YTJorge14\CustomJoin\Forms\SimpleForm;

use YTJorge14\CustomJoin\Main;
use YTJorge14\CustomJoin\Utils\SoundsPM;

#---------------------------------

class FormJoin
{
    public $plugin;

    public function __construct()
    {
        $this->plugin = Main::getInstance();
    }
    /**
     * Open the join form for the player.
     *
     * @param Player $player The player to open the form for.
     *
     */
    public function openJoinForm($player)
    {
        $form = new SimpleForm(function (Player $player, int $data = null) {
            if($data === null) {
                return true;
            }
            switch($data) {
                case 0:
                    SoundsPM::Sound($player, $this->plugin->config->getNested("sound-button"), 1, 1);
                    $player->sendMessage($this->plugin->config->getNested("message-button"));
                    $player->sendTitle($this->plugin->config->getNested("title-button"));
                    break;
            }
            return true;
        });
        $form->setTitle($this->plugin->config->getNested("title-form"));
        $form->setContent($this->plugin->config->getNested("content-form"));
        $form->addButton($this->plugin->config->getNested("close-button"));
        $form->sendToPlayer($player);
    }

}
