<?php

$env = new \Gear\Env\Env();

return [
  'database' => $env->getName(),
  'host' => $env->getHost(),
  'user' => $env->getUser(),
  'pass' => $env->getPass()
***REMOVED***;
