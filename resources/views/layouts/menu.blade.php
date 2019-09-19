<h3>Menu</h3>
<ul class="nav nav-pills flex-column">
	@if(Auth::user()->isAdmin())
	<li class="nav-item border-bottom">
        <a class="nav-link {{ Request::is('user*') ? 'active' : '' }}" href="/user">{{ config('app.users') }}</a>
    </li>
    @endif
    <li class="nav-item border-bottom">
        <a class="nav-link {{ Request::is('post*') ? 'active' : '' }}" href="/post">{{ config('app.posts') }}</a>
    </li>
</ul>
<hr class="d-sm-none">