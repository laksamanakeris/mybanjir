<?php

require_once(__DIR__ . '/../vendor/autoload.php');

$siteURL = "http://mybanjir.wearefiftyseven.com";

$path_array = array(
	array('state' => 'pls', 'interval' => '*/5 * * * *'),
	array('state' => 'kdh', 'interval' => '*/5 * * * *'),
	array('state' => 'mad', 'interval' => '*/5 * * * *'),
	array('state' => 'png', 'interval' => '*/5 * * * *'),
	array('state' => 'prk', 'interval' => '*/5 * * * *'),
	array('state' => 'prk', 'interval' => '*/5 * * * *','page' => 2),
	
	array('state' => 'sel', 'interval' => '*/6 * * * *'),
	array('state' => 'sel', 'interval' => '*/6 * * * *','page' => 2),
	array('state' => 'sel', 'interval' => '*/5 * * * *','page' => 3),
	array('state' => 'sel', 'interval' => '*/5 * * * *','page' => 4),
	array('state' => 'wlh', 'interval' => '*/5 * * * *'),
	
	array('state' => 'mlk', 'interval' => '*/5 * * * *'),
	array('state' => 'nsn', 'interval' => '*/5 * * * *'),
	array('state' => 'jhr', 'interval' => '*/5 * * * *'),
	array('state' => 'jhr', 'interval' => '*/5 * * * *','page' => 2),
	
	array('state' => 'phg', 'interval' => '*/5 * * * *'),
	array('state' => 'phg', 'interval' => '*/5 * * * *','page' => 2),
	array('state' => 'trg', 'interval' => '*/5 * * * *'),
	array('state' => 'kel', 'interval' => '*/5 * * * *'),
	
	array('state' => 'srk', 'interval' => '*/5 * * * *'),
	array('state' => 'srk', 'interval' => '*/5 * * * *','page' => 2),
	array('state' => 'srk', 'interval' => '*/5 * * * *','page' => 3),

	array('state' => 'sbh', 'interval' => '*/5 * * * *'),
	array('state' => 'lsm', 'interval' => '*/5 * * * *'),
	);



$resolver = new \Cron\Resolver\ArrayResolver();


foreach ($path_array as $item) {
	// Write folder content to log every five minutes.
	$job = new \Cron\Job\ShellJob();
	$url = $siteURL."/crawler/waterlevel/".$item['state'];

	if( isset($item['page']) ){
		$url = $url."?page=".$item['page'];
	}
	$job->setCommand('curl -s '.$url);
	$job->setSchedule(new \Cron\Schedule\CrontabSchedule( $item['interval'] ));

	$resolver->addJob($job);
}


$cron = new \Cron\Cron();
$cron->setExecutor(new \Cron\Executor\Executor());
$cron->setResolver($resolver);

$cron->run();