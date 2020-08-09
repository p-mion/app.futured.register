#!/bin/sh

VERSION="v1"
REGISTER=1
ARG_NUM=$#
source .env

if [ $ARG_NUM -eq "0" ]; then

	echo "Register [command]"
	echo "Command:"
	echo "  summary - summary of current register's bills"
	echo "  list - list all current register's bills"
	echo "  get <bill_id> - selected bill properties"
	echo "  add <price> [amount] - add payment"
	echo "  cancel <bill_id> - cancel payment"
	echo ""
	env
	exit;
fi

REQ_COMMAND=$1
REQ_METHOD="GET"
REQ_DATA=""
URL_PARAMS=""
case $REQ_COMMAND in
	'summary')
		URL_PARAMS=""
		;;
	'list')
		URL_PARAMS="/bill"
		;;
	'get')
		if [ -z "$2" ]; then
			echo "missing bill_id parameter"
			exit;
		fi
		URL_PARAMS="/bill/$2"
		;;
	'add')
		if [ -z "$2" ]; then
			echo "missing price value parameter"
			exit;
		fi
		REQ_METHOD="POST"
		URL_PARAMS="/bill"
		REQ_DATA="price=$2"
		if [ ! -z "$3" ]; then
			REQ_DATA="$REQ_DATA&amount=$3"
		fi
		;;
	'cancel')
		if [ -z "$2" ]; then
			echo "missing bill_id parameter"
			exit;
		fi
		REQ_METHOD="DELETE"
		URL_PARAMS="/bill/$2"
		;;
	esac


curl -X "$REQ_METHOD" -d "$REQ_DATA" \
	-H "X-Token: $API_TOKEN" \
	"$APP_URL/$VERSION/register/$REGISTER$URL_PARAMS?output=text"

echo ""
