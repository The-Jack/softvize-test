Laravel 11 App inside Docker 

Using

Laravel 11 with Jetstream
Inertia 
Vue3

before using be sure to
<ul>
<li>composer i</li>
<li>npm i</li>
<li>npm run build</li>
<li>php artisan migrate:fresh --seed</li> 
</ul>

Basic tests have been created.
Access via "php artisan test --filter ProductTest"

login with normal user (with no user discount)
<ul>
<li>normal@example.com</li>
<li>pass-for-test</li>
</ul>

login with special user (with user discount)
<ul>
<li>special@example.com</li>
<li>pass-for-test</li>
</ul>

On login, should be redirected to /Products

Via datatables, A products list and dicounts list is provided.

products show relavent Name, Description, Category, base price, final price and applied discount.

name and description are hyperlinked to view each product individually and see a breakdown of all discounts applied.
