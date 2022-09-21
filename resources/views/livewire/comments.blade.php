<div class="row w-100">
    <div class="col-md-12 mt-1">
        <h6 class="section-label mt-25">Tinggalkan Komentar</h6>
        <div class="card">
            <div class="card-body">
                <form class="form">
                    <div class="row">
                        <div class="col-12">
                            <textarea class="form-control mb-2" rows="4" wire:model="komentar" placeholder="Komentar" required></textarea>
                        </div>
                        <div class="col-12">
                            <button wire:click.prevent="store()" class="btn btn-primary">Komentar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-1" id="blogComment">
        <h6 class="section-label mt-25">Komentar</h6>
        @foreach($comments as $c)
        <div class="card">
            <div class="card-body">
                <div class="media">
                    <div class="avatar mr-75">
                        @if($c->pembuat->foto != null || $c->pembuat->foto != '')
                        <img src="{{ url('storage/images/profile/'.$c->pembuat->foto) }}" width="38" height="38" alt="Avatar" />
                        @else
                        <img class="round" src="{{ asset('images/default.jpg') }}" alt="avatar" height="40" width="40">
                        @endif
                    </div>
                    <div class="media-body">
                        <h6 class="font-weight-bolder mb-25">{{ $c->pembuat->nama }}</h6>
                        <p class="card-text">{{ tanggal_indonesia(date("Y-m-d", strtotime($c->created_at))) }}</p>
                        <p class="card-text">
                            {{ $c->komentar }}
                        </p>
                        <!-- <a href="javascript:void(0);">
                            <div class="d-inline-flex align-items-center">
                                <i data-feather="corner-up-left" class="font-medium-3 mr-50"></i>
                                <span>Reply</span>
                            </div>
                        </a> -->
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>