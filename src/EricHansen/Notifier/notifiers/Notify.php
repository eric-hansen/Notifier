<?php
/**
 * This calls notify-send to display a notice for the user.
 */
namespace EricHansen\Notifier\Notifiers;

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'NotifierBase.php';

class Notify extends \EricHansen\Notifier\NotifierBase {
    /**
     * @param $args Array of arguments passed in via the Notifier::__call().
     */
    public function __construct($args){
        $args = isset($args[0]) ? $args[0] : array();

        $this->urgency = isset($args['urgency']) ? $args['urgency'] : null;
        $this->expire = isset($args['expire']) ? $args['expire'] : 5000;
        $this->app_name = isset($args['app_name']) ? $args['app_name'] : null;
        $this->icon = isset($args['icon']) ? $args['icon'] : null;
        $this->category = isset($args['category']) ? $args['category'] : null;
        $this->hint = isset($args['hint']) ? $args['hint'] : null;
        $this->title = isset($args['title']) ? $args['title'] : null;
        $this->body = isset($args['msg']) ? $args['msg'] : null;
    }

    /**
     * Executes the notification sending.  This is completely handled on a per-notifier basis as there
     * could be different procedures/checks/etc... when making it happen (i.e.: user-specific configurations).
     *
     * @return void
     */
    public function run(){
        exec(escapeshellcmd("notify-send".
            (($this->urgency !== null) ? " -u ". $this->urgency : "") .
            " -t " . $this->expire .
            (($this->app_name !== null) ? " -a ". $this->app_name : "") .
            (($this->icon !== null) ? " -i ". $this->icon : "") .
            (($this->category !== null) ? " -c " . $this->category : "") .
            (($this->hint !== null) ? " -h " . $this->hint : "") . " " . $this->title . " " . $this->body));
    }
} 