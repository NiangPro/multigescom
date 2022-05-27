<div class="main-sidebar" style="position: fixed;">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="{{route("home")}}">
            <figure >
                @if (Auth()->user()->entreprise_id !== null)

                    <img class="avatar mr-2" src="{{asset('storage/images/'.Auth()->user()->entreprise->profil)}}" alt="logo">{{Auth()->user()->entreprise->nom}}
                @else
                    <img class="avatar mr-2" src="{{asset('storage/images/'.config('app.logo'))}}" alt="logo">{{config('app.name')}}
                @endif
              </figure>
            </a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{route("home")}}">
            @if (Auth()->user()->entreprise_id !== null)
                {{Auth()->user()->entreprise->sigle}}
            @else
                GC
            @endif
        </a>
      </div>
      <ul class="sidebar-menu">


          <li class="@if ($page == "home") active @endif"><a class="nav-link" href="{{route('home')}}"><i class="fas fa-fire"></i> <span>Tableau de bord</span></a></li>
          @if (Auth()->user()->role === 'Super Admin')

          <li class="menu-header">Super Admin</li>
          <li class="@if ($page == "entreprise") active @endif"><a class="nav-link" href="{{route('entreprises')}}"><i class="fas fa-th-large"></i> <span>Entreprises</span></a></li>
          <li class="@if ($page == "users") active @endif"><a class="nav-link" href="{{route('users')}}"><i class="fas fa-users-cog"></i> <span>Utilisateurs</span></a></li>
          @elseif (Auth()->user()->role === 'Admin')
          <li class="menu-header">Admin</li>
          <li class="@if ($page == "staticData") active @endif"><a class="nav-link" href="{{route('staticData')}}"><i class="fa fa-database" aria-hidden="true"></i> <span>Données Statiques</span></a></li>
          <li class="@if ($page == "employe") active @endif"><a class="nav-link" href="{{route('employe')}}"><i class="fas fa-user-friends"></i> <span>Employés</span></a></li>

          @endif
          <li class="@if ($page == "history") active @endif"><a class="nav-link" href="{{route('history')}}"><i class="fa fa-history" aria-hidden="true"></i> <span>Historiques</span></a></li>

          <li class="menu-header">Configurations </li>
          <li class="nav-item dropdown @if ($page == "profil" || $page == "password"  || $page == "general") active @endif">
            <a href="#" class="nav-link has-dropdown"><i class="fa fa-cogs" aria-hidden="true"></i> <span>Parametres  <span class="text-primary"><button class="btn btn-primary btn-sm btn-icon">3</button></span> </span></a>
            <ul class="dropdown-menu">
                <li  class="@if ($page == "profil") active @endif"><a href="{{route('profil')}}"><i class="fa fa-user-circle" aria-hidden="true"></i> Profil</a></li>
                <li class="@if ($page == "password") active @endif"><a href="{{route('password')}}"><i class="fa fa-lock" aria-hidden="true"></i>Mot de passe</a></li>
                @if (Auth()->user()->role === 'Admin' || Auth()->user()->role === 'Super Admin')
                <li class="@if ($page == "general") active @endif"><a href="{{route('general')}}"><i class="fa fa-wrench" aria-hidden="true"></i> General</a></li>
            @endif
            </ul>
          </li>

        </ul>

    </aside>
  </div>
