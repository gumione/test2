<?php

use yii\db\Migration;

/**
 * Class m200906_024204_add_products
 */
class m200906_024204_add_products extends Migration
{
    public function up() {
        
        $this->insert('products', [
            'title' => 'Product 1',
            'image' => 'https://via.placeholder.com/140x100',
            'price' => '100',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        ]);

        $this->insert('products', [
            'title' => 'Product 2',
            'image' => 'https://via.placeholder.com/140x100',
            'price' => '100',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        ]);

        $this->insert('products', [
            'title' => 'Product 3',
            'image' => 'https://via.placeholder.com/140x100',
            'price' => '101',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        ]);

        $this->insert('products', [
            'title' => 'Product 4',
            'image' => 'https://via.placeholder.com/140x100',
            'price' => '102',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        ]);

        $this->insert('products', [
            'title' => 'Product 5',
            'image' => 'https://via.placeholder.com/140x100',
            'price' => '103',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        ]);

        $this->insert('products', [
            'title' => 'Product 6',
            'image' => 'https://via.placeholder.com/140x100',
            'price' => '104',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        ]);

        $this->insert('products', [
            'title' => 'Product 7',
            'image' => 'https://via.placeholder.com/140x100',
            'price' => '100',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        ]);
    }

    public function down() {
        $this->truncateTable('products');
    }
}
