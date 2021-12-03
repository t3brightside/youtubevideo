<?php

$EM_CONF[$_EXTKEY] = [
	'title' => 'YouTube Video',
	'description' => 'Easy to use YouTube video content element with responsive template, cover image and backend preview.',
	'category' => 'fe',
	'version' => '2.0.0-alpha',
	'state' => 'alpha',
	'clearcacheonload' => true,
	'author' => 'Tanel Põld',
	'author_email' => 'tanel@brightside.ee',
	'author_company' => 'Brightside OÜ / t3brightside.com',
	'constraints' => [
		'depends' => [
			'typo3' => '11.5.0-11.5.99',
			'fluid_styled_content' => '',
		],
    ],
];
