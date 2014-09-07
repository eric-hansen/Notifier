<?php
if(file_exists('vendor/autoload.php'))
    @require_once 'vendor/autoload.php';
else
    @require_once "src/EricHansen/Notifier/Notifier.php";

// Load up the class and initialize it (nothing to do there)
$n = new \EricHansen\Notifier\Notifier();

foreach($n->getAllNotifiers() as $notifier){
    $n->$notifier(array("title" => "Test", "msg" => "Works!"));
    sleep(5);
}