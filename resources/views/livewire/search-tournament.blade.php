<div class="">
    <input class="form-control input" wire:model="search" type="text" placeholder="Cari Tournament.." tabindex="-1" data-search="search">
    <ul class="">
        @if($search != '')
            @foreach($tournament as $data)
                <li class="d-flex align-items-center">
                    <a href="{{ url('tournament/detail/'.$data->slug) }}">
                        <h6 class="section-label mt-75 mb-2">{{ $data->nama }}</h6>
                    </a>
                </li>
            @endforeach
        @endif
    </ul>
</div>
