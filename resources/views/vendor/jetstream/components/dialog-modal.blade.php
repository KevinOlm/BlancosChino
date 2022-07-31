@props(['id' => null, 'maxWidth' => null])

<x-jet-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="modalContainer">
        <div class="titleSection">
            <h3>{{ $title }}</h3>
        </div>

        {{ $content }}
    </div>

    <div class="actionsContent">
        {{ $footer }}
    </div>
</x-jet-modal>
