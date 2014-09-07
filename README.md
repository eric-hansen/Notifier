Notifier
========

Wrapper of sorts for various notify systems, mainly useful for CLI scripts in PHP

## Why?

Mainly because I was bored, and I wanted to better grasp some of the OOP and advanced PHP techniques.  Plus, I find it useful to show notifications for some stuff.

## To Do

* Possibly build more notifiers but who knows...  I only really use notify-send.
* Make the argument passing a bit more dynamic (this is where keyword arguments like in Python would be handy)

## How To Extend

The ```src/EricHansen/SystemNotifier/notifiers/Notify.php``` file gives a good example of what's involved.  All that needs to be done really is:

* Extend the \EricHansen\SystemNotifier\NotiferBase abstract class
* Handle the arguments passed in __construct()
* Do any formatting and such in run()
* Optionally return the status of the command in run()