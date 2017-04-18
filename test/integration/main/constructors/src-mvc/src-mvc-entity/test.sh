#!/bin/bash

set -e

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrSrcMvcEntity"
type="web"

construct=()
construct[1***REMOVED***="gear-entity.yml;20160123222001_entity_database.php"
construct[2***REMOVED***="gear-entity-columns.yml;20160123222002_columns_database.php"
construct[3***REMOVED***="gear-entity-uploadimage.yml;20160123222003_upload_image_database.php"
construct[3***REMOVED***="gear-entity-full.yml;20160123222004_full_database.php"

source "$bin/gear/module/test-module.sh"
