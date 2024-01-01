<form action="/users/{{ $users->id }}/update" method="post" id="frmuseredit">
    @csrf
    <div class="form-group">
        <label for="">Nama</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $users->name }}">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" class="form-control" value="{{ $users->email }}">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" value="">
    </div>
    <button class="btn btn-primary" id="btnSimpanData">Kirim</button>
</form>
