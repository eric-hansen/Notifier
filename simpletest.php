<?php
/**
 * Uncomment if not using Composer's auto-loader:
 *
 * @require_once "src/EricHansen/SystemNotifier/Notifier.php";
 */

// Load up the class and initialize it (nothing to do there)
$n = new \EricHansen\Notifier\Notifier();

// Only works if libnotify is installed on the system.  Otherwise, nothing will show.
$n->Notify(array("title" => "Test", "msg" => "Stupid"));