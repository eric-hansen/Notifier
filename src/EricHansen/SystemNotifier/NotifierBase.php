<?php

namespace SystemNotifier;

abstract class NotifierBase {
    abstract public function __construct($args);

    abstract public function run();
} 