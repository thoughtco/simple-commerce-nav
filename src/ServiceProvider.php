<?php

namespace Thoughtco\SimpleCommerceNav;

use Statamic;
use Statamic\Facades\CP\Nav;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $scripts = [
        __DIR__.'/../resources/js/cp.js'
    ];
    
    public function boot()
    {
        Statamic::script('app', 'cp');

        Statamic::booted(function () {
            Nav::extend(function ($nav) {
                $productsCollection = Collection::find('products');
                $couponsCollection = Collection::find('coupons');
                $ordersCollection = Collection::find('orders');
                $customersCollection = Collection::find('customers');

                $nav->create('Products')
                    ->section('Ecommerce')
                    ->url($productsCollection->showUrl())
                    ->can('view', $productsCollection);

                $nav->create('Coupons')
                    ->section('Ecommerce')
                    ->url($couponsCollection->showUrl())
                    ->can('view', $couponsCollection);

                $nav->create('Orders')
                    ->section('Ecommerce')
                    ->url($ordersCollection->showUrl())
                    ->can('view', $ordersCollection);

                $nav->create('Customers')
                    ->section('Ecommerce')
                    ->url($customersCollection->showUrl())
                    ->can('view', $customersCollection);
            });
        });
    }
}
