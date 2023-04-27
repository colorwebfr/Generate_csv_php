function cron_facebook_shoping()
{

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'ASC',
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => 'parfum-femme',
            ),
        ),
    );

    $loop = new WP_Query($args);

    if ($loop->have_posts()) {
        while ($loop->have_posts()) {
            $loop->the_post();
            //datas
            global $product;
            $ID_pdct = $product->get_id();
            $Name_pdct = $product->get_name();
            $Slug_pdct = $product->get_slug();
            $State = $product->get_status();
            $Decription = $product->get_description();
            $SKU = $product->get_sku();
            $Link_pdct = get_permalink($product->get_id());
            $Price = $product->get_price();
            $Price_reg = $product->get_regular_price();
            $Price_sale = $product->get_sale_price();
            $Condition = $product->get_featured();
            $Image_link = wp_get_attachment_url($product->get_image_id());

            $data_csv[] = array(
                "id" => $ID_pdct,
                "title" => $Name_pdct,
                "description" => $Decription,
                "availability" => "in stock",
                "condition" => "new",
                "price" => $Price,
                "link" => $Link_pdct,
                "image_link" => $Image_link,
                "brand" => "Jeanne Arthes"
            );
        }

        require(__DIR__ . "/class/export-csv-bs.php");
        ExportCSV::exportDataToCSV($data_csv, 'export-fb-jeanne-arthes', ';');
    }
}
