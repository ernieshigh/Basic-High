<?php
/***
	*
	* Search form 
	*
	*
***/
?>

<div class="search-container">
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ) ?>">
    <input class="search-input" id="searchleft" type="search" value="<?php echo get_search_query() ?>" name="s"  placeholder="Search">
    <label class="searchbutton" for="searchleft"><span class="mglass"></span></label>
  </form>
</div>