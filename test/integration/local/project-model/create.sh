#!/bin/bash

scriptDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && pwd )"
headersDir="$( cd "$( dirname "${BASH_SOURCE[0***REMOVED***}" )" && cd ./../../_functions && pwd )"

source "$headersDir/abstract-project.sh"

project="Seller"

deleteProject "$project"

createProject "$project"

createModuleWeb "$project" "Food"
prepareConstruct "$project" "$scriptDir/migrations/20160123222068_food.php"
constructModuleProject "$project" "Food" "$scriptDir" "food.yml"

createModuleWeb "$project" "Book"
prepareConstruct "$project" "$scriptDir/migrations/20160123222069_book.php"
constructModuleProject "$project" "Book" "$scriptDir" "book.yml"

reload "$project"
testProject "$project"
