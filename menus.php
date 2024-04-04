<?php

/** @var \Modules\Base\Classes\Fetch\Menus $this */

$this->add_module_info("subscription", [
    'title' => 'Subscription',
    'description' => 'Subscription',
    'icon' => 'fas fa-people-arrows',
    'path' => '/subscription/admin/subscription',
    'class_str' => 'text-primary border-primary',
    'position' => 1,
]);

//$this->add_menu("module", "key", "title","path", "icon", "position");
$this->add_menu("subscription", "subscription", "Subscription", "/subscription/admin/subscription", "fas fa-cogs", 1);
$this->add_menu("subscription", "package", "Package", "/subscription/admin/package", "fas fa-cogs", 1);

