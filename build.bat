@echo off
SET var=1
IF %var%==2 (
   del img\*.png
)

php gen.php

IF %var%==1 (
   git add .
   git commit -m "%date%-%time%"
   git push
)
