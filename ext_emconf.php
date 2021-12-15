<?php

$EM_CONF[$_EXTKEY] = [
	'title' => 'YouTube Video',
	'description' => 'YouTube video content with custom cover images, gallery layout and backend preview.',
	'category' => 'fe',
	'version' => '2.0.0-beta',
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
