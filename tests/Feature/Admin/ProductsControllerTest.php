<?php

namespace Tests\Feature\Admin;

use App\Helpers\Enums\RolesEnum;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use App\Services\FileStorageService;
use Database\Seeders\CategoryProductsSeeder;
use Database\Seeders\RolesTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProductsControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function afterRefreshingDatabase()
    {
        $this->seed(RolesTableSeeder::class);
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->user = $this->getUser();
    }

    public function test_alL_products_rendered()
    {
        $this->seed(CategoryProductsSeeder::class);
        $response = $this->actingAs($this->user)->get(route('admin.products.index'));

        $products = Product::paginate(10)->pluck('title')->toArray();

        $response->assertStatus(200);
        $response->assertViewIs('admin.products.index');
        $response->assertSeeInOrder($products);
    }

    public function test_create_product()
    {
        $file = UploadedFile::fake()->image('test.png');
        $productData = [
            'thumbnail' => $file
        ];

        FileStorageService::shouldReceive('upload')
            ->once()
            ->with($file)
            ->andReturn('test');


        // check if count of products equal 0
        // post request -> (controller::store)
        // get product
        // redirect
        // session has status
//       check if count of products equal 1
        // product->title = $productData['title']

    }

    protected function getUser(): User
    {
        return User::factory()->admin()->create();
    }
}
