<?php

return [
    /*
     * Application
     */
    'name' => 'LaGet repository',
    'shortname' => 'LaGet',
    'description' => 'This is a NuGet repository server.',
    'links' => [
        ['href' => 'http://web.site', 'title' => 'Link 1'],
        ['href' => 'http://web.site', 'title' => 'Link 2'],
        ['href' => 'http://web.site', 'title' => 'Link 3'],
    ],
    'chocolatey_feed' => false,
    'enable_hashover' => false,
    'clickonce_url' => '',
    /*
     * Packages
     */
    'hash_algorithm' => 'SHA512',
    ];