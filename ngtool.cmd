@echo off
IF %1 == key-gen goto key-gen
IF %1 == joke_key_gen goto joke_key_gen
goto end

:key-gen
    php ngtools\TranslationKeysGenerator.php
    goto end

:joke_key_gen
    php ngtools\JokeTranslationKeysGenerator.php
    goto end

:end
