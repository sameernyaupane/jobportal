<?php

/**
 * Job Portal Routes
 */

$router->get('/', ['as' => 'home', 'uses' => 'Jobs@index']);
$router->post('/', 'Jobs@index');

$router->get('post-a-job', ['as' => 'job.create', 'uses' => 'Jobs@getCreate']);
$router->post('post-a-job', 'Jobs@postCreate');

$router->get('job/{uuid}/edit', ['as' => 'job.edit', 'uses' => 'Jobs@getEdit']);
$router->post('job/{uuid}/edit', 'Jobs@postEdit');

$router->get('job/{uuid}/delete', ['as' => 'job.delete', 'uses' => 'Jobs@getDelete']);