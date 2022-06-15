<body>
    <section class="body">

        <!-- start: header -->
        <header class="header">
            <div class="logo-container">
                <a href="../" class="logo">
                    <img src="{{ asset('/front') }}/images/logo-polinema-sayap.png" height="35" alt="Porto Admin" />
                </a>
                <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
                    <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                </div>
            </div>
            <!-- start: search & user box -->
            <div class="header-right">

                <!-- <form class="search nav-form">
                    <div class="input-group input-search">
                        <input type="text" class="form-control" name="q" id="q" placeholder="Search...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
                <span class="separator"></span> -->
                <?php

                use Illuminate\Support\Facades\Auth;

                if (Auth::user()->roles == 'KTU') {
                    $notif = App\Models\Validasi::where('validasi_ktu', 0)->where('validasi_koor', 0)->where('validasi_bmn', 0)->where('notif', 0)->get();
                } elseif (Auth::user()->roles == 'Koordinator') {
                    $notif = App\Models\Validasi::where('validasi_ktu', 1)->where('validasi_koor', 0)->where('validasi_bmn', 0)->where('notif', 0)->get();
                } elseif (Auth::user()->roles == 'BMN') {
                    $notif = App\Models\Validasi::where('validasi_ktu', 1)->where('validasi_koor', 1)->where('validasi_bmn', 0)->where('notif', 0)->get();
                }

                ?>
                <ul class="notifications">
                    @if(Auth::user()->roles == 'BMN')
                    <li>
                        <a href="#" class="notification-icon" id="ScanQRDraft" data-toggle="modal" data-target="#modalBootstrapScanDraf">
                            <i class="fa fa-qrcode"></i>
                        </a>
                    </li>
                    @endif
                    <li class="">
                        <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown" aria-expanded="true">
                            <i class="fa fa-bell"></i>
                            <span class="badge">{{ count($notif) }}</span>
                        </a>
                        <div class="dropdown-menu notification-menu">
                            <div class="notification-title">
                                Notifikasi
                            </div>

                            <div class="content">
                                <ul>
                                    @foreach($notif as $data)
                                    <li style="border-top: 1px solid #eee; padding-top: 5px;" class="hover-notif">
                                        <a href="/validasi/{{ $data->id }}" class="clearfix">
                                            <figure class="image">
                                                @if($data->user->photo_profile)
                                                <img src="{{  url('/storage/'. $data->user->photo_profile)}}" alt="{{$data->user->name}}" style="width: 4rem" class="img-circle">
                                                @else
                                                <img src="https://ui-avatars.com/api/?name={{$data->user->name}}" style="width: 4rem" alt="" class="img-circle">
                                                @endif
                                            </figure>
                                            <span class="title">{{$data->user->name}}</span>
                                            <span class="message">{{$data->keperluan}}</span>
                                            <?php
                                            if (Auth::user()->roles == 'KTU') {
                                                $waktu_awal = new DateTime($data->created_at);
                                            } else {
                                                $waktu_awal = new DateTime($data->updated_at);
                                            }
                                            $waktu_skrg = new DateTime();

                                            $diff = date_diff($waktu_awal, $waktu_skrg);

                                            if ($diff->y == 0 && $diff->m == 0 && $diff->d == 0 && $diff->h == 0 && $diff->i == 0) {
                                                $selisih = $diff->s . ' detik yg lalu';
                                            } elseif ($diff->y == 0 && $diff->m == 0 && $diff->d == 0 && $diff->h == 0 && $diff->i != 0) {
                                                $selisih = $diff->i . ' menit yg lalu';
                                            } elseif ($diff->y == 0 && $diff->m == 0 && $diff->d == 0 && $diff->h != 0) {
                                                $selisih = $diff->h . ' jam yg lalu';
                                            } elseif ($diff->y == 0 && $diff->m == 0 && $diff->d != 0) {
                                                $selisih = $diff->d . ' hari yg lalu';
                                            } elseif ($diff->y == 0 && $diff->m != 0) {
                                                $selisih = $diff->m . ' bulan yg lalu';
                                            } elseif ($diff->y != 0) {
                                                $selisih = $diff->y . ' tahun yg lalu';
                                            }
                                            ?>
                                            <span class="message text-right">{{$selisih}}</span>
                                    </li>
                                    @endforeach
                                </ul>

                                <hr>

                                <div class="text-right">
                                    <a href="#" class="view-more">View All</a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <span class="separator"></span>

                <div id="userbox" class="userbox">
                    <a href="#" data-toggle="dropdown">
                        <figure class="profile-picture">
                            @if(Auth::user()->photo_profile)
                            <img src="{{  url('/storage/'. Auth::user()->photo_profile)}}" alt="{{Auth::user()->name}}" class="img-rounded" />
                            @else
                            <img src="https://ui-avatars.com/api/?name={{Auth::user()->name}}" alt="{{Auth::user()->name}}" class="img-circle" />
                            @endif
                        </figure>
                        <div class="profile-info">
                            <span class="name">{{Auth::user()->name}}</span>
                            <span class="role">{{Auth::user()->roles}}</span>
                        </div>

                        <i class="fa custom-caret"></i>
                    </a>

                    <div class="dropdown-menu">
                        <ul class="list-unstyled">
                            <li class="divider"></li>
                            <li>
                                <a role="menuitem" tabindex="-1" href="/profile"><i class="fa fa-user"></i> My Profile</a>
                            </li>
                            <li>
                                <a role="menuitem" tabindex="-1" href="/edit"><i class="fa fa-gear"></i> Edit Profile</a>
                            </li>
                            <li>
                                <a role="menuitem" tabindex="-1" href="/changePassword"><i class="fa fa-cogs"></i> Change Password</a>
                            </li>
                            <hr class="dotted short">
                            <li>
                                <a role="menuitem" tabindex="-1" href="{{route('logout')}}" onclick=" event.preventDefault(); document.getElementById('formLogout').submit();">
                                    <i class="fa fa-power-off"></i> Logout
                                </a>
                                <form id="formLogout" action="{{ route('logout') }}" method="post">
                                    @csrf
                                </form>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <!-- end: search & user box -->
        </header>
        <!-- end: header -->