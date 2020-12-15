<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown"
                        data-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('template/production/images/user.png') }}"
                            alt="">{{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item" id="gantipassword"> Ganti Password <i
                                class="fa fa-cogs pull-right"></i></a>

                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out pull-right"></i> Log Out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="GET"
                            class="d-none">
                            @csrf
                        </form>
                    </div>
                    <div>
                        <form id="form1"
                            action="{{ route('ganti.password',Auth::user()->id) }}"
                            method="POST"
                            style="padding: 15px;border: 1px solid #666;display: none;border-radius: 5px;background: #fff;z-index: 9;position: fixed;right: 15px;top: 5em">
                            {{ csrf_field() }}
                            <div class="row"
                                class="form-group{{ $errors->has('pas_lama') ? ' has-error' : '' }}">
                                <div class="col-5"><b>password lama: </b></div>
                                <div class="col-7"><input id="pas_lama" type="password" name="pas_lama" autofocus
                                        style="border-radius: 5px;border: solid #666 1px"></div>
                                <span class="help-block">{{ $errors->first('pas_lama') }}</span>
                            </div>
                            <br>
                            <div class="row"
                                class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="col-5"><b>Password Baru: </b></div>
                                <div class="col-7"><input id="password" type="password" name="password"
                                        style="border-radius: 5px;border: solid #666 1px"></div>
                                <span class="help-block">{{ $errors->first('password') }}</span>
                            </div>
                            <br>
                            <div class="row"
                                class="form-group{{ $errors->has('pas_confr') ? ' has-error' : '' }}">
                                <div class="col-5"><b>Confirm Password: </b></div>
                                <div class="col-7"><input id="pas_confr" type="password" name="pas_confr"
                                        style="border-radius: 5px;border: solid #666 1px"></div>
                                <span class="help-block">{{ $errors->first('pas_confr') }}</span>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col"></div>
                                <div class="col"><button type="submit" class="btn btn-success btn-sm"
                                        id="submit">Ganti</button></div>
                                <div class="col"><button type="button" class="btn btn-warning btn-sm" id="close"
                                        onclick="closeForm()">Close</button></div>
                                <div class="col"></div>
                            </div>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        @if(session()->has('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function () {
            $("#gantipassword").click(function () {
                $("#form1").toggle();
            });
        });

        function closeForm() {
            $("#form1").toggle();
        }

    </script>
@endpush
