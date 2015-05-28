swagger:
	./vendor/zircote/swagger-php/bin/swagger ./controllers/  -o ./tools/swagger/resource

prepare:
	mkdir -p  runtime
	chmod -R 777 runtime
	mkdir -p  dev/assets
	chmod -R 777 dev/assets
	mkdir -p  tmp
	chmod 777 tmp
	chmod +x tests/codeception/bin/yii
	./yii migrate

test:
	cd tests && ./codeception/bin/yii migrate/up
	cd tests && codecept build
	cd tests && codecept run unit

test_coverage_unit:
	cd tests && ./codeception/bin/yii migrate/up
	cd tests && codecept build
	cd tests && codecept run unit --coverage-html

# Git statistics query
# Reference: http://stackoverflow.com/questions/4589731/git-blame-statistics
# Who contributed how many lines to our project
author_lines:
	git ls-tree -r --name-only HEAD | grep -v '^tools/' | egrep  -E '\.(php|js|css)$$' | xargs -n1 git blame --line-porcelain HEAD |grep  "^author "|sort|uniq -c|sort -nr

composer_install:
	composer install

composer_update:
	composer update

composer_prepare:
	composer global require "fxp/composer-asset-plugin:~1.0"
	composer global require "codeception/codeception=2.0.*"
	composer global require "codeception/specify=*"
	composer global require "codeception/verify=*"