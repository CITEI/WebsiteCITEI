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
            return <<< EOD
                <li class="mx-3">
                    <a class="nav-link {$active} rounded-pill border-0 text-reset" 
                    id="{$id}tt-{$label}-tab" 
                    data-toggle="tab" 
                    href="#tt-{$label}" 
                    role="tab" aria-controls="${id}tt-{$label}" 
                    aria-selected="{$aria}">
                    <u>{$label}</u>
                    </a>
                </li>
            EOD;
        }
    }

    if (!function_exists("get_tab"))
    {
        function get_tab($id, $text, $label, $active="")
        {
            return <<< EOD
                <div class="tab-pane show fade {$active} text-reset" 
                    id="tt-{$label}" 
                    role="tabpanel" aria-labelledby="{$id}tt-{$label}-tab">
                    {$text}
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
        <nav class="text-reset nav-pills">
            <ul class="nav nav-tabs border-0 justify-content-center mb-2" id="<?php echo $id; ?>tt-nav-tab" role="tablist">
                <?php echo $buttons; ?>
            </ul>
            <div class="tab-content text-reset py-3" id="nav-tabContent">
                <?php echo $contents; ?>
            </div>
        </nav>
<?php } ?>
