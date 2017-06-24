@echo off
rem del img\*.png
php gen.php

IF 1==1 (
   git add .
   git commit -m "%date%"_%time%"
   git push
)
