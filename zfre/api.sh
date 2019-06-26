set -ex

MODULE=my-api-module
BASEPATH=/var/www/gear-package

#php public/index.php gear schema delete "$MODULE" "$BASEPATH"
#php public/index.php gear schema create "$MODULE" "$BASEPATH"
#cat ../gear-package/my-api-module/schema/module.json

#php public/index.php gear schema dump my-api-module /var/www/gear-package

php public/index.php gear module src create \
  "$MODULE" \
  "$BASEPATH" \
  --name=FoodRepository \
  --namespace=Food\\Repository \
  --type=Repository \
  --extends=\\Gear\\Rest\\Repository\\AbstractRestRepository


exit 0

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

cat ../gear-package/my-api-module/schema/module.json

php public/index.php gear schema dump my-api-module /var/www/gear-package

php public/index.php gear module activity create \
  $MODULE \
  $BASEPATH \
  FoodController \
  --name=Create \
  --controllerNamespace=Food\\Controller

php public/index.php gear module activity create \
  $MODULE \
  $BASEPATH \
  FoodController \
  --controllerNamespace=Food\\Controller \
  --name=Update

php public/index.php gear module activity create \
  $MODULE \
  $BASEPATH \
  FoodController \
  --controllerNamespace=Food\\Controller \
  --name=Delete

php public/index.php gear module activity create \
  $MODULE \
  $BASEPATH \
  FoodController \
  --controllerNamespace=Food\\Controller \
  --name=Get

php public/index.php gear module activity create \
  $MODULE \
  $BASEPATH \
  FoodController \
  --controllerNamespace=Food\\Controller \
  --name=GetList
