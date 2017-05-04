#!/usr/bin/env bash
#####################################################################
# Script to automize the Git changelog of WBCE CMS (http://wbce.org)
#
# USAGE: Call script inside a local WBCE Git project folder to dump
# the commit messages of the active branch to file 'CHANGELOG.md'.
#
# @author cwsoft (Christian Sommer)
# @license GNU GPL2 (or any later version)
#####################################################################
# Define some variables
WBCE_URL=https://github.com/WBCE/WBCE_CMS
OUTPUT_FILE=CHANGELOG.md

# Output general header to changelog
cat > $OUTPUT_FILE << EOT
# Changelog WBCE CMS
This CHANGELOG was automatically created from a local WBCE Git repository.
The changelog may therefore not be correct or up-to date.
Please visit the [WBCE Github]($WBCE_URL/commits) repository for the most up to-date version.

## Auto generated Git commit history

EOT

# Output Git commit history using pretty-format
git log --oneline --pretty=format:" * **%ad:** %an [[%h]($WBCE_URL/commit/%H)]%n%w(0,3,3)> %s%n%w(0,5,5)%b" --date=short >> $OUTPUT_FILE

echo
echo ">> Created $OUTPUT_FILE in actual working folder"
