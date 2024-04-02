<?php // routes/breadcrumbs.php

use App\Models\Category;
use App\Models\Article;
use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard'));
});

Breadcrumbs::macro('resource', function (string $name, string $title) {
    // Home > Blog
    Breadcrumbs::for("{$name}.index", function (BreadcrumbTrail $trail) use ($name, $title) {
        $trail->parent('home');
        $trail->push($title, route("{$name}.index"));
    });

    // Home > Blog > New
    Breadcrumbs::for("{$name}.create", function (BreadcrumbTrail $trail) use ($name) {
        $trail->parent("{$name}.index");
        $trail->push('New', route("{$name}.create"));
    });

    // Home > Blog > Post 123 > Edit
    Breadcrumbs::for("{$name}.edit", function (BreadcrumbTrail $trail, User $model) use ($name) {
        $trail->parent("{$name}.index", $model);
        $trail->push('Edit', route("{$name}.edit", $model));
    });
});
Breadcrumbs::resource('user', 'User');

Breadcrumbs::macro('resource', function (string $name, string $title) {
    // Home > Blog
    Breadcrumbs::for("{$name}.index", function (BreadcrumbTrail $trail) use ($name, $title) {
        $trail->parent('home');
        $trail->push($title, route("{$name}.index"));
    });

    // Home > Blog > New
    Breadcrumbs::for("{$name}.create", function (BreadcrumbTrail $trail) use ($name) {
        $trail->parent("{$name}.index");
        $trail->push('New', route("{$name}.create"));
    });

    // Home > Blog > Post 123 > Edit
    Breadcrumbs::for("{$name}.edit", function (BreadcrumbTrail $trail, Article $model) use ($name) {
        $trail->parent("{$name}.index", $model);
        $trail->push('Edit', route("{$name}.edit", $model));
    });
});
Breadcrumbs::resource('article', 'Article');

Breadcrumbs::macro('resource', function (string $name, string $title) {
    // Home > Blog
    Breadcrumbs::for("{$name}.index", function (BreadcrumbTrail $trail) use ($name, $title) {
        $trail->parent('home');
        $trail->push($title, route("{$name}.index"));
    });

    // Home > Blog > New
    Breadcrumbs::for("{$name}.create", function (BreadcrumbTrail $trail) use ($name) {
        $trail->parent("{$name}.index");
        $trail->push('New', route("{$name}.create"));
    });

    // Home > Blog > Post 123 > Edit
    Breadcrumbs::for("{$name}.edit", function (BreadcrumbTrail $trail, Category $model) use ($name) {
        $trail->parent("{$name}.index", $model);
        $trail->push('Edit', route("{$name}.edit", $model));
    });
});
Breadcrumbs::resource('category', 'Category');

