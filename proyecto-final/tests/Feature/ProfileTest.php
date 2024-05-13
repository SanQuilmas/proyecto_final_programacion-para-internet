<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Autor;
use App\Models\Libro;
use App\Models\ISBN;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/profile');

        $response->assertOk();
    }

    public function test_profile_information_can_be_updated(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $user->refresh();

        $this->assertSame('Test User', $user->name);
        $this->assertSame('test@example.com', $user->email);
        $this->assertNull($user->email_verified_at);
    }

    public function test_email_verification_status_is_unchanged_when_the_email_address_is_unchanged(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => 'Test User',
                'email' => $user->email,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $this->assertNotNull($user->refresh()->email_verified_at);
    }

    public function test_user_can_delete_their_account(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete('/profile', [
                'password' => 'password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $this->assertGuest();
        $this->assertNull($user->fresh());
    }

    public function test_correct_password_must_be_provided_to_delete_account(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from('/profile')
            ->delete('/profile', [
                'password' => 'wrong-password',
            ]);

        $response
            ->assertSessionHasErrorsIn('userDeletion', 'password')
            ->assertRedirect('/profile');

        $this->assertNotNull($user->fresh());
    }
    
    //--------------------------------------------------------------------------------------------
    
    public function testUserCanAccessRouteAndSeeTextLibrosIndex()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/libros');
        
        $response->assertOk();
        $response->assertSeeText('Libros');
    }
    public function testUserCanAccessRouteAndSeeTextAutorIndex()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/autors');
        
        $response->assertOk();
        $response->assertSeeText('Autors');
    }
    public function testUserCanAccessRouteAndSeeTextISBNIndex()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/isbn');
        
        $response->assertOk();
        $response->assertSeeText('ISBN');
    }
    public function testUserCanAccessRouteAndSeeTextAdminTable()
    {
        $user = User::factory()->create([
            'is_admin' => '1',
        ]);

        $response = $this->actingAs($user)->get('/admin/index');
        
        $response->assertOk();
        $response->assertSeeText('Datos');
    }

    //------------------------------------------------------------------------

    public function testUserCanCreateRecordAndRedirectOnPostRequestAutor()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('autors.store'), [
            'nombre' => 'Nombre del autor',
        ]);

        $response->assertStatus(302); // Redireccionamiento
        $this->assertDatabaseHas('autors', [
            'nombre' => 'Nombre del autor',
        ]);
    }

    public function testUserGetsValidationErrorsOnIncorrectPostRequestAutor()
    {
        $user = User::factory()->create();
    
        $response = $this->actingAs($user)->post(route('autors.store'), [
            // No proporcionar el nombre del autor
        ]);
    
        $response->assertStatus(302); 
        $response->assertSessionHasErrors('nombre');
    }

    public function testUserCanDeleteRecordAndRedirectAutor()
    {
        $user = User::factory()->create();
        $autor = Autor::factory()->create();
        $response = $this->actingAs($user)->delete(route('autors.destroy', $autor->id));

        $response->assertStatus(302); // Redireccionamiento
        $this->assertSoftDeleted('autors', [
            'id' => $autor->id,
        ]);
    }

    //------------------------------------------------------------------------

    public function testUserCanCreateRecordAndRedirectOnPostRequestLibro()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('libros.store'), [
            'titulo' => 'Nombre del libro',
        ]);

        $response->assertStatus(302); // Redireccionamiento
        $this->assertDatabaseHas('libros', [
            'titulo' => 'Nombre del libro',
        ]);
    }

    public function testUserGetsValidationErrorsOnIncorrectPostRequestLibro()
    {
        $user = User::factory()->create();
    
        $response = $this->actingAs($user)->post(route('libros.store'), [
            // No proporcionar el nombre del autor
        ]);
    
        $response->assertStatus(302); 
        $response->assertSessionHasErrors('titulo');
    }

    public function testUserCanDeleteRecordAndRedirectLibro()
    {
        $user = User::factory()->create();
        $libro = Libro::factory()->create();
        $response = $this->actingAs($user)->delete(route('libros.destroy', $libro->id));

        $response->assertStatus(302); // Redireccionamiento
        $this->assertSoftDeleted('libros', [
            'id' => $libro->id,
        ]);
    }

    //------------------------------------------------------------------------

    public function testUserCanCreateRecordAndRedirectOnPostRequestISBN()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('isbn.store'), [
            'isbn' => 'isbn',
            'libro' => 13,
        ]);

        $response->assertStatus(302); // Redireccionamiento
        $this->assertDatabaseHas('i_s_b_n_s', [
            'isbn' => 'isbn',
            'libro_id' => 13,
        ]);
    }

    public function testUserGetsValidationErrorsOnIncorrectPostRequestISBN()
    {
        $user = User::factory()->create();
    
        $response = $this->actingAs($user)->post(route('isbn.store'), [
            // No proporcionar el nombre del autor
        ]);
    
        $response->assertStatus(302); 
        $response->assertSessionHasErrors('isbn');
    }

    public function testUserCanDeleteRecordAndRedirectISBN()
    {
        $user = User::factory()
            ->create();
        $isbn = ISBN::factory()
            ->create([
                'libro_id' => 13,
            ]);
        $response = $this->actingAs($user)->delete(route('isbn.destroy', $isbn->id));

        $response->assertStatus(302); // Redireccionamiento
        $this->assertSoftDeleted('i_s_b_n_s', [
            'id' => $isbn->id,
        ]);
    }

}
