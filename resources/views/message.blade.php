
@include('layout_frontend.head')
<div class="container mt-5">

    @if (session('complete'))
        <div class="alert alert-warning" role="alert">
            <div class="text text-center">
                <h4>Pesan Terkirim</h4>
                <p class="mt-2">Jangan beritahu {{$show->nama}} bahwa Anda telah mengirim pesan.</p>
                <a href="/" class="btn btn-blue btn-block">Daftar Sekarang</a>
            </div>
        </div>
    @endif

    <div class="message">
        <div class="jumbotron">
            <div class="alert alert-info" role="alert">
                <div class="text text-center">
                    <h4>KIRIM PESAN TAK DIKENAL KEPADA</h4>
                    <h4 style="text-transform: uppercase;">{{$show->nama}}</h4>
                    <div class="text-left mt-2 ml-2">
                        <ul>
                            <li>{{$show->nama}} tidak akan pernah tahu yang mengirim pesan ini</li>
                        </ul>
                    </div>
                </div>
            </div>
                    <form action="message/simpan" method="POST">
                    @csrf
                        <input type="text" value="{{$show->number}}" readonly hidden name="number" >
                        <div class="form-group mt-3">
                            <textarea class="form-control input-black" autofocus="true" name="pesan" rows="3" placeholder="Tulis Pesan Rahasia"></textarea>
                            @error('pesan')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>            
                        <button type="submit" class="btn btn-blue btn-block">Ajukan Pesan</button>
                    </form>

                    <h5 class="form-text mt-4">Bagikan Ke :</h5>
                    <div class="box-sosmed">
                        <a href="https://api.whatsapp.com/send?text=Kirim%20pesan%20rahasia%20ke%20{{$show->nama}}%20%0ALink%20:%20https://qeui.000webhostapp.com/{{$show->number}}">
                            <div class="box" id="wa">
                                <img src="{{asset('frontend')}}/img/wa.png" class="img-fluid" width="20px">
                            </div>
                        </a>
                        <div class="box" id="fb">
                            <i class="ti ti-facebook"></i>
                        </div>
                    </div>
                
        </div>
    </div>

    @foreach ($alldb as $row)
    @if ($row->id_number == $show->number)
    <div class="pesan">
        <div class="jumbotron">
            <div class="row d-flex align-items-center">
                <div class="col-sm-11">
                    <h6>{{$row->pesan}}</h6>
                </div>
            </div>
            <div class="form-group mt-4">
                <form action="quei/balas" method="POST">
                @csrf
                    <input type="text" class="form-control" name="number" value="{{$show->number}}" readonly hidden>
                    <input type="text" class="form-control" name="id_pesan" value="{{$row->id_pesan}}" readonly hidden>
                    <input type="text" class="form-control input-black" name="balas" placeholder="Tulis Komentar">
                    @error('balas')
                        <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                    <button type="submit" class="btn btn-block btn-blue mt-2">Balas</button>
                </form>
            </div>

            @foreach ($balas as $kjk)
                @if ($kjk->no_user == $show->number && $kjk->id_pesan == $row->id_pesan)
                    <hr>
                    <div class="col-sm-11">
                        <h6>{{$kjk->pesan}}</h6>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    @endif
    @endforeach
</div>

@include('layout_frontend.script')