<?php

use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = array(
            [
                'links_name' => '百度',
                'links_title' => '全球最大中文搜索引擎',
                'links_url' => 'http://www.baidu.com',
                'links_order' => 1,
                'created_at' => date('Y-m-d H:i:s',time()),
                'updated_at' => date('Y-m-d H:i:s',time()),
            ],
            [
                'links_name' => '淘宝网',
                'links_title' => '全球最大中文购物网站',
                'links_url' => 'http://www.taobao.com',
                'links_order' => 1,
                'created_at' => date('Y-m-d H:i:s',time()),
                'updated_at' => date('Y-m-d H:i:s',time()),
            ]
        );
        DB::table('links')->insert($data);
    }
}
