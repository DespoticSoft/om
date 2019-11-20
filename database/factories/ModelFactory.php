<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function(Faker $faker){
    $title = ['GM', 'President', 'Manager', 'Assistant Officer', 'Executirve Director', 'DGM', 'Accounts Officer', 'A.P.M', 'D.P.M', 'Chairman'];
    $title = $title[rand(0, sizeof($title)-1)];
    $gender = ['men', 'women'];
    $gender = $gender[rand(0, sizeof($gender)-1)];
    $id = rand(1, 20);

    $role = ['superadmin', 'admin', 'accounts', 'import', 'export', 'store', 'stock', 'production', 'marketing', 'supplier', 'client'];
    $role = $role[rand(0, sizeof($role)-1)];

//    $users = User::where('role','!=', 'client')->get();
    return [
        'name' => $faker->name,
        'image' => "https://randomuser.me/api/portraits/$gender/$id.jpg",
        'gender' => $gender,
        'username' => $faker->userName,
        'password' => Hash::make('password'),
        'company' => $role == 'client' ? '' : $faker->company,
        'title' => $title,
        'stuff_id' => $role == 'client' ? '' : 'Stuff-'.$id,
        'role' => $role,
        'email' => $role == 'client' ? $faker->email : $faker->companyEmail,
        'phone' => $faker->phoneNumber,
        'phone2' => $faker->phoneNumber,
        'messenger' => 'iamrindi',
        'nid' => $faker->creditCardNumber,
        'passport_id' => $faker->creditCardNumber,
        'bank_ac' => $faker->creditCardNumber,
        'address' => $faker->address,
        'dob' => $faker->dateTimeBetween('-50 years', '-20 years'),
        'bio' => $faker->paragraph
    ];
});

$factory->define(Product::class, function (Faker $faker){

    return [
        'name' => $faker->firstName,
        'image' => "https://picsum.photos/id/".rand(1,20)."/300/200",
        'qr' => 'https://images.vexels.com/media/users/3/158122/isolated/preview/39e6da6d7ac6e177c43e50a97eb9de4d-qr-code-sticker-by-vexels.png',
        'description' => $faker->paragraph,
        'category_id' => rand(1,3)
    ];
});
