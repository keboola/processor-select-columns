#!/bin/sh

cd $KBC_DATADIR/in/tables/
find . -iname "*.csv" | xargs -n1 -I {} sh -c "/code/q -d , -H -O \"SELECT $KBC_PARAMETER_COLUMNS FROM {}\" > $KBC_DATADIR/out/tables/\"{}\""
