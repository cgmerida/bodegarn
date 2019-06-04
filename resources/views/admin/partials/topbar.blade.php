<div class="header navbar">
    <div class="header-container">
        <ul class="nav-left">
            <li>
                <a id='sidebar-toggle' class="sidebar-toggle" href="javascript:void(0);">
                    <i class="ti-menu"></i>
                </a>
            </li>
            <li class="search-box">
                <a class="search-toggle no-pdd-right" href="javascript:void(0);">
                    <i class="search-icon ti-search pdd-right-10"></i>
                    <i class="search-icon-close ti-close pdd-right-10"></i>
                </a>
            </li>
            <li class="search-input">
                <input class="form-control" type="text" placeholder="Buscar...">
            </li>
        </ul>
        <ul class="nav-right">
            <li class="notifications dropdown">
                <span class="counter bgc-red">{{ App\Material::whereRaw('stock <= min')->count() }}</span> 
                <a href="" class="dropdown-toggle no-after" data-toggle="dropdown">
                    <i class="ti-bell"></i>
                </a>
                <ul class="dropdown-menu">
                    <li class="pX-20 pY-15 bdB"><i class="ti-bell pR-10"></i> 
                        <span class="fsz-sm fw-600 c-grey-900">Notificaciones</span>
                    </li>
                    @foreach (App\Material::whereRaw('stock <= min')->select('name')->limit(3)->get() as $material)
                        <li>
                            <ul class="ovY-a pos-r scrollable lis-n p-0 m-0 fsz-sm ps">
                                <li>
                                    <a href="" class="peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100">
                                        <div class="peer peer-greed">
                                            <span>
                                                <span class="fw-500">{{ $material->name }}</span>
                                                <span class="c-grey-600">
                                                    ha alcanzado el <span class="text-dark">minimo</span>
                                                    de stock
                                                </span>
                                            </span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endforeach 
                    <li class="pX-20 pY-15 ta-c bdT">
                        <span>
                            <a href="{{ route('materials.index') }}" class="c-grey-600 cH-blue fsz-sm td-n">
                                Ver todas las notificaciones <i class="ti-angle-right fsz-xs mL-10"></i>
                            </a>
                        </span>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="" class="dropdown-toggle no-after peers fxw-nw ai-c lh-1" data-toggle="dropdown">
                    <div class="peer mR-10">
                        <img class="w-2r bdrs-50p" src="{{ asset('images/1.jpg') }}" alt="Avatar">
                    </div>
                    <div class="peer">
                        <span class="fsz-sm c-grey-900">{{ auth()->user()->name }}</span>
                    </div>
                </a>
                <ul class="dropdown-menu fsz-sm">
                    <li>
                        <a href="" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
                            <i class="ti-user mR-10"></i>
                            <span>Perfil</span>
                        </a>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li>
                        <a class="d-b td-n pY-5 bgcH-grey-100 c-red-500" 
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="ti-power-off mR-10"></i>
                            <span>Cerrar Sesión</span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
