<?php

require_once
    __DIR__ . DIRECTORY_SEPARATOR .
    'vendor' . DIRECTORY_SEPARATOR .
    'autoload.php';

Hoa\Core::getInstance()->setProtocol('hoa://Application', __DIR__ . DS);
