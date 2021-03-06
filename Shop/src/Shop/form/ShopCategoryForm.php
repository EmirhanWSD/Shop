<?php

namespace Shop\form;

use pocketmine\form\FormIcon;
use pocketmine\form\MenuForm;
use pocketmine\form\MenuOption;
use pocketmine\Player;
use Shop\Shop;

class ShopCategoryForm extends MenuForm {

    public function __construct() {
        $settingConfig = Shop::getInstance()->getSettingConfig();
        $itemConfig = Shop::getInstance()->getItemConfig();
        $title = $settingConfig->get("form-title");
        $options = [];
        foreach ($itemConfig->get("categories") as $category) {
            $icon = new FormIcon($category["category-icon"], $category["path"] === "path" ? FormIcon::IMAGE_TYPE_PATH : FormIcon::IMAGE_TYPE_URL);
            $options[] = new MenuOption($category["category-title"], $icon);
        }
        parent::__construct($title, "", $options, function (Player $player, int $selectedOption): void {
            $category = $this->getOption($selectedOption)->getText();
            $player->sendForm(new ShopCategoryItemForm($player, $category));
        });
    }
}
