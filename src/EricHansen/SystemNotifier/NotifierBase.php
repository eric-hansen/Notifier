<?php

namespace EricHansen\Notifier;

abstract class NotifierBase {
    abstract public function __construct($args);

    abstract public function run();
} 