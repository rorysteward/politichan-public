<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
   <?php foreach ($sitemap as $row) { ?>
      <url>
         <loc><?= base_url() ?>/boards/<?php echo $row->board_name ?></loc>

         <lastmod><?php echo $row->modified_at ?></lastmod>

         <changefreq>daily</changefreq>

         <priority>0.9</priority>
      </url>
   <?php } ?>
</urlset>