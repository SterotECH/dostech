<div>
    <div class="flex items-center justify-between mb-6 gap-x-6">
        @if ($selected)
            <div class="relative" x-data="{ open: false }" wire:transition>
                <x-ellipsis-vertical @click="open = ! open" />

                <div x-show="open" @click.away="open = false"
                    class="absolute z-10 mt-2 bg-white border rounded shadow-lg">
                    <x-button wire:click="deleteSelected">Delete Selected</x-button>
                    <x-button wire:click="exportSelected('excel')">Export to
                        Excel</x-button>
                    <x-button wire:click="exportSelected('pdf')">Export to
                        PDF</x-button>
                </div>
            </div>
        @endif

        <x-select wire:model.live='perPage' class="rounded-md shadow-sm form-select">
            @foreach ($pageList as $item)
                <option value="{{ $item }}">{{ $item }}</option>
            @endforeach
        </x-select>

        <x-select wire:model.live="class" class="block w-full mt-1 rounded-md shadow-sm form-select">
            <option value="">All Classes</option>
            @foreach ($classes as $class)
                <option value="{{ $class->id }}">{{ Str::title($class->name) }}</option>
            @endforeach
        </x-select>

        <x-select wire:model.live="department" class="block w-full mt-1 rounded-md shadow-sm form-select">
            <option value="">All Departments</option>
            @foreach ($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
        </x-select>

        <x-select wire:model.live="house" class="block w-full mt-1 rounded-md shadow-sm form-select">
            <option value="">All Houses</option>
            @foreach ($houses as $house)
                <option value="{{ $house->id }}">{{ $house->name }}</option>
            @endforeach
        </x-select>
    </div>
    <div wire:loading.class='opacity-30' class="relative">
        <!-- Skeleton Loader -->
        <div wire:loading.delay wire:target="search, class, department, house, perPage"
            class="absolute inset-0 flex items-center justify-center">
            <div class="space-y-4">
                @for ($i = 0; $i < 10; $i++)
                    <tr>
                        <x-td colspan='6'>
                            <x-skeleton />
                        </x-td>
                    </tr>
                @endfor
            </div>
        </div>
        <x-table>
            <x-thead>
                <tr>
                    <x-th>
                        <x-checkbox wire:model.live="selectAll" />
                    </x-th>
                    <x-th>Name</x-th>
                    <x-th>House</x-th>
                    <x-th>Department</x-th>
                    <x-th>Due Owed</x-th>
                    <x-th>Class</x-th>
                    <x-th>
                        <span class="sr-only">Actions</span>
                    </x-th>
                </tr>
            </x-thead>
            <x-tbody>
                @foreach ($students as $student)
                    <x-tr wire:key="{{ $student->id }}">
                        <x-td>
                            <x-checkbox wire:model.live="selected" value="{{ $student->id }}" />
                        </x-td>
                        <x-td>{{ $student->first_name . ' ' . $student->last_name }}</x-td>
                        <x-td>{{ $student->house->name }}</x-td>
                        <x-td>{{ $student->department->name }}</x-td>
                        <x-td>{{ $student->dues_owed }}</x-td>
                        <x-td>{{ Str::title($student->classes->name) }}</x-td>
                        <x-td>
                            <x-button wire:click="edit({{ $student->id }})" size="sm">Edit</x-button>
                            <x-button wire:click="view({{ $student->id }})" variant="secondary" size="sm">View</x-button>
                        </x-td>
                    </x-tr>
                @endforeach
            </x-tbody>
        </x-table>
        <div class="mt-4">
            {{ $students->links() }}
        </div>
    </div>
</div>
