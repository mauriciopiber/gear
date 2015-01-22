<?php
$dbAdapter = new Adapter(array(
    'driver' => 'Pdo_Sqlite',
    'database' => 'sqlite::memory:?cache=shared'
));
$config = $this->getServiceLocator()->get('config');
$file = $config['db'***REMOVED***['file'***REMOVED***;

try {
    $content = file_get_contents($file);
    $querys = explode(';', $content);
    foreach ($querys as $query) {
        $create = $dbAdapter->query($query);
        $createdDatabase = $create->execute();
    }
} catch (\PDOException $Exception) {
    // PHP Fatal Error. Second Argument Has To Be An Integer, But PDOException::getCode Returns A
    // String.
    var_dump($Exception);
}
