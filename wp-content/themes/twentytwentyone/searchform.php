<?php
/**
 * The searchform.php template.
 *
 * Used any time that get_search_form() is called.
 */
?>
<form role="search" action="<?php echo esc_url( home_url( '/events/' ) ); ?>" class="form-search" autocomplete="off" >
    <button>
        <img src="/wp-content/themes/twentytwentyone/img/svg/search.svg" alt="">
    </button>
    <input type="text" placeholder="Search..." class="search-input-placeholder-js" name="search" autocomplete="new-password" onchange="$(this).toggleClass('active')">

    <div id="search-suggestion__js" class="search-suggestion" style="display:none"><?php
//        <div class="search-suggestion__block">
//            <div class="search-suggestion__title">Circles</div>
//            <div class="search-suggestion__list">
//                <div class="search-suggestion__item">Circles 1</div>
//                <div class="search-suggestion__item">Circles 2</div>
//                <div class="search-suggestion__item">Circles 3</div>
//            </div>
//        </div>
?>
    </div>
</form>