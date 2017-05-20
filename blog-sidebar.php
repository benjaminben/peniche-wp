<article id="blog_sidebar">
  <form role="search" method="get" id="searchform" class="searchform text-center"
        action="<?php echo get_site_url() ?>">
    <h1 class="title uppercase">Filter</h1>
    <select name="monthnum" class="block">
      <option disabled selected value> Month </option>
      <option value="1">January</option>
      <option value="2">February</option>
      <option value="3">March</option>
      <option value="4">April</option>
      <option value="5">May</option>
      <option value="6">June</option>
      <option value="7">July</option>
      <option value="8">August</option>
      <option value="9">September</option>
      <option value="10">October</option>
      <option value="11">November</option>
      <option value="12">December</option>
    </select>
    <select name="year" class="block">
      <option disabled selected value> Year </option>
      <?php
        $arr = array();

        $args = [
          'post_type'      => 'post',
          'category_name'  => 'blog',
          'posts_per_page' => -1,
          'order'          => 'DESC',
        ];
        $q = new WP_Query( $args );

        if ($q->have_posts()) {
          while ($q->have_posts()) {
            $q->the_post();
            $year = get_the_time('Y');

            if (array_search($year, $arr) === false) {
              array_push($arr, $year);
            }
          }
        }


        foreach ($arr as $val) { ?>
          <option value="<?php echo $val ?>"><?php echo $val ?></option>
        <?php }
      ?>
    </select>
    <span class="relative inline-block">
      <input type="text" placeholder="search" name="s" id="s" />
      <input type="hidden" value="blog" name="category_name" />
      <input type="submit" id="searchsubmit" value="" />
    </span>
  </form>
</article>
