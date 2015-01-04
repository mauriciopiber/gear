#!/bin/bash
php ../../public/index.php gear unload Teste
php ../../public/index.php gear module delete Teste
php ../../public/index.php gear module-light create Teste
