@echo off
del *.png
php gen.php
git add .
git commit -m "%date%"_%time%"
git push
