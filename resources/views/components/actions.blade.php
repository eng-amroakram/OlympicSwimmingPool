    <td>
        <div class="d-flex justify-content-center">
            @if ($delete)
                @can($delete, auth()->user())
                    <a type="button" class="text-danger  fa-lg me-2 ms-2" wire:click='delete({{ $id }})'
                        title="Delete">
                        <i class="fas fa-trash-can"></i>
                    </a>
                @endcan
            @endif

            @if ($edit)
                @can($edit, auth()->user())
                    <a type="button" class="text-dark  fa-lg me-2 ms-2" href="{{ $link }}" title="Edit">
                        <i class="far fa-pen-to-square"></i>
                    </a>
                @endcan
            @endif

            @if ($show)
                @can($show, auth()->user())
                    <a type="button" class="text-primary  fa-lg me-2 ms-2" href="#show"
                        wire:click="show({{ $id }})" title="Show">
                        <i class="fas fa-eye"></i>
                    </a>
                @endcan
            @endif

        </div>
    </td>
