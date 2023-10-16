@if(Auth::guard('admin')->check())
<nav class="pcoded-navbar">
  <div class="nav-list">
    <div class="pcoded-inner-navbar main-menu">
      <div class="pcoded-navigation-label">Dashboard</div>
        <ul class="pcoded-item pcoded-left-item">
          <li class="{{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
            <a href="{{ route('dashboard.index') }}" class="waves-effect waves-dark">
              <span class="pcoded-micon">
                <i class="feather icon-home"></i>
              </span>
              <span class="pcoded-mtext">ပင်မ စာမျက်နှာ</span>
            </a>
          </li>
        </ul>
        <div class="pcoded-navigation-label">Games</div>
        <ul class="pcoded-item pcoded-left-item">
          <li class="{{ request()->routeIs('game-types.index') ? 'active' : '' }}">
            <a href="{{ route('game-types.index') }}" class="waves-effect waves-dark">
              <span class="pcoded-micon">
                <i class="feather icon-home"></i>
              </span>
              <span class="pcoded-mtext">Types</span>
            </a>
          </li>
          <li class="{{ request()->routeIs('game-providers.index') ? 'active' : '' }}">
            <a href="{{ route('game-providers.index') }}" class="waves-effect waves-dark">
              <span class="pcoded-micon">
                <i class="feather icon-home"></i>
              </span>
              <span class="pcoded-mtext">Providers</span>
            </a>
          </li>
          <li class="{{ request()->routeIs('bettings.index') ? 'active' : '' }}">
            <a href="{{ route('bettings.index') }}" class="waves-effect waves-dark">
              <span class="pcoded-micon">
                <i class="feather icon-home"></i>
              </span>
              <span class="pcoded-mtext">Bettings</span>
            </a>
          </li>
        </ul>
        
        <div class="pcoded-navigation-label">မိတ်ဖက်များ</div>
        <ul class="pcoded-item pcoded-left-item">
          <li class="{{ request()->routeIs('supers.index') ? 'active' : '' }}">
            <a href="{{ route('supers.index') }}" class="waves-effect waves-dark">
              <span class="pcoded-micon">
                <i class="feather icon-home"></i>
              </span>
              <span class="pcoded-mtext">စူပါများ</span>
            </a>
          </li>
          <li class="{{ request()->routeIs('seniors.index') ? 'active' : '' }}">
            <a href="{{ route('seniors.index') }}" class="waves-effect waves-dark">
              <span class="pcoded-micon">
                <i class="feather icon-home"></i>
              </span>
              <span class="pcoded-mtext">စီနီယာများ</span>
            </a>
          </li>
          <li class="{{ request()->routeIs('masters.index') ? 'active' : '' }}">
            <a href="{{ route('masters.index') }}" class="waves-effect waves-dark">
              <span class="pcoded-micon">
                <i class="feather icon-home"></i>
              </span>
              <span class="pcoded-mtext">မာစတာများ</span>
            </a>
          </li>
          <li class="{{ request()->routeIs('agents.index') ? 'active' : '' }}">
            <a href="{{ route('agents.index') }}" class="waves-effect waves-dark">
              <span class="pcoded-micon">
                <i class="feather icon-home"></i>
              </span>
              <span class="pcoded-mtext">အေးဂျင့်များ</span>
            </a>
          </li>
          <li class="{{ request()->routeIs('users.index') ? 'active' : '' }}">
            <a href="{{ route('users.index') }}" class="waves-effect waves-dark">
              <span class="pcoded-micon">
                <i class="feather icon-home"></i>
              </span>
              <span class="pcoded-mtext">ယူဆာများ</span>
            </a>
          </li>
        </ul>
        <div class="pcoded-navigation-label">ထည့်ထုတ် မှတ်တမ်း</div>
        <ul class="pcoded-item pcoded-left-item">
          <li class="{{ request()->routeIs('super-transactions.index') ? 'active' : '' }}">
            <a href="{{ route('super-transactions.index') }}" class="waves-effect waves-dark">
              <span class="pcoded-micon">
                <i class="feather icon-home"></i>
              </span>
              <span class="pcoded-mtext">စူပါ ထည့်ထုတ်</span>
            </a>
          </li>
          <li class="{{ request()->routeIs('senior-transactions.index') ? 'active' : '' }}">
            <a href="{{ route('senior-transactions.index') }}" class="waves-effect waves-dark">
              <span class="pcoded-micon">
                <i class="feather icon-home"></i>
              </span>
              <span class="pcoded-mtext">စီနီယာ ထည့်ထုတ်</span>
            </a>
          </li>
          <li class="{{ request()->routeIs('master-transactions.index') ? 'active' : '' }}">
            <a href="{{ route('master-transactions.index') }}" class="waves-effect waves-dark">
              <span class="pcoded-micon">
                <i class="feather icon-home"></i>
              </span>
              <span class="pcoded-mtext">မာစတာ ထည့်ထုတ်</span>
            </a>
          </li>
          <li class="{{ request()->routeIs('agent-transactions.index') ? 'active' : '' }}">
            <a href="{{ route('agent-transactions.index') }}" class="waves-effect waves-dark">
              <span class="pcoded-micon">
                <i class="feather icon-home"></i>
              </span>
              <span class="pcoded-mtext">အေးဂျင့် ထည့်ထုတ်</span>
            </a>
          </li>
          <li class="{{ request()->routeIs('user-transactions.index') ? 'active' : '' }}">
            <a href="{{ route('user-transactions.index') }}" class="waves-effect waves-dark">
              <span class="pcoded-micon">
                <i class="feather icon-home"></i>
              </span>
              <span class="pcoded-mtext">ယူဆာ ထည့်ထုတ်</span>
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</div>
</nav>
@endif