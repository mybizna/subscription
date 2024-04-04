<?php

/** @var \Modules\Base\Classes\Fetch\Rights $this */

$this->add_right("subscription", "subscription", "administrator", view:true, add:true, edit:true, delete:true);
$this->add_right("subscription", "subscription", "manager", view:true, add:true, edit:true, delete:true);
$this->add_right("subscription", "subscription", "supervisor", view:true, add:true, edit:true, delete:true);
$this->add_right("subscription", "subscription", "staff", view:true, add:true, edit:true);
$this->add_right("subscription", "subscription", "registered", view:true, add:true);
$this->add_right("subscription", "subscription", "guest", view:true, );

$this->add_right("subscription", "package", "administrator", view:true, add:true, edit:true, delete:true);
$this->add_right("subscription", "package", "manager", view:true, add:true, edit:true, delete:true);
$this->add_right("subscription", "package", "supervisor", view:true, add:true, edit:true, delete:true);
$this->add_right("subscription", "package", "staff", view:true, add:true, edit:true);
$this->add_right("subscription", "package", "registered", view:true, add:true);
$this->add_right("subscription", "package", "guest", view:true, );
