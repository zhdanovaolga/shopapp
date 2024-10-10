@extends("frontend.master")

<div class="col-lg-8 content">
    <div class="theiaStickySidebar">
        <div class="section-title">
            <h3>All categories</h3>
        </div>
        @forelse ($categories as $category)
        <div class="post-list post-list-style4">
            <div class="post-list-content">
                <ul class="entry-meta">
                    <li class="entry-cat">
                        <a href="{{ route("frontend.category", $category->id) }}" class="category-style-1">{{ $category->title }}</a>
                    </li>
                    <li class="post-date"> <span class="line"></span>{{ $category->created_at->format("F d, Y") }}</li>
                </ul>
                    <div class="post-single-description">
                        {!! $category->description !!}
                    </div>
            </div>
        </div>
        @empty
        <div>No category found!</div>
        @endforelse
        <div class="pagination">
            <div class="pagination-area">
            {{ $categories->links("vendor.pagination.custom") }}
            </div>
        </div>
    </div>
</div>