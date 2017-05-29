#!/bin/bash
set -e

host="$1"
shift
cmd="$@"
echo 11;
args=(
	-h $host
	-uroot
	-Dsys
	-puser-api
	--silent
)

echo 22;
until select="$(echo 'SELECT 1' | mysql "${args[@]}")" && [ "$select" == '1' ]; do
  >&2 echo "MySQL is unavailable - sleeping"
  sleep 1
  echo 33;
done

>&2 echo "MySQL is up - executing command"
eval $cmd