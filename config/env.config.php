<?php
$env = getenv('PHINX_ENVIRONMENT');
$environments = [
  'DEVELOPMENT',
  'TESTING'
***REMOVED***;

if (!in_array($env, $environments)) {
  throw new Exception(
    sprintf(
      'Missing valid PHINX_ENVIRONMENT, "%s", must be "%s"',
      $env,
      implode($environments, ', '))
  );
}

if ($env === $environments[0***REMOVED***) { //develop
  return [
    'database' => 'gear',
    'host' => 'mysql',
    'user' => 'root',
    'pass' => 'gear'
  ***REMOVED***;
}


if ($env === $environments[1***REMOVED***) { //testing
  return [
    'database' => 'gear',
    'host' => 'localhost',
    'user' => 'root',
    'pass' => 'gear'
  ***REMOVED***;
}
