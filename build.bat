@echo off
SET var=1
IF %var%==1 (
   del img\*.png
)

php gen.php

IF %var%==1 (
   git add .
   git commit -m "%date%"_%time%"
   git push
)
