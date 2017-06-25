@echo off
SET git=1
SET img=0

IF %img%==1 (
   del img\*.png
)

php gen.php

IF %git%==1 (
   git add .
   git commit -m "%date%-%time%"
   git push
)
