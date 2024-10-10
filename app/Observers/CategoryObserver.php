<?php

namespace App\Observers;

use App\Models\Category;

class CategoryObserver
{
    /**
     * Handle the Category "created" event.
     */
    public function created(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $category): void
    {
        $category->books()->delete();
    }

    /**
     * Handle the Category "restoring" event.
     */
    public function restoring(Category $category): void
    {
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Category $category): void
    {
        //
    }
}
