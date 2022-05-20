
@include('layout_frontend.head')

<div class="container">
    <div class="content-add">
        <div class="jumbotron mt-5">
            <div class="alert alert-info" role="alert">
                <div class="text text-center">
                    <h4>Dapatkan balasan jujur dari Teman-teman Anda tanpa dikenali</h4>
                    <div class="text-left mt-2 ml-2">
                        <ul>
                            <li>Dapatkan balasan jujur dari Teman-teman & Teman Kerja Anda.</li>
                            <li>Tingkatkan Hubungan Pertemanan dengan menemukan Kekuatan dan area Kemajuan Anda</li>
                        </ul>
                    </div>
                </div>
              </div>
            <form action="/add/simpan" method="POST">
            @csrf
                <div class="form-group mt-3">
                    <input type="text" class="form-control" name="nama" autofocus="true" placeholder="Nama Anda">
                    @error('nama')
                        <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>         
                <button type="submit" class="btn btn-blue btn-block">Masuk</button>
            </form>
        </div>
    </div>
</div>

@include('layout_frontend.script')