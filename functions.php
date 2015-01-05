<?php

function breadcrumber() {
  if (!is_home()) {
    echo '<div id="breadcrumber" class="block clearfix" xmlns:v="http://rdf.data-vocabulary.org/#">';
    echo '<span typeof="v:Breadcrumb"><a href="'.get_option('home').'" rel="v:url" property="v:title">Accueil</a></span> » ';
    if (is_category() || is_single()) {
      if(get_post_type() != "post"){
        echo '<a href="'.get_option('siteurl').'/'.get_post_type().'/" rel="v:url" property="v:title">'.get_post_type().'</a>';
      }else{
        echo('<span typeof="v:Breadcrumb" rel="v:url" property="v:title">');
        the_category('title_li=');
        echo('</span>');
      }
      if(is_single()){
        echo " » <span rel=\"v:url\" property=\"v:title\">";
        the_title();
        echo "</span>";
      }
    } elseif (is_search()) {
      echo "<span rel=\"v:url\" property=\"v:title\">";
      echo "Termes recherchés : ". get_search_query();
      echo "</span>";
    } elseif (is_page()) {
      if($post->post_parent){
        $parents = get_post_ancestors( $post->ID );
                foreach ( $parents as $p ) {
                    echo '<a href="'.get_permalink($p).'" title="'.get_the_title($p).'" rel="v:url" property="v:title">'.get_the_title($p).'</a> » ';
                }
                echo "<span rel=\"v:url\" property=\"v:title\">".$title."</span>";
      }else{
        echo "<span rel=\"v:url\" property=\"v:title\">";
        the_title();
        echo "</span>";
      }
    } elseif (is_tag()) {
      echo "<span rel=\"v:url\" property=\"v:title\">";
      single_tag_title();
      echo "</span>";
    } elseif (is_day()) {
      "<span rel=\"v:url\" property=\"v:title\">Archives du ".the_time('jS F, Y')."</span>";
    } elseif (is_month()) {
      "<span rel=\"v:url\" property=\"v:title\">Archives de ".the_time('F, Y')."</span>";
    } elseif (is_year()) {
      "<span rel=\"v:url\" property=\"v:title\">Archives de ".the_time('Y')."</span>";
    } elseif (is_author()) {
      $userdata = get_userdata($author);
      "<span rel=\"v:url\" property=\"v:title\">Archive de l'auteur ".$userdata->display_name."</span>";
    } elseif (is_404()) {
      echo "<span rel=\"v:url\" property=\"v:title\">Erreur 404</span>";
    } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
      echo "<span rel=\"v:url\" property=\"v:title\">Archives du blog</span>";
    }
    echo "</div>";
  }
}
