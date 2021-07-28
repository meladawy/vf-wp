<article class="vf-summary vf-summary--event">
  <?php if ( ! empty($start_date)) { ?>
    <p class="vf-summary__date">
      <?php       // Event dates
      if ( ! empty($start_date)) {
        if ($end_date) { 
          if ($start->format('M') == $end->format('M')) {
            echo $start->format('j'); ?> - <?php echo $end->format('j F Y'); }
            else {
              echo $start->format('j M'); ?> - <?php echo $end->format('j F Y'); }
              ?>
        <?php } 
        else {
          echo $start->format('j F Y'); 
        } }
        ?>
        </p>
        <?php } ?>
        <h3 class="vf-summary__title">
    <a href="<?php echo get_permalink(); ?>" class="vf-summary__link">
      <?php the_title(); ?>
    </a>
  </h3>

        <p class="vf-summary__text">        <?php
                if (!empty ($displayed)) {
                  echo esc_html($displayed);
                }
                elseif ($event_type) {
                   echo esc_html($event_type->name);
                }
              ?>
        </p>     
      </article>
