<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $post = new Post();
        $post->user_id = '2';
        $post->content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla mollis nunc quis gravida venenatis. Aliquam convallis finibus tortor vel tincidunt. Morbi finibus auctor vulputate. Etiam viverra gravida posuere. Donec auctor vel dolor vitae luctus. Curabitur tincidunt finibus nunc eget sodales. Nam consectetur finibus ultrices. Nam eu justo dignissim, pretium nulla dapibus, faucibus magna. Nullam fringilla turpis eu massa pellentesque bibendum. Nullam consectetur lacus ipsum.';
        $post->save();

        $post = new Post();
        $post->user_id = '1';
        $post->content = 'Pellentesque tempus, purus ac feugiat pellentesque, purus diam aliquam massa, quis fringilla tellus massa quis orci. Aenean bibendum faucibus ipsum, quis porta felis auctor et. Morbi nec egestas sem, eu convallis felis. Curabitur pretium massa nec varius auctor. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris eu ullamcorper mauris. Mauris rutrum urna et enim consequat, a malesuada diam tincidunt. Duis ultrices dui sit amet euismod venenatis. Maecenas sed dolor metus. Mauris volutpat enim leo, eu maximus odio venenatis eu. Sed sem velit, rutrum in odio ac, ultrices posuere arcu. Phasellus eu lorem sit amet lectus feugiat posuere.';
        $post->save();

        $post = new Post();
        $post->user_id = '3';
        $post->content = 'Nam accumsan semper pretium. Phasellus pellentesque consequat libero mollis cursus. Donec eleifend vulputate lacus eu porttitor. Sed quis venenatis turpis, in congue neque. Curabitur scelerisque vehicula tellus, molestie pharetra justo mollis non. Aliquam vitae vestibulum sapien. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nunc congue tincidunt dui sit amet posuere';
        $post->save();


    }
}
