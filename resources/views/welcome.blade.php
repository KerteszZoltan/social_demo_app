@extends('layouts.main')
@section('content')
    <div class="todo_page">Demo Social app
        <div class="todo_page_container">
            <div class="todo_page_container_desc">Description:</div>
            <div>
                <ul class="todo_page_container_list">
                    <li> bárki regisztrálhat, a regisztrációkor bekérendő adatok: név, email cím, jelszó</li>
                    <li> nem kell email értesítés, az admin felhasználó bírálja el a regisztrációs igényeket</li>
                    <li> az engedélyezett felhasználók az email címük és jelszavuk beírásával beléphetnek a rendszerbe</li>
                    <li> a rendszerben szereplő felhasználókat listázhatják és ismerősnek jelölhetik. <br>
                        Az ismerősnek jelölésről a másik felhasználó értesítést kap. Ha legközelebb belép, eldöntheti, hogy elfogadja-e az ismerősnek jelölést (vissza is utasíthatja). <br>
                        Mindkét esetben a jelölő felhasználó erről értesítést kap.</li>
                </ul>
            </div>
        </div>
    </div>
    
@endsection