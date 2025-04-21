<?php



use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::redirect('/', '/admin/dashboard');

    // Dashboard
    Route::get('/dashboard', \App\Livewire\Pages\Dashboard::class)->name('dashboard');

    // Skills
    Route::get('/skills', \App\Livewire\Pages\Skills\Index::class)->name('skills.index');

    // Jobs
    Route::get('/jobs', \App\Livewire\Pages\Jobs\Index::class)->name('jobs.index');
    Route::get('/jobs/create', \App\Livewire\Pages\Jobs\Create::class)->name('jobs.create');
    Route::get('/{job}/edit', \App\Livewire\Pages\Jobs\Edit::class)->name('edit');

});
