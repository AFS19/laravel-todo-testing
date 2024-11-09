<!DOCTYPE html>
<html>
<head>
    <title>Todo List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8">
<div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden p-6">
    <h1 class="text-2xl font-bold mb-6">My Todo List</h1>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Validation Errors -->
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Add Todo Form -->
    <form action="{{ route('todos.store') }}" method="POST" class="mb-6">
        @csrf
        <div class="flex gap-2">
            <input
                type="text"
                name="title"
                placeholder="New todo..."
                class="flex-1 p-2 border rounded @error('title') border-red-500 @enderror"
                value="{{ old('title') }}"
                required
            >
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                Add
            </button>
        </div>
    </form>

    <!-- Todo List -->
    <ul class="space-y-3">
        @forelse($todos as $todo)
            <li class="flex items-center gap-3 p-3 border rounded hover:bg-gray-50 transition">
                <form action="{{ route('todos.toggle', $todo) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="focus:outline-none">
                        @if($todo->completed)
                            <span class="text-green-500">✓</span>
                        @else
                            <span class="text-gray-300">○</span>
                        @endif
                    </button>
                </form>
                <span class="{{ $todo->completed ? 'line-through text-gray-400' : '' }}">
                        {{ $todo->title }}
                    </span>
            </li>
        @empty
            <li class="text-gray-500 text-center py-4">
                No todos yet! Add one above.
            </li>
        @endforelse
    </ul>
</div>
</body>
</html>
