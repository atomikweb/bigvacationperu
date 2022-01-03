<?php
global $tpl_listgrid;
global $layout;
$hide_load_more_btn = ''; ?>
<!-- content with sidebar -->
<div class="bg-gray content-with-sidebar <?php echo esc_attr($tpl_listgrid); ?>-view-sidebar search-filter">
    <div class="container-fluid layout-fluid">
        <div id="two-columns" class="row">
            <!-- sidebar -->
            <aside id="sidebar" class="col-md-4 col-lg-3 sidebar sidebar-list">
                <div class="sidebar-holder">
                    <header class="heading">
                        <h3><?php _e('FILTER',  'entrada'); ?></h3>
                    </header>
                    <div class="accordion">
                        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('listingsidebar_widget')) :
                        endif; ?>
                    </div>
                </div>
            </aside>
            <div id="content" class="col-md-8 col-lg-9">
                <div class="filter-option filter-box">
                    <strong class="result-info"><?php global $total_record_count;
                                                printf(esc_html(_n('%d Trip matches your search criteria', '%d Trips match your search criteria', $total_record_count, 'entrada')), $total_record_count); ?></strong>
                    <div class="layout-holder">
                        <div class="layout-action">
                            <a href="javascript:void(null);" id="search_list" class="link link-list<?php if ('list' == $tpl_listgrid) {
                                                                                                        echo ' active';
                                                                                                    } ?>"><span class="icon-list"></span></a>
                            <a href="javascript:void(null);" id="search_grid" class="link link-grid<?php if ('grid' == $tpl_listgrid) {
                                                                                                        echo ' active';
                                                                                                    } ?>"><span class="icon-grid"></span></a>
                        </div>
                        <div class="select-holder">
                            <div class="select-col">
                                <select class="filter-select sort-select" id="filter_by_order">
                                    <option value="sort"><?php _e('SORT ORDER',  'entrada'); ?></option>
                                    <option value="alphabet"><?php _e('Alphabet',  'entrada'); ?></option>
                                    <option value="price"><?php _e('Price',  'entrada'); ?></option>
                                    <option value="popularity"><?php _e('Popular',  'entrada'); ?></option>
                                    <option value="date"><?php _e('Recent',  'entrada'); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <?php $mode = ($tpl_listgrid == 'grid') ? 'content-sub-holder' : 'list-view'; ?>
                <div <?php if ($tpl_listgrid == 'list') {
                            echo ' id="ajax_content_wrapper"';
                        } ?> class="content-holder <?php echo esc_attr($mode); ?>">
                    <?php
                    global $loop;
                    if ($tpl_listgrid == 'grid') {
                        echo '<div class="row db-3-col" id="ajax_content_wrapper">';
                    }
                    if ($loop->have_posts()) {
                        $hide_load_more_btn = 'no';
                        while ($loop->have_posts()) : $loop->the_post();
                            get_template_part('template-parts/search', $tpl_listgrid);
                        endwhile;
                        if ($tpl_listgrid == 'grid') {
                            echo '</div>';
                        }
                    } else {
                        $hide_load_more_btn = '';
                        if ($tpl_listgrid == 'grid') {
                            echo '</div>';
                        }
                    } ?>
                </div>
                <!-- pagination wrap -->
                <?php $display_mode = ($hide_load_more_btn) ? 'block' : 'none'; ?>
                <nav class="loadmore-wrap text-center" style="display:<?php echo esc_attr($display_mode); ?>">
                    <input type="hidden" id="search_layout" name="search_layout" value="<?php echo esc_attr($layout); ?>">
                    <input type="hidden" id="posts_per_page" name="posts_per_page" value="<?php global $posts_per_page;
                                                                                            echo esc_attr($posts_per_page); ?>" />
                    <input type="hidden" id="paged" name="paged" value="2" />
                    <input type="hidden" id="load_start_date" name="load_start_date" value="<?php global $start_date;
                                                                                            echo esc_attr($start_date); ?>" />
                    <input type="hidden" id="load_end_date" name="load_end_date" value="<?php global $end_date;
                                                                                        echo esc_attr($end_date); ?>" />
                    <a href="javascript:void(null);" id="search_load_more_post" class="btn btn-default"><?php _e('LOAD MORE',  'entrada'); ?></a>
                </nav>
            </div>
        </div>
    </div>
</div>