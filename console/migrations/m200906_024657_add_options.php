<?php

use yii\db\Migration;

/**
 * Class m200906_024657_add_options
 */
class m200906_024657_add_options extends Migration
{
    public function up() {

        $this->insert('options', [
            'option_name' => 'header_bg',
            'option_value' => '#ffffff',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        ]);

        $this->insert('options', [
            'option_name' => 'product_bg',
            'option_value' => '#ffffff',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        ]);

        $this->insert('options', [
            'option_name' => 'domain_name',
            'option_value' => 'TEST SHOP',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        ]);
    }

    public function down() {
        $this->truncateTable('options');
    }
}
