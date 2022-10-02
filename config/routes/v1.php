<?php

declare(strict_types=1);

use App\Components\Router\StaticRouteGroup as Group;
use App\Http\Action;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return static function (App $app): void {
    $app->group('/v1', new Group(static function (RouteCollectorProxy $group): void {
        $group->get('', Action\V1\OpenApiAction::class);

        $group->group('/photos', new Group(static function (RouteCollectorProxy $group): void {
            $group->post('', Action\V1\Photos\UploadAction::class);
            $group->get('/{id}', Action\V1\Photos\GetByIdAction::class);
            $group->patch('/{id}', Action\V1\Photos\MarkUseAction::class);
            $group->delete('/{id}', Action\V1\Photos\MarkDeleteAction::class);
        }));
    }));
};
