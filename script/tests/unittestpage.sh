#!/bin/bash
php ./../../public/index.php gear module delete Admin
php ./../../public/index.php gear module create Admin
php ./../../public/index.php gear page create Admin --controllerPage=MyController --actionPage=MyAction --routePage=my-action --rolePage=guest
#php ./../../public/index.php gear build Admin dev
#php ./../../public/index.php gear module delete Admin
#php ./../../public/index.php gear page create Admin --controllerPage=MySecondController --actionPage=MySecondAction --routePage=my-second-action --rolePage=guest
#php ./../../public/index.php gear page create Admin --controllerPage=MyController --actionPage=MergeAction --routePage=merge-action --rolePage=guest
#php ./../../public/index.php gear build Admin dev