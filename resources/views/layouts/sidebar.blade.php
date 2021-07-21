<ul class="nav">
    <li class="nav-item nav-profile">
        <div class="nav-link">
            <div class="user-wrapper">
                <div class="profile-image">
                    <?php
                $ava_s = Auth::user()->avatar;
                if(preg_match('@^https?://@', $ava_s )){
                    $avatars = $ava_s ;
                }else{
                    $avatars = asset('images/user/'.$ava_s );
                }
                ?>
                    @if(!empty(Auth::user()->avatar))
                    <img src="{{$avatars}}" alt="profile image">
                    @else
                    <img src="{{asset('images/user/ava.png')}}" alt="profile image">
                    @endif
                </div>
                <div class="text-wrapper">
                    <p class="profile-name">{{Auth::user()->name}}</p>
                    <div>
                        @if(Auth::user()->point<=100) <span class="badge"
                            style="background-color: #804A00; color: white;">Bronze User</span>
                            @elseif(Auth::user()->point>100 && Auth::user()->point<=500) <span
                                class="badge badge-secondary" style="background-color: #A8A9AD; color: white;">Silver
                                User</span>
                                @elseif(Auth::user()->point>500 && Auth::user()->point<=1000) <span
                                    class="badge badge-warning">Gold User</span>
                                    @else
                                    <span class="badge badge-info">Platinum User</span>
                                    @endif
                    </div>
                </div>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('/home')}}">
            <i class="menu-icon mdi mdi-television"></i>
            <span class="menu-title">Menu</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{url('/home')}}">
            <i class="menu-icon mdi mdi-home"></i>
            <span class="menu-title">Home</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{url('/kamar')}}">
            <i class="menu-icon mdi mdi-home-modern"></i>
            <span class="menu-title">Kamar</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('mt')}}">
            <i class="menu-icon mdi mdi-sofa"></i>
            <span class="menu-title">Ruangan</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('restaurant')}}">
            <i class="menu-icon mdi mdi-food"></i>
            <span class="menu-title">Food & Beverage </span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('mt')}}">
            <i class="menu-icon mdi mdi-tshirt-crew"></i>
            <span class="menu-title">Laundry</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('tagihan')}}">
            <i class="menu-icon mdi mdi-receipt"></i>
            <span class="menu-title">Checkout</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('list-tagihan')}}">
            <i class="menu-icon mdi mdi-receipt"></i>
            <span class="menu-title">Tagihan</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('akun')}}">
            <i class="menu-icon mdi mdi-account-settings-variant"></i>
            <span class="menu-title">Pengaturan Akun</span>
        </a>
    </li>



</ul>
