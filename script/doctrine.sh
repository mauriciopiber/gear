/var/www/gear-package/pbr-mvc-complete/vendor/bin/doctrine-module \
orm:convert-mapping \
--namespace="Entity\\" \
--force  \
--from-database \
annotation \
/var/www/gear-package/pbr-mvc-complete/src/

/var/www/gear-package/pbr-mvc-complete/vendor/bin/doctrine-module \
orm:generate-entities \
/var/www/gear-package/pbr-mvc-complete/src/ \
--generate-annotations=true

