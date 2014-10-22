#!/bin/bash
php ./../../public/index.php gear module delete Admin

php ./../../public/index.php gear module create Admin

php ./../../public/index.php gear page create Admin --controllerPage=MyController --actionPage=MyAction --routePage=my-action --rolePage=guest --invokablePage="%s\Controller\My"
php ./../../public/index.php gear page create Admin --controllerPage=MySecondController --actionPage=MySecondAction --routePage=my-second-action --rolePage=guest --invokablePage="%s\Controller\MySecond"
php ./../../public/index.php gear page create Admin --controllerPage=MyController --actionPage=MergeAction --routePage=merge-action --rolePage=guest --invokablePage="%s\Controller\My"
php ./../../public/index.php gear page create Admin --controllerPage=MyController --actionPage=TwoMergeAction --routePage=two-merge-action --rolePage=guest --invokablePage="%s\Controller\My"
#cat ./../../module/Admin/config/ext/navigation.config.php
#echo ""
#cat ./../../module/Admin/config/ext/route.config.php

php ./../../public/index.php gear build Admin dev

#php ./../../public/index.php gear dump Admin --json
#php ./../../public/index.php gear dump Admin --array


#php ./../../public/index.php gear module delete Admin



#php ./../../public/index.php gear build Admin dev
#php ./../../public/index.php gear module delete Admin

#php ./../../public/index.php gear build Admin dev