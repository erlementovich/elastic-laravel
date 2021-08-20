<form action="{{ route('search') }}" method="get">
    <div class="form-group">
        <input
            type="text"
            name="q"
            class="form-control"
            placeholder="Search..."
            value="{{ request('q') }}"
        />
    </div>
</form>
