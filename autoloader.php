<?php
function __autoload($class_name) {
    include '../models/' . $class_name . '.php';
}

