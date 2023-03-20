<?php

$EM_CONF[$_EXTKEY] = [
	'title' => 'YouTube Video',
	'description' => 'YouTube videos with custom cover images, gallery layout, pagination, GDPR options and backend previews.',
	'category' => 'fe',
	'version' => '2.3.0',
	'state' => 'stable',
	'clearcacheonload' => true,
	'author' => 'Tanel Põld',
	'author_email' => 'tanel@brightside.ee',
	'author_company' => 'Brightside OÜ / t3brightside.com',
	'constraints' => [
		'depends' => [
			'typo3' => '11.5.0-12.99.99',
			'fluid_styled_content' => '',
            'embedassets' => '1.2.0-1.99.99',
		],
    ],
];
