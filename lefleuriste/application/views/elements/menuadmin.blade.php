<ul class="shortcut-buttons-set">
        
        <li><a class="shortcut-button" href="{{URL::to_action('admin.modifiermdp')}}"><span>
          {{HTML::image('public/img/icon_user.png')}}<br />
          Gestion du compte
        </span></a></li>

        <li><a class="shortcut-button" href="{{URL::to_action('categories.categories')}}"><span>
          {{HTML::image('public/img/icon_categories.png')}}<br />
          Gestion des catégories
        </span></a></li>
        
        <li><a class="shortcut-button" href="{{URL::to_action('products.products')}}"><span>
          {{HTML::image('public/img/icon_produits.png')}}<br />
          Gestion des produits
        </span></a></li>  
        
        <li><a class="shortcut-button" href="{{URL::to_action('login.logout')}}"><span>
          {{HTML::image('public/img/icon_logout.png')}}<br />
          Déconnexion
        </span></a></li> 
        
</ul><!-- End .shortcut-buttons-set -->