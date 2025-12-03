<?php

$EM_CONF[$_EXTKEY] = [
	'title' => 'YouTube Video',
	'description' => 'YouTube videos with custom cover images, gallery layout, pagination, GDPR, and backend previews.',
	'category' => 'fe',
	'version' => '3.1.2',
	'state' => 'stable',
	'clearcacheonload' => true,
	'author' => 'Tanel Põld',
	'author_email' => 'tanel@brightside.ee',
	'author_company' => 'Brightside OÜ / t3brightside.com',
	'constraints' => [
		'depends' => [
			'typo3' => '12.4.0-14.9.99',
			'fluid_styled_content' => '14.4.0-13.9.99',
            'embedassets' => '1.4.0-1.99.99',
            'paginatedprocessors' => '1.7.0-1.99.99'
		],
    ],
];
