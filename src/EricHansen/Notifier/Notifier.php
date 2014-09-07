<?php
namespace EricHansen\Notifier;

class Notifier {
    /**
     * @param mixed $notifiers_path If given, uses this path to load up notifier classes (defaults ./notifiers)
     */
    public function __construct($notifiers_path=null){
        if(!$notifiers_path) {
            $this->notifiers_path = dirname(__FILE__) . DIRECTORY_SEPARATOR . "notifiers" . DIRECTORY_SEPARATOR;
        } else {
            $this->notifiers_path = $notifiers_path;
        }
    }

    /**
     * Returns a list of all the notifiers detected (must extended NotifierBase to be detected)
     *
     * @return array An array of valid notifiers that were detected
     */
    public function getAllNotifiers(){
        $content = scandir($this->notifiers_path);

        $notifiers = array();

        foreach($content as $file){
            if($file[0] == ".")
                continue;

            $clsname = basename($file, ".php");

            if(!class_exists($clsname))
                @require_once $this->notifiers_path . $file;


            $tmp = new \ReflectionClass(__NAMESPACE__ . "\\Notifiers\\" . $clsname);

            if($tmp->isSubclassOf(__NAMESPACE__ . "\\NotifierBase"))
                $notifiers[] = $clsname;

            unset($clsname);
        }

        return $notifiers;
    }

    /**
     * @param $method string The notifier to load
     * @param $args array Any arguments to send to the notifier
     * @return bool Success or failure (true or false)
     */
    public function __call($method, $args){
        $file = $this->notifiers_path . $method . ".php";

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