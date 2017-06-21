@echo off
del img\*.png
php gen.php
git add .
git commit -m "%date%"_%time%"
git push
