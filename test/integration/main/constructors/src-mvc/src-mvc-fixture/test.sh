#!/bin/bash

set -e

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrSrcMvcFixture"
type="web"
build=${2}

construct=()
construct[0***REMOVED***="../src-mvc-entity/gear-entity.yml;../src-mvc-entity/20160123222001_entity_database.php"
construct[1***REMOVED***="../src-mvc-entity/gear-entity-columns.yml;../src-mvc-entity/20160123222002_columns_database.php"
construct[2***REMOVED***="../src-mvc-entity/gear-entity-uploadimage.yml;../src-mvc-entity/20160123222003_upload_image_database.php"
construct[3***REMOVED***="../src-mvc-entity/gear-entity-full.yml;../src-mvc-entity/20160123222004_full_database.php"
construct[4***REMOVED***="gear-fixture.yml"

source "$bin/gear/module/test-module.sh"
