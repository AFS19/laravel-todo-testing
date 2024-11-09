<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodoTest extends TestCase
{
    use RefreshDatabase; // this trait will refresh our database for each test

    /** @test*/
//    public function a_user_can_create_a_todo()
//    {
//        // 1. Arrange - Prepare the data we want to use
//        $todoData = [
//            'title' => 'by m.afs',
//        ];
//
//        // 2. Act - Perform the action we want to test
//        $response = $this->post('/todos', $todoData);
//
//        // 3. Assert - Check if everything worked as expected
//        // Check if the todos was created in the database
//        $this->assertDatabaseHas('todos', $todoData);
//
//        // Check if we're redirected back after creation
//        $response->assertRedirect();
//    }

    /** @test */
//    public function a_user_can_see_all_todos()
//    {
//        // 1. Arrange - Create some todos
//        $todo1 = Todo::create(['title' => 'First Todo']);
//        $todo2 = Todo::create(['title' => 'Second Todo']);
//
//        // 2. Act - visit the todos page
//        $response = $this->get('/todos');
//
//        // 3. Assert - Check if we see our todos
//        $response->assertSee('First Todo');
//        $response->assertSee('Second Todo');
//    }

    /** @test */
    public function title_is_required_to_create_a_todo()
    {
        // Try to create a todo without a title
        $response = $this->post('/todos', [
            'title' => ''
        ]);

        // Assert that we get validation errors
        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_user_can_toggle_a_todo()
    {
        // Create a todo
        $todo = Todo::create([
            'title' => 'Toggle me'
        ]);

        // Toggle it
        $response = $this->patch("/todos/{$todo->id}");

        // Assert it was toggled
        $this->assertTrue($todo->fresh()->completed);

        // Toggle it again
        $response = $this->patch("/todos/{$todo->id}");

        // Assert it was toggled back
        $this->assertFalse($todo->fresh()->completed);
    }
}
