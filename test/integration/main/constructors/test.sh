#!/bin/bash

bin="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../../../../bin && pwd )"
scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"

module="PbrSrc"
type="web"
construct=()
construct+=("src-repository/src-repository.yml")
construct+=("src-service/src-service.yml")
construct+=("src-form/src-form.yml")
construct+=("src-filter/src-filter.yml")
construct+=("src-view-helper/src-view-helper.yml")
construct+=("src-controller-plugin/src-controller-plugin.yml")
construct+=("src-value-object/src-value-object.yml")


source "$bin/gear/module/test-module.sh"
