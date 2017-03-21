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

createModuleWeb "$project" "Magazine"
prepareConstruct "$project" "$scriptDir/migrations/20160123222070_magazine.php"
constructModuleProject "$project" "Magazine" "$scriptDir" "magazine.yml"

createModuleWeb "$project" "Music"
prepareConstruct "$project" "$scriptDir/migrations/20160123222071_music.php"
constructModuleProject "$project" "Music" "$scriptDir" "music.yml"

createModuleWeb "$project" "Games"
prepareConstruct "$project" "$scriptDir/migrations/20160123222072_games.php"
constructModuleProject "$project" "Games" "$scriptDir" "games.yml"


reload "$project"
testProject "$project"
