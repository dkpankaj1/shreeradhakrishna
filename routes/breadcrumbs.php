<?php

use App\Models\Purchase;
use App\Models\Redeem;
use App\Models\RewardSetting;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use App\Models\Customer;

// Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('dashboard'));
});

// Customer
Breadcrumbs::for('customer.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Customer', route('customer.index'));
});

// Customer > create
Breadcrumbs::for('customer.create', function ($trail) {
    $trail->parent('customer.index');
    $trail->push('Create', route('customer.create'));
});

// Customer > show
Breadcrumbs::for('customer.show', function ($trail, Customer $customer) {
    $trail->parent('customer.index');
    $trail->push('Show', route('customer.show', $customer));
});

// Customer > edit
Breadcrumbs::for('customer.edit', function ($trail, Customer $customer) {
    $trail->parent('customer.index');
    $trail->push('Edit', route('customer.edit', $customer));
});

// Purchase
Breadcrumbs::for('messenger.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Messenger', route('messenger.index'));
});
// Purchase > create
Breadcrumbs::for('messenger.create', function ($trail) {
    $trail->parent('messenger.index');
    $trail->push('Compose', route('messenger.create'));
});

// Purchase
Breadcrumbs::for('purchase.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Purchase', route('purchase.index'));
});
// Purchase > create
Breadcrumbs::for('purchase.create', function ($trail) {
    $trail->parent('purchase.index');
    $trail->push('Create', route('purchase.create'));
});

// Purchase > show
Breadcrumbs::for('purchase.show', function ($trail, Purchase $purchase) {
    $trail->parent('purchase.index');
    $trail->push('Show', route('purchase.show', $purchase));
});

// Purchase > edit
Breadcrumbs::for('purchase.edit', function ($trail, Purchase $purchase) {
    $trail->parent('purchase.index');
    $trail->push('Edit', route('purchase.edit', $purchase));
});


// Redeem
Breadcrumbs::for('redeem.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Redeem', route('redeem.index'));
});
// Redeem > create
Breadcrumbs::for('redeem.create', function ($trail, Customer $customer) {
    $trail->parent('redeem.index');
    $trail->push('Create', route('redeem.create', $customer));
});

// Redeem > show
Breadcrumbs::for('redeem.show', function ($trail, Redeem $redeem) {
    $trail->parent('redeem.index');
    $trail->push('Show', route('redeem.show', $redeem));
});

// Redeem > show
Breadcrumbs::for('redeem.payment', function ($trail, Redeem $redeem) {
    $trail->parent('redeem.index');
    $trail->push($redeem->id);
    $trail->push('Reward', route('redeem.payment', $redeem));
});


// Setting > Reward
Breadcrumbs::for('setting.reward.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Reward', route('setting.reward.index'));
});

// Setting > Reward > edit
Breadcrumbs::for('setting.reward.edit', function ($trail, Customer $setting) {
    $trail->parent('setting.reward.index');
    $trail->push('Edit', route('setting.reward.update', $setting));
});


// Dashboard
Breadcrumbs::for('error.404', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Error 404');
});


// Profile
Breadcrumbs::for('profile.update', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Profile', route('profile.edit'));
});

// Profile > Edit
Breadcrumbs::for('password.update', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Password Update', route('password.edit'));
});

// WA Template
Breadcrumbs::for('wa-template.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('WA template', route('wa-template.index'));
});
// WA Template > Create
Breadcrumbs::for('wa-template.create', function ($trail) {
    $trail->parent('wa-template.index');
    $trail->push('Add', route('wa-template.create',));
});
// WA Template > Edit
Breadcrumbs::for('wa-template.edit', function ($trail,$res) {
    $trail->parent('wa-template.index');
    $trail->push('Edit', route('wa-template.edit',$res));
});


?>