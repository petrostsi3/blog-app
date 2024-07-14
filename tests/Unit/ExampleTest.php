<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ExampleTest extends TestCase
{

    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * A User has many posts
     *
     * @return void
     * @test
     */
    public function task_1_user_has_many_posts()
    {
        // create new user
        $user = User::factory()->create();

        // add posts to the user
        Post::factory(5)->create([
            'author_id' => $user->id,
        ]);

        // user refreshing - in order that the user instance is reloaded , after post creation
        $user->refresh();
        $user->load('posts');
        
        $this->assertEquals(5, $user->posts->count());
    }

    /**
     * A post may have an author
     *
     * @return void
     * @test
     */
    public function task_2_a_blog_may_have_an_author()
    {
        // create new user
        $user = User::factory()->create();

        // add a post to the user
        $post = Post::factory()->create([
            'author_id' => $user->id,
        ]);

        $this->assertEquals($user->id ,$post->author->id);
    }

    /** @test */
    public function task_3_show_posts_by_author(){

        // create new user
        $user = User::factory()->create();

        // add posts to the user
        $posts = Post::factory(5)->create([
            'author_id' => $user->id,
        ]);

        $response = $this->get(route('user.posts',$user->id));

        $response->assertStatus(200);
        $response->assertSee($posts->first()->title);
    }

    public function task_4_assert_not_too_many_queries(){

        // create new user
        $user = User::factory()->create();

        // add posts to the user
        Post::factory(10)->create([
            'author_id' => $user->id,
        ]);

        // enables database query logging
        
        DB::enableQueryLog();

        $response = $this->get(route('index'));
        $response->assertStatus(200);


        // expect 10 posts
        $this->assertCount(10,$response->getOriginalContent()->getData()['posts']);

        // expect 3 queries
        $this->assertCount(3,DB::getQueryLog());
    }
}
