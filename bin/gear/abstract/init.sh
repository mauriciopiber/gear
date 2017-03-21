
# Params
if [ $# -lt 2 ***REMOVED***; then
    echo "-> usage $0: command --help"
    exit 1
fi
    
declare -a availableCmds=("create" "reset" "construct")

cmd=${1}

if not_in_array availableCmds "${cmd}"; then
	
	echo "Exiting with invalid command ${cmd}"
	exit 1
	
fi

if [ "${2}" == "--help" ***REMOVED***; then
	
	Gear_Help "$worker" "$cmd"
	exit 0
fi