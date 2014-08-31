<?php
namespace SystemNotifier;

class Notifier {
    /**
     * @param $method string The notifier to load
     * @param $args array Any arguments to send to the notifier
     * @return bool Success or failure (true or false)
     */
    public function __call($method, $args){
        $file = dirname(__FILE__) . DIRECTORY_SEPARATOR . "notifiers" . DIRECTORY_SEPARATOR . $method . ".php";

        $notifier = null;

        // Only do something if the class file exists
        if(file_exists($file)){
            include_once $file;

            // Load the notifier and create a new class instance
            $notif_class = __NAMESPACE__ . "\\Notifiers\\" . $method;
            $notifier = new $notif_class($args);

            $notifier->run();

            return true;
        }

        return false;
    }
}

$n = new Notifier();

$n->Notify(array("title" => "Test", "msg" => "Yay"));