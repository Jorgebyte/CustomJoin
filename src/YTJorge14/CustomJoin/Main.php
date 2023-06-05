<?php

namespace YTJorge14\CustomJoin;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\Server;
# my class
use YTJorge14\CustomJoin\Utils\EventJoin;
use YTJorge14\CustomJoin\Utils\FormJoin;

class Main extends PluginBase
{
    #---------------------------
    /** @var Config $config */
    public Config $config;

    /** @var Main $instance */
    public static Main $instance;

    /**
     * The configuration file name.
     */
    public const CONFIG_FILE = 'config.yml';
    #---------------------------

    /**
     * @return Main
     */
    public static function getInstance(): Main
    {
        return self::$instance;
    }

    /**
     * @return void
     */
    public function onLoad(): void
    {
        self::$instance = $this;
    }

    /**
     * @return void
     */
    public function onEnable(): void
    {

        if (!$this->checkFormsUIDependency()) {
            $this->getLogger()->error("The FormsUI plugin is not installed. Make sure you have it in the 'plugins' folder. https://poggit.pmmp.io/r/209836/FormsUI_dev-20.phar");
            $this->getServer()->getPluginManager()->disablePlugin($this);
            return;
        }

        $this->loadFiles();
        $this->loadEvents();

    }
    /**
      * Checks if the FormsUI dependency is present.
      *
      * @return bool True if the dependency is present, false otherwise.
      */
    private function checkFormsUIDependency(): bool
    {
        return class_exists(\Vecnavium\FormsUI\FormsUI::class);
    }

    /**
     * @return void
     */
    public function loadFiles(): void
    {
        try {
            $this->saveResource(self::CONFIG_FILE);
            $this->config = new Config($this->getDataFolder() . self::CONFIG_FILE, Config::YAML);
        } catch (\Exception $e) {
            $this->getLogger()->error("Error loading files: " . $e->getMessage());
        }
    }

    /**
     * @return void
     */
    public function loadEvents(): void
    {
        $events = [
            EventJoin::class
        ];

        foreach ($events as $eventClass) {
            try {
                $event = new $eventClass($this);
                $this->getServer()->getPluginManager()->registerEvents($event, $this);
            } catch (\Exception $e) {
                $this->getLogger()->error("Error registering event: " . $e->getMessage());
            }
        }
    }

    /**
     * Get an instance of JoinForm.
     *
     * @return FormJoin An instance of JoinForm.
     */
    public static function joinForm(): FormJoin
    {
        return new FormJoin();
    }
}
