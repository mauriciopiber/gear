set -ex

MODULE=my-api-module
BASEPATH=/var/www/gear-package

php public/index.php gear schema delete $MODULE $BASEPATH
php public/index.php gear schema create $MODULE $BASEPATH


php public/index.php gear module src create \
  $MODULE \
  $BASEPATH \
  --name=FoodRepository \
  --namespace=Food\\Repository \
  --type=Repository \
  --extends=\\Gear\\Rest\\Repository\\AbstractRestRepository

php public/index.php gear module src create \
  $MODULE \
  $BASEPATH \
  --name=FoodService \
  --namespace=Food\\Service \
  --type=Service \
  --extends=\\Gear\\Rest\\Service\\AbstractRestService

php public/index.php gear module src create \
  $MODULE \
  $BASEPATH \
  --name=FoodFilter \
  --namespace=Food\\Filter \
  --type=Filter \
  --extends=\\Gear\\Rest\\Filter\\AbstractRestFilter

php public/index.php gear module controller create \
  $MODULE \
  $BASEPATH \
  --name=FoodController \
  --namespace=Food\\Controller \
  --type=Rest \
  --extends=\\Gear\\Rest\\Controller\\AbstractRestController

php public/index.php gear module activity create \
  $MODULE \
  $BASEPATH \
  FoodController \
  --name=Create

php public/index.php gear module activity create \
  $MODULE \
  $BASEPATH \
  FoodController \
  --name=Update
