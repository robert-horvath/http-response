.PHONY: clean unit-test-env integration-test-env unit-test integration-test

unit-test-env:
	@echo "\033[0;33m>>> Prepare workspace for unit testing\033[0m"
	composer install --no-interaction
	composer unit-test-env

integration-test-env:
	@echo "\033[0;33m>>> Prepare workspace for integration testing\033[0m"
	composer install --no-interaction --prefer-source

clean:
	@echo "\033[0;33m>>> Cleaning workspace\033[0m"
	rm -rf vendor tmp composer.lock phpunit.xml

unit-test:
	@echo "\033[0;33m>>> Running unit tests\033[0m"
	vendor/bin/phpunit --testsuite unit-test

integration-test:
	@echo "\033[0;33m>>> Running integration tests\033[0m"
	vendor/bin/phpunit --testsuite integration-test
