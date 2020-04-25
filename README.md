# benchmark_master

This is a simple application that allows th passing of callable functions/closure objects to be passed in along with options needed to execute benchmarking. This will yield customizable reports to the command line than can be manage via config file or command line params.

Dependencies:
phpbench
php7.2+
Symfony Microkernel Trait

Getting Started
* Download repo using composer
** composer install rootedtech/benchmark_master
** check write permission on {project_root}/tests directory
* Run sample bench mark test using following: 

Run custom report using command line arguments
./vendor/bin/phpbench run tests/benchmarks/BenchmarkBench.php report='{"extends": "aggregate", "cols": ["subject", "its", "best", "worst", "mean", "mode", "rstdev"]}' --iterations=10

Run report defined in config file
./vendor/bin/phpbench run tests/benchmarks/BenchmarkBench.php --iterations=10 --report='test_report'

Save results of saved report for later manipulation(will save to csv file test/benchmarks/_storage)
./vendor/bin/phpbench run tests/benchmarks/BenchmarkBench.php --store --iterations=10 --report='test_report'

For full docs on run command options see phpbench documentation.
Config file: https://phpbench.readthedocs.io/en/latest/quick-start.html#phpbench-configuration
Command line params: https://phpbench.readthedocs.io/en/latest/benchmark-runner.html#running-benchmarks
