<?php if ($categories) {?>
    <div id="Container">
        <?php foreach ($categories as $category_id => $category) { ?>
            <div class="menu-container mix menu-items <?php echo strtolower(str_replace(' ', '-', $category['name'])); ?>">
                <div class="menu-category">
                    <h3><?php echo $category['name']; ?></h3>
                    <p><?php echo $category['description']; ?></p>
                    <?php if (!empty($category['image'])) { ?>
                        <img src="<?php echo $category['image']; ?>" alt=""/>
                    <?php }?>
                </div>
                <?php if (isset($menus[$category_id]) AND !empty($menus[$category_id])) { ?>
                    <?php foreach ($menus[$category_id] as $menu) { ?>

                        <div id="menu<?php echo $menu['menu_id']; ?>" class="menu-item">
                            <div class="menu-item-wrapper">
                                <?php if ($show_menu_images === '1') { ?>
                                    <div class="menu-thumb">
                                        <img class="img-responsive img-thumbnail" alt="<?php echo $menu['menu_name']; ?>" src="<?php echo $menu['menu_photo']; ?>">
                                    </div>
                                <?php } ?>

                                <div class="menu-content">
                                    <span class="menu-name"><b><?php echo $menu['menu_name']; ?></b></span>
                                    <span class="menu-desc small">
                                        <?php echo $menu['menu_description']; ?>
                                    </span>
                                </div>
                                <div class="menu-right">
                                    <span class="menu-price"><?php echo $menu['menu_price']; ?></span>
                                        <span class="menu-button">
                                            <?php if (isset($menu_options[$menu['menu_id']])) { ?>
                                                <a class="btn btn-primary btn-cart add_cart" onClick="openMenuOptions('<?php echo $menu['menu_id']; ?>', '<?php echo $menu['minimum_qty']; ?>');">
                                                    <span class="fa fa-plus"></span>
                                                </a>
                                            <?php } else { ?>
                                                <a class="btn btn-primary btn-cart add_cart" title="<?php echo lang('button_add'); ?>" onClick="addToCart('<?php echo $menu['menu_id']; ?>', '<?php echo $menu['minimum_qty']; ?>');">
                                                    <span class="fa fa-plus"></span>
                                                </a>
                                            <?php } ?>
                                        </span>
                                    <?php if ($menu['is_special'] === '1') { ?>
                                        <div class="menu-special"><?php echo $menu['end_days']; ?></div>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <p><?php echo lang('text_empty'); ?></p>
                <?php } ?>

                <div class="gap"></div>
                <div class="gap"></div>
            </div>
        <?php } ?>
    </div>
<?php } else { ?>
    <p><?php echo lang('text_no_category'); ?></p>
<?php } ?>

<?php if (!empty($menu_total) AND $menu_total < 150) { ?>
    <div class="pager-list"></div>
<?php } else { ?>
    <div class="pagination-bar text-right">
        <div class="links"><?php echo $pagination['links']; ?></div>
        <div class="info"><?php echo $pagination['info']; ?></div>
    </div>
<?php } ?>