<?php
namespace EricHansen\Notifier;

class Notifier {
    /**
     * @param $method string The notifier to load
     * @param $args array Any arguments to send to the notifier
     * @return bool Success or failure (true or false)
     */
    public function __call($method, $args){
        $file = dirname(__FILE__) . DIRECTORY_SEPARATOR . "notifiers" . DIRECTORY_SEPARATOR . $method . ".php";

        $notifier = null;

        // Load the notifier and create a new class instance
        $notif_class = __NAMESPACE__ . "\\Notifiers\\" . $method;

        // Only load the file if it exists but the class doesn't exist
        if(!class_exists($notif_class) && file_exists($file)) {
            require $file;
        }

        // If the class is loaded, create a new instance and run it
        if(class_exists($notif_class)){
            $notifier = new $notif_class($args);

            $res = $notifier->run();

            // Return true by default or the status of the run() call if it returns anything
            return (!is_null($res) ? $res : true);
        }

        return false;
    }
}

/**
 * Simple example of how to use:
 *
 * $n = new Notifier();
 *
 * $n->Notify(array("title" => "Test", "msg" => "Yay"));
 */