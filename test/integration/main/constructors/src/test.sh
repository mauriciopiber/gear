#!/bin/bash

set -e

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrSrc"
type="web"
construct=()
construct[1***REMOVED***="src-interface/src-interface.yml;"
construct[2***REMOVED***="src-repository/src-repository.yml;"
construct[3***REMOVED***="src-service/src-service.yml;"
construct[4***REMOVED***="src-filter/src-filter.yml;"
construct[5***REMOVED***="src-form/src-form.yml;"
construct[6***REMOVED***="src-viewhelper/src-viewhelper.yml;"
construct[7***REMOVED***="src-controllerplugin/src-controllerplugin.yml;"
construct[8***REMOVED***="src-valueobject/src-valueobject.yml;"

source "$bin/gear/module/test-module.sh"