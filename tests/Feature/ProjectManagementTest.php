<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProjectManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_a_project_with_thumbnail_upload(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('projects.store'), [
                'title' => 'Website Portfolio Modern',
                'summary' => 'Ringkasan proyek portfolio.',
                'description' => 'Deskripsi panjang untuk proyek portfolio modern.',
                'project_url' => 'https://example.com',
                'github_url' => 'https://github.com/example/portfolio',
                'thumbnail' => $this->fakeImageUpload('portfolio.png'),
                'is_published' => '1',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('projects.index'));

        $project = Project::query()->first();

        $this->assertNotNull($project);
        $this->assertSame('website-portfolio-modern', $project->slug);
        $this->assertNotNull($project->thumbnail);
        Storage::disk('public')->assertExists($project->thumbnail);
    }

    public function test_project_can_be_updated_and_replace_existing_thumbnail(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $oldThumbnail = $this->fakeImageUpload('old-thumbnail.png')->store('projects/thumbnails', 'public');

        $project = Project::create([
            'title' => 'Project Lama',
            'slug' => 'project-lama',
            'summary' => 'Ringkasan lama.',
            'description' => 'Deskripsi lama.',
            'thumbnail' => $oldThumbnail,
            'project_url' => 'https://example.com/old',
            'github_url' => 'https://github.com/example/old',
            'is_published' => true,
        ]);

        $response = $this
            ->actingAs($user)
            ->post(route('projects.update', $project), [
                '_method' => 'PUT',
                'title' => 'Project Baru',
                'summary' => 'Ringkasan baru.',
                'description' => 'Deskripsi baru.',
                'project_url' => 'https://example.com/new',
                'github_url' => 'https://github.com/example/new',
                'thumbnail' => $this->fakeImageUpload('new-thumbnail.png'),
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('projects.index'));

        $project->refresh();

        $this->assertSame('Project Baru', $project->title);
        $this->assertSame('project-baru', $project->slug);
        $this->assertSame('Ringkasan baru.', $project->summary);
        Storage::disk('public')->assertMissing($oldThumbnail);
        Storage::disk('public')->assertExists($project->thumbnail);
    }

    public function test_project_can_be_deleted_and_thumbnail_is_removed_from_storage(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $thumbnail = $this->fakeImageUpload('thumbnail.png')->store('projects/thumbnails', 'public');

        $project = Project::create([
            'title' => 'Project Hapus',
            'slug' => 'project-hapus',
            'summary' => 'Ringkasan hapus.',
            'description' => 'Deskripsi hapus.',
            'thumbnail' => $thumbnail,
            'project_url' => null,
            'github_url' => null,
            'is_published' => false,
        ]);

        $response = $this
            ->actingAs($user)
            ->delete(route('projects.destroy', $project));

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('projects.index'));

        $this->assertDatabaseMissing('projects', [
            'id' => $project->id,
        ]);
        Storage::disk('public')->assertMissing($thumbnail);
    }

    protected function fakeImageUpload(string $name): UploadedFile
    {
        $png = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+aN1QAAAAASUVORK5CYII=');

        return UploadedFile::fake()->createWithContent($name, $png);
    }
}
