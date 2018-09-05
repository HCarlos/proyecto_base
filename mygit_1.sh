#!/usr/bin/env bash
git remote set-url origin https://github.com/HCarlos/Platsource.git
git config --global user.email "r0@tecnointel.mx"
git config --global user.name "HCarlos"
git config --global color.ui true
git config core.fileMode false
git config --global push.default simple

git checkout master

git status

#git rm --cached /.env
#git rm -r --cached .env
git rm -r --cached .env.example
git rm -r --cached .gitignore
git rm -r --cached .gitattributes
git rm --cached *.sh
git rm -r --cached .idea
git rm -r --cached otros

# git rm -r --cached .
git rm -r --cached composer.json
git rm -r --cached composer.lock

git add .

git commit -m "PS - A | Alfa"

## git push -u origin master
git push -u origin master --force

exit
