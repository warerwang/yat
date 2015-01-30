swagger:
	./vendor/zircote/swagger-php/bin/swagger ./controllers/  -o ./tools/swagger/resource

test_prepare:
	composer global require "fxp/composer-asset-plugin:~1.0"
	mkdir -p  runtime
	chmod 777 runtime
	mkdir -p  dev/assets
	chmod 777 dev/assets
	mkdir -p  tmp
	chmod 777 tmp

# Create database tables for testing
test_migrate:
	./tests/codeception/bin/yii migrate/up

#running tests
test:   all_tests

all_tests:
	# chmod 777 tests/codeception/bin/yii
	tests/codeception/bin/yii migrate/up --interactive=0
	cd tests && php codecept.phar build
	cd tests && php codecept.phar run

#-- Coverage Related Actions --

test_coverage:
	chmod 777 tests/codeception/bin/yii
	tests/codeception/bin/yii migrate/up --interactive=0
	cd tests && php codecept.phar build
	cd tests && php codecept.phar run --coverage

test_coverage_unit:
	chmod 777 tests/codeception/bin/yii
	tests/codeception/bin/yii migrate/up --interactive=0
	cd tests && php codecept.phar build
	cd tests && php codecept.phar run unit --coverage-html

#-- Jenkins Related Actions --

test_jenkins_fast:
	echo Please run: make test

test_jenkins: test_prepare
	# First run: make coverage (copy from above)
	${PHPUNIT_PREPS} && \
		../../vendor/bin/phpunit ${PHPUNIT_OPTIONS_WITH_COVERAGE} unit/
	-cd protected && ./yiic coverage report
	# Run checkstyle (copy from below)
	@echo "Running checkstyle/mess_detect, this may take a while, please be patient..."
	-cd protected/tools && ./checkstyle.sh
	@echo "Generating checkstyle/mess_detect summary/detail report..."
	@php protected/tools/digest_checkstyle.php > tmp/checkstyle_detail.txt
	@head -10 tmp/checkstyle_detail.txt
	@echo
	@echo "Finished, please review tmp/checkstyle_detail.txt for errors sorted by author"
	# Lastely ensure our coverage level is correct, this is VERY IMPORTANT, and please
	# DO NOT remove or lower the values below (unless you obtain written permission from
	# Chunk, Jeff or Steven.
	cd protected && ./yiic coverage check --pctTarget=14 --ncFilesTarget=35 --checkStyleTarget=415 # WARNNING! read comments above.

#-- Unit Test Related Actions --

functional_tests:
	cd tests && codecept run functional a2

acceptance_test_single:
	cd tests && php codecept.phar run --debug acceptance a2/WelcomeCept.php

unit_test_single:
	cd tests && php codecept.phar run --debug unit models/UserTest.php

unit_test_cas:
	cd tests && php codecept.phar run --debug unit components/CasServiceTest.php

unit_test_forms:
	cd tests && php codecept.phar run --debug unit models/TemplateTest.php

unit_tests_components:
	cd tests && php codecept.phar run --debug unit components/

unit_tests_s8:	unit_tests_components


unit_test_failing:
	cd tests && php codecept.phar run --debug unit_failing

unit_tests:
	cd tests && php codecept.phar run --debug unit


#----- BEGIN STATIC CODE ANALYSIS ACTIONS -----

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
	composer global require "codeception/codeception=2.0.*"
	composer global require "codeception/specify=*"
	composer global require "codeception/verify=*"

deploy_demo:	deploy_prepare
	echo Deploying to the UCX production server...
	./deploy_ucx.sh ops47

deploy_forced:	deploy_prepare
	echo Deploying to the UCX production server, without checks. This is DANGEROUS\!\!
	./deploy_ucx.sh --force aws-ucx-prod

upload_vendor:
	rsync -av --delete webapp/vendor --rsh="ssh -p 333" smx@it-deploy.foxitcloud.com:/opt/www/ops30.sumilux.com/
	rsync -av --delete webapp/vendor --rsh="ssh -p 333" smx@smxhf.sumilux.com:/opt/www/ops30.sumilux.com/


