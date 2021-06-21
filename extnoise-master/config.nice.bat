@echo off
cscript /nologo /e:jscript configure.js  "--disable-all" "--enable-extnoise" %*
