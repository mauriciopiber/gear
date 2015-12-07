#!/bin/bash

sudo git ls-remote --tags origin | awk '/^(.*)(\s+)(.*0\.1\.[0-9***REMOVED****)$/ {print ":" $2}' | sudo xargs git push origin
sudo git tag | awk '/^(.*0\.1\.[0-9***REMOVED****)$/ {print $1}' | sudo git tag -d

