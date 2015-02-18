swagger:
	./vendor/zircote/swagger-php/bin/swagger ./controllers/  -o ./tools/swagger/resource

prepare:
	mkdir -p  runtime
	chmod 777 runtime
	mkdir -p  dev/assets
	chmod 777 dev/assets
	mkdir -p  tmp
	chmod 777 tmp
	chmod + x tests/codeception/bin/yii

test:
	cd tests && ./codeception/bin/yii migrate/up
	cd tests && codecept build
	cd tests && codecept run unit

test_coverage_unit:
	cd tests && ./codeception/bin/yii migrate/up
	cd tests && codecept build
	cd tests && codecept run unit --coverage-html

check_style:	test_prepare
	# Run checkstyle
	@echo "Running checkstyle/mess_detect, this may take a while, please be patient..."
	-cd tools && ./checkstyle.sh
	@echo "Generating checkstyle/mess_detect summary/detail report..."
	@php tools/digest_checkstyle.php > tmp/checkstyle_detail.txt
	@head -10 tmp/checkstyle_detail.txt
	@echo
	@echo "Finished, please review tmp/checkstyle_detail.txt for errors sorted by author"

# Git statistics query
# Reference: http://stackoverflow.com/questions/4589731/git-blame-statistics
# Who contributed how many lines to our project
author_lines:
	git ls-tree -r --name-only HEAD | grep -v '^tools/' | egrep  -E '\.(php|js|css)$$' | xargs -n1 git blame --line-porcelain HEAD |grep  "^author "|sort|uniq -c|sort -nr

#----- BEGIN DEV ENV SETUP ACTIONS -----

# Install or update composer packages
composer_init:
	curl -sS https://getcomposer.org/installer | php

composer_install:
	composer install

composer_update:
	composer update

composer_prepare:
	composer global require "fxp/composer-asset-plugin:~1.0"
	composer global require "codeception/codeception=2.0.*"
	composer global require "codeception/specify=*"
	composer global require "codeception/verify=*"

upload_vendor:
	rsync -av --delete webapp/vendor --rsh="ssh -p 333" smx@it-deploy.foxitcloud.com:/opt/www/

