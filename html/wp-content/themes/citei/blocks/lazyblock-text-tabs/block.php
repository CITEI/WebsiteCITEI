<?php
/*
Type: LazyBlock
Name: Text tabs
Purpose: Displays tabs containing text
Author: Nickolas da Rocha Machado & Natalia Zambe
 */
?>
<?php 
    $tabs = $attributes['tabs'];

    if (!function_exists("get_button"))
    {
        function get_button($id, $label, $active="", $aria="false")
        {
            $label_html = esc_html($label);
            $label_attr = esc_attr($label);
            return <<< EOD
                <li class="mx-3">
                    <a class="nav-link {$active} rounded-pill border-0 text-reset
                        px-4" 
                    id="citeitt{$id}-{$label_attr}-tab" 
                    data-toggle="tab" 
                    href="#citeitt{$id}-{$label_attr}" 
                    role="tab" 
                    aria-controls="citeitt{$id}-{$label_attr}" 
                    aria-selected="{$aria}">
                        <u>{$label_html}</u>
                    </a>
                </li>
            EOD;
        }
    }

    if (!function_exists("get_tab"))
    {
        function get_tab($id, $text, $label, $active="")
        {
            $label = esc_attr($label);
            $text = esc_html($text);
            return <<< EOD
                <div class="tab-pane show fade {$active} text-reset" 
                    id="citeitt{$id}-{$label}" 
                    role="tabpanel"
                    tabindex="0">
                        <p>{$text}</p>
                </div> 
            EOD;
        }
    }

    $buttons = "";
    $contents = "";
    if (!empty($tabs))
    {
        $id = new_id();

        $first = $tabs[0];
        $buttons = get_button($id, $first['label'], "active", "true");
        $contents = get_tab($id, $first['text'], $first['label'], "active");
        array_shift($tabs);
        foreach($tabs as $tab)
        { 
            $buttons .= get_button($id, $tab['label']);
            $contents .= get_tab($id, $tab['text'], $tab['label']);
        } 
?>
        <div tabindex="0" aria-label="<?php _e("Text tabs", 'citei') ?>">
            <div class="text-reset nav-pills" tabindex="-1">
                <ul class="nav nav-tabs border-0 justify-content-center mb-2" 
                    id="citeitt<?php echo $id ?>-nav-tab" 
                    role="tablist"
                    tabindex="-1">
                    <?php echo $buttons; ?>
                </ul>
            </div>
            <div class="tab-content text-reset py-3" 
                id="citeitt<?php echo $id; ?>-tab-content" 
                tabindex="-1">
                <?php echo $contents; ?>
            </div>
        </div>
<?php } ?>
