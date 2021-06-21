call phpize 2>&1
call configure --disable-all --enable-extnoise 2>&1
nmake /nologo 2>&1
exit %errorlevel%
