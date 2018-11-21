#!/bin/bash

# the name of your cockpit
COCKPITDIR=cockpit

# source of cockpit
REPO=https://github.com/agentejo/cockpit/archive/next.zip

# dir name of exported data
DUMMY=dummy_data



### functions

# Github archive name is "reponame-treename.zip" with a folder "reponame-treename" in it.
# download zip to tmp, extract it, copy contents to $COCKPITDIR, remove tmp
# usage: github_dl_extract "path/of/destination" "archive_url.zip"
github_dl_extract () {
  local TMPDIR=`mktemp -d`
  echo downloading Cockpit from $2...
  wget -q -O $TMPDIR/cptmp.zip $2
  unzip -q $TMPDIR/cptmp.zip -d $TMPDIR/unzipped
  local DIR="$(echo $TMPDIR/unzipped/*)"
  cp -r $DIR/. $1
  rm -r $TMPDIR
  echo copied files to \"$1\" and deleted temporary files
}

# like above, but copies subdir or extracted repo
# usage: github_dl_extract "path/of/destination" "archive_url.zip" "subdir"
github_dl_extract_subdir () {
  local TMPDIR=`mktemp -d`
  local TMPDIR2=`mktemp -d`
  echo downloading Cockpit from $2...
  wget -q -O $TMPDIR/cptmp.zip $2
  unzip -q $TMPDIR/cptmp.zip -d $TMPDIR/unzipped
  local DIR="$(echo $TMPDIR/unzipped/*)"
  cp -r $DIR/. $TMPDIR2
  cp -r $TMPDIR2/$3 $1
  rm -r $TMPDIR
  echo copied \"$3\" to \"$1\" and deleted temporary files
}

### code starts here

# parent of this install dir
ROOT=$(dirname `pwd`)

COCKPIT=$ROOT/$COCKPITDIR

if [ -d $COCKPIT ]; then
  echo Cockpit is installed already! Skip downloading...
else
  # create cockpit dir in $ROOT
  mkdir -p $COCKPIT

  # download cockpit from $REPO and extract the files to $COCKPIT
  github_dl_extract "$COCKPIT" "$REPO"

fi

# call install.php to check dependencies and to install dummy data
if ! php index.php; then
  echo Check your dependencies and restart the script.
else
  
  # direct import of exported data fails...
  # * assets: PHP Warning:  copy(): Filename cannot be empty
  # * collections, singleton and forms php files in storage
  #   must exist before importing json data
  # * form cli import/export doesn't exist
  
  # copy dummy data
  cp -r $ROOT/$DUMMY/storage/* $COCKPIT/storage
  
  # copy config.yaml, defines.php and boostrap.php
  mkdir -p $COCKPIT/config
  cp -r $ROOT/$DUMMY/config/* $COCKPIT/config
  cp $ROOT/$DUMMY/defines.php $COCKPIT
  
  # import data from export dir
  php $COCKPIT/cp import --src $ROOT/$DUMMY/export
  
  # download addons
  github_dl_extract_subdir "$COCKPIT/addons" "https://github.com/raffaelj/cockpit_UniqueSlugs/archive/master.zip" "UniqueSlugs"
  github_dl_extract_subdir "$COCKPIT/addons" "https://github.com/raffaelj/cockpit_FormValidation/archive/master.zip" "FormValidation"
  
fi
