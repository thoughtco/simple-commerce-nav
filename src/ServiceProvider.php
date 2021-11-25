<?php

namespace Thoughtco\SimpleCommerceNav;

use Statamic;
use Statamic\Facades\Collection;
use Statamic\Facades\CP\Nav;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    public function boot()
    {
        Statamic::booted(function () {
            Nav::extend(function ($nav) {
                
                $productsCollection = Collection::find('products');
                $couponsCollection = Collection::find('coupons');
                $ordersCollection = Collection::find('orders');
                $customersCollection = Collection::find('customers');

                // add new ecommerce block
                $nav->content('Ecommerce')
                    ->url($productsCollection->showUrl())
                    ->icon('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">  <g transform="matrix(3.4285714285714284,0,0,3.4285714285714284,0,0)"><g>    <line x1="7" y1="4.5" x2="7" y2="3" style="fill: none;stroke: currentColor;stroke-linecap: round;stroke-linejoin: round"></line>    <g>      <path d="M5.5,8.5c0,.75.67,1,1.5,1s1.5,0,1.5-1c0-1.5-3-1.5-3-3,0-1,.67-1,1.5-1s1.5.38,1.5,1" style="fill: none;stroke: #000000;stroke-linecap: round;stroke-linejoin: round"></path>      <line x1="7" y1="9.5" x2="7" y2="11" style="fill: none;stroke: currentColor;stroke-linecap: round;stroke-linejoin: round"></line>    </g>    <circle cx="7" cy="7" r="6.5" style="fill: none;stroke: currentColor;stroke-linecap: round;stroke-linejoin: round"></circle>  </g></g></svg>')
                    ->children([
                        
                        'Products' => $nav->item('Products')
                            ->url($productsCollection->showUrl())
                            ->can('view', $productsCollection),
                            
                        'Coupons' => $nav->item('Coupons')
                            ->url($couponsCollection->showUrl())
                            ->can('view', $couponsCollection),
                            
                        'Orders' => $nav->item('Orders')
                            ->url($ordersCollection->showUrl())
                            ->can('view', $ordersCollection),
                            
                        'Customers' => $nav->item('Customers')
                            ->url($customersCollection->showUrl())
                            ->can('view', $customersCollection),
                            
                    ])
                    ->active('xxx|products|coupons|orders|customers');
                
                // remove from 'collections'
                $collections = $nav->content('Collections');
                $children = $collections->children()()
                    ->filter(function ($child) {
                       return !in_array($child->name(), ['Products', 'Coupons', 'Orders', 'Customers']);
                    });
                $collections->children(function() use ($children) { return $children; });

            });
        });
    }
}
