<?php

namespace YTJorge14\CustomJoin\Utils;

use pocketmine\event\Listener;

use pocketmine\event\player\{PlayerJoinEvent, PlayerQuitEvent};

use YTJorge14\CustomJoin\Main;

class EventJoin implements Listener
{
    public Main $plugin;

    public function __construct(Main $plugin)
    {
        $this->plugin = $plugin;
    }

    /**
     * @param PlayerJoinEvent $event The player join event.
     * @return void
     */
    public function onJoin(PlayerJoinEvent $event): void
    {
        $player = $event->getPlayer();
        $name = $player->getName();
        $msg = str_replace(["{nick}"], [$name], $this->plugin->config->getNested("custom-join-msg"));
        # text that is sent when a player enters.
        $event->setJoinMessage($msg);
        # Join form
        Main::joinForm()->openJoinForm($player);

    }

    /**
     * @param PlayerQuitEvent $event The player quit event.
     * @return void
     */
    public function onQuit(PlayerQuitEvent $event): void
    {
        $player = $event->getPlayer();
        $name = $player->getName();
        $msg = str_replace(["{nick}"], [$name], $this->plugin->config->getNested("custom-quit-msg"));
        # text that is sent when a player leaves.
        $event->setQuitMessage($msg);
    }
}
