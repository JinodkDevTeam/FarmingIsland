@echo off
TITLE PocketMine-MP server software for Minecraft: Pocket Edition
cd /d %~dp0

if exist bin_php8\php\php.exe (
	set PHPRC=""
	set PHP_BINARY=bin_php8\php\php.exe
) else (
	set PHP_BINARY=php
)

if exist src/PocketMine.php (
	set POCKETMINE_FILE=src/PocketMine.php
) else (
	echo PocketMine-MP.phar not found
	echo Downloads can be found at https://github.com/pmmp/PocketMine-MP/releases
	pause
	exit 1
)

if exist bin_php8\mintty.exe (
	start "" bin_php8\mintty.exe -o Columns=88 -o Rows=32 -o AllowBlinking=0 -o FontQuality=3 -o Font="Consolas" -o FontHeight=10 -o CursorType=0 -o CursorBlinks=1 -h error -t "PocketMine-MP" -i bin_php8/pocketmine.ico -w max %PHP_BINARY% %POCKETMINE_FILE% --enable-ansi %*
) else (
	REM pause on exitcode != 0 so the user can see what went wrong
	%PHP_BINARY% -c bin_php8\php %POCKETMINE_FILE% %* || pause
)
