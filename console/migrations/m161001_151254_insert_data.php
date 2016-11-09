<?php

use console\migrations\Migration;
use backend\models\Admin;
use backend\models\User;
use common\models\Category;

class m161001_151254_insert_data extends Migration
{
    public function up()
    {
        $admin = new Admin();
        $admin->username = "admin";
        $admin->email = "admin@admin.com";
        $admin->setPassword("adminadmin");
        $admin->generateAuthKey();
        $admin->save();

        $user = new User();
        $user->username = "user";
        $user->email = "user@user.com";
        $user->setPassword("useruser");
        $user->generateAuthKey();
        $user->save();

        $category = new Category();
        $category->name = 'Music';
        $category->save();

        $category = new Category();
        $category->name = 'IT';
        $category->save();

        $category = new Category();
        $category->name = 'Sport';
        $category->save();
    }

    public function down()
    {
        $this->delete("admin", ['username' => 'admin']);
        $this->delete("user", ['username' => 'user']);
        $this->delete("category", ['name' => 'Music']);
        $this->delete("category", ['name' => 'IT']);
        $this->delete("category", ['name' => 'Sport']);
    }

}
