@extends("backend.shared.backend_theme")
@section("title","Kullanıcı Modülü")
@section("subtitle","Kullanıcılar")
@section("btn_url",url("/users/create"))
@section("btn_label","Yeni Ekle")
@section("btn_icon","plus")
@section("content")
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th scope="col">Sıra No</th>
            <th scope="col">Ad Soyad</th>
            <th scope="col">Eposta</th>
            <th scope="col">Durum</th>
            <th scope="col">İşlemler</th>
        </tr>
        </thead>
        <tbody>
        @if(count($users) > 0)
            @foreach($users as $user)
                <tr id="{{$user->user_id}}">
                    <td>{{$loop->iteration}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        @if($user->is_active == 1)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-danger">Pasif</span>
                        @endif
                    </td>
                    <td>
                        <ul class="nav float-start">
                            <li class="nav-item">
                            <button type="button" class="btn btn-primary">
                                <a  class=" text-black" href="{{url("/users/$user->user_id/edit")}}">
                                    Güncelle
                                </a>
                            </button>
                            </li>
                           
                            <li class="nav-item">
                            <button type="button" class="btn btn-danger">
                                <a class=" text-black"
                                   href="/users/sil/{{$user->user_id}}">
                                    Sil
                                </a>
                                </button>
                            </li>
                            <li class="nav-item">
                            <button type="button" class="btn btn-success">
                                <a class="text-black"
                                   href="{{url("/users/$user->user_id/change-password")}}">
                                    <span data-feather="lock"></span>
                                    Şifre Değiştir
                                </a>
                                </button>
                            </li>
                            <li class="nav-item">
                            <button type="button" class="btn btn-info">
                                <a class="text-black"
                                   href="{{url("/users/$user->user_id/addresses")}}">
                                    <span data-feather="map-pin"></span>
                                    Adreslerim
                                </a>
                            </button>
                            </li>
                        </ul>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="5">
                    <p class="text-center">Herhangi bir kullanıcı bulunamadı.</p>
                </td>
            </tr>
        @endif
        </tbody>
    </table>
@endsection
