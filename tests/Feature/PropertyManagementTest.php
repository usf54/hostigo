<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PropertyManagementTest extends TestCase
{
    use RefreshDatabase;


    #[\PHPUnit\Framework\Attributes\Test]
    public function a_property_can_have_images()
    {
        $property = Property::factory()->create();

        $image1 = PropertyImage::create([
            'property_id' => $property->id,
            'image_url' => 'https://example.com/image1.jpg',
        ]);

        $image2 = PropertyImage::create([
            'property_id' => $property->id,
            'image_url' => 'https://example.com/image2.jpg',
        ]);

        $this->assertCount(2, $property->images);
        $this->assertEquals('https://example.com/image1.jpg', $property->images->first()->image_url);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function a_property_belongs_to_a_host()
    {
        $user = User::factory()->create();
        $property = Property::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $property->host);
        $this->assertEquals($user->id, $property->host->id);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function a_property_has_many_bookings()
    {
        $property = Property::factory()->create();
        $bookings = \App\Models\Booking::factory()->count(3)->create(['property_id' => $property->id]);

        $this->assertCount(3, $property->bookings);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function a_property_can_have_amenities()
    {
        $property = Property::factory()->create();
        $amenity = \App\Models\Amenity::factory()->create();

        $property->amenities()->attach($amenity);

        $this->assertTrue($property->amenities->contains($amenity));
    }
}
