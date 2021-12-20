<?php

$EM_CONF[$_EXTKEY] = [
	'title' => 'YouTube Video',
	'description' => 'YouTube video content with custom cover images, gallery layout and backend previews.',
	'category' => 'fe',
	'version' => '2.1.0',
	'state' => 'stable',
	'clearcacheonload' => true,
	'author' => 'Tanel Põld',
	'author_email' => 'tanel@brightside.ee',
	'author_company' => 'Brightside OÜ / t3brightside.com',
	'constraints' => [
		'depends' => [
			'typo3' => '10.4.0-11.5.99',
			'fluid_styled_content' => '',
		],
    ],
];
